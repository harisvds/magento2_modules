<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/28/2016
 * Time: 1:13 PM
 */
namespace Perficient\Callforprice\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $callForPriceFactory;
    protected $formValidator;
    protected $jsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey\Validator $validator,
        \Perficient\Callforprice\Model\CallforpriceFactory $callForPriceFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory

    )
    {
        $this->callForPriceFactory = $callForPriceFactory;
        $this->formValidator = $validator;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        if (!$this->formValidator->validate($this->getRequest())) {
            $result->setData(['message' => 'Please Try Again', 'status' => 'error']);
            return $result;
        }
        try {
            $data = $this->getRequest()->getPostValue();
            $priceFactoryData = $this->callForPriceFactory->create()->setData($data);
            $priceFactoryData->save();
            $result->setData(['message' => 'Your Query has been saved successfully', 'status' => 'success']);
            return $result;
        } catch (\Exception $e) {
            $result->setData(['message' => $e->getMessage(), 'status' => 'error']);
            return $result;
        }

    }
}

