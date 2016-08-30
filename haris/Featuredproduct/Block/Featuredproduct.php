<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/22/2016
 * Time: 3:06 PM
 */
namespace  Perficient\Featuredproduct\Block;
use Magento\Customer\Model\Context as CustomerContext;

class Featuredproduct extends \Magento\Catalog\Block\Product\AbstractProduct
{

    protected $_productcollection;

    /**
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;
    /**
     * Catalog product visibility
     *
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $_catalogProductVisibility;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productcollection,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        array $data = []
    ) {
        $this->_productcollection = $productcollection;
        $this->urlHelper = $urlHelper;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        parent::__construct($context, $data);
    }

    public function getFeaturedProduct(){
        $collection =  $this->_productcollection->create()
            ->addAttributeToFilter('status', '1')
            ->addAttributeToFilter('is_featured', '1');
        $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());
        $collection = $this->_addProductAttributesAndPrices($collection)
            ->setPageSize(4)
            ->setCurPage(1);

        return $collection;
    }
    /**
     * Get post parameters
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getAddToCartPostParams(\Magento\Catalog\Model\Product $product)
    {
        $url = $this->getAddToCartUrl($product);
        return [
            'action' => $url,
            'data' => [
                'product' => $product->getEntityId(),
                \Magento\Framework\App\Action\Action::PARAM_NAME_URL_ENCODED =>
                    $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }

}