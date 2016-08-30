<?php
namespace Perficient\Feedback\Controller\Index;
class Post extends \Magento\Framework\App\Action\Action
{
    protected $_feedbackFactory;
    protected $_formKeyValidator;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Perficient\Feedback\Model\FeedbackFactory $feedbackFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    )
    {
        $this->_feedbackFactory = $feedbackFactory;
        $this->_formKeyValidator = $formKeyValidator;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->getResponse()->setRedirect($this->_redirect->getRefererUrl());
            return;
        }
        try {
            $data = $this->getRequest()->getPostValue();
            $feedback = $this->_feedbackFactory->create()->setData($data);
            $feedback->save();
            $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl());
        } catch (\Exception $e) {

        }
    }
}