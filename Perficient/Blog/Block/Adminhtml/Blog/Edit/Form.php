<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 5:05 PM
 */
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */
namespace Perficient\Blog\Block\Adminhtml\Blog\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        //echo "IN side construct"; exit;
        parent::_construct();
        $this->setId('perficient_bog_form');
        $this->setTitle(__('Blog Information'));
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        //echo "IN side form"; exit;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('blogs/blog/save'),
                    'method' => 'post',
                ],
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();

    }
}
