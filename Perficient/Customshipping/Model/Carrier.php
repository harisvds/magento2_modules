<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/4/2016
 * Time: 1:36 PM
 */
namespace Perficient\Customshipping\Model;

use Magento\Framework\Xml\Security;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrierOnline;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Ups\Helper\Config;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Carrier extends AbstractCarrierOnline implements CarrierInterface
{
    const CODE = 'pfcustomshipping';
    protected $_code = self::CODE;
    protected $_request;
    protected $_result;
    protected $_baseCurrencyRate;
    protected $_xmlAccessRequest;
    protected $_localeFormat;
    protected $_logger;
    protected $configHelper;
    protected $_errors = [];
    protected $_isFixed = true;
    protected $_carrierFactory;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        Security $xmlSecurity,
        \Magento\Shipping\Model\Simplexml\ElementFactory $xmlElFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Directory\Helper\Data $directoryData,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        Config $configHelper,
        \Perficient\Customshipping\Model\PfcustomFactory $carrierFactory,
        array $data = []
    )
    {
        $this->_logger = $logger;
        $this->_localeFormat = $localeFormat;
        $this->_carrierFactory = $carrierFactory;
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $xmlSecurity,
            $xmlElFactory,
            $rateFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $data
        );
    }

    public function getAllowedMethods()
    {
    }

    public function collectRates(RateRequest $request)
    {
        $result = $this->_rateFactory->create();
        /*store shipping in session*/
        $method = $this->_rateMethodFactory->create();
        $finalShippingPrice = 0; //Final Shipping which implement on order
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                $orderProductQty = $item->getQty();
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }
                if ($item->getHasChildren()) {
                    $productSku = $item->getProduct()->getData('sku');
                } else {
                    $productSku = $item->getSku();
                }
                $finalShippingPrice = $this->calculateShipping($productSku);
            }
        }
        if ($finalShippingPrice != '' || $finalShippingPrice <= 0) {
            $result->append($method);
            $method->setCarrier($this->_code);
            $method->setCarrierTitle('Perficient custom Shipping');
            /* Use method name */
            $method->setMethod($this->_code);
            $method->setMethodTitle('Perficient Custom Shipping');
            $method->setCost($finalShippingPrice);
            $method->setPrice($finalShippingPrice);
        }


        return $result;
    }

    /* function to calculate shipping
     * @param string
     * @return string
     * */
    public function calculateShipping($productSku)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Catalog\Model\Product')->loadByAttribute('sku', $productSku);
        $cartProductCatId = $product->getCategoryIds();
        $catshipPrice = 0;
        foreach ($cartProductCatId as $categoryID) {
            $result = $this->_carrierFactory->create();
            $this->_logger->info(print_r('category_id:' . $categoryID, 1));
            $categoryData = $result->getCollection()
                ->addFieldToFilter('category_id', ['eq' => $categoryID])
                ->getData();
            $this->_logger->info(print_r($categoryData, 1));
            $cateShippingPrice = $categoryData[0]['price'];
            if (isset($cateShippingPrice) && $cateShippingPrice != '') {
                if ($cateShippingPrice >= $catshipPrice) {
                    // Set heighst shipping price if more than two categories
                    $catshipPrice = $cateShippingPrice;
                }
            }
        }
        return $catshipPrice;

    }

    public function proccessAdditionalValidation(\Magento\Framework\DataObject $request)
    {
        return true;
    }

    protected function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
    }
}