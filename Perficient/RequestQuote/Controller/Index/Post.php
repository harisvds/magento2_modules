<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 12:53 PM
 */
namespace Perficient\RequestQuote\Controller\Index;
ini_set('display_errors', 1);
error_reporting(E_ALL);

class  Post extends \Magento\Framework\App\Action\Action
{
    protected $_requestQuoteFactory;
    protected $_formKeyValidator;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Perficient\RequestQuote\Model\QuoteFactory $requestQuoteFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Escaper $escaper
    )
    {
        $this->_requestQuoteFactory = $requestQuoteFactory;
        $this->_formKeyValidator = $formKeyValidator;
        parent::__construct($context);

        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_escaper = $escaper;
    }

    public function execute()
    {

        /*if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->getResponse()->setRedirect($this->_redirect->getRefererUrl());
        }*/


        try {
            $data = $this->getRequest()->getParams();
            $quote = $this->_requestQuoteFactory->create()->setData($data);
            $quote->save();

            /*Email Template Statr*/

            $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->storeManager->getStore()->getId());
            $templateVars = array(
                'store' => $this->storeManager->getStore(),
                'customer_name' => $data['name'],
                'message' => 'Test Template!.'
            );
            $from = array('email' => "harishankar.malviya@perficient.com", 'name' => 'HS');
            $this->inlineTranslation->suspend();
            $to = array($data['email'], $data['name']);
            $transport = $this->_transportBuilder->setTemplateIdentifier('custom_email_template')
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($to)
                ->getTransport();

            //print_r($transport);
            //exit;
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            /*Email Template End*/


            $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl());

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}