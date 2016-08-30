<?php

namespace Perficient\Gallery\Block\Adminhtml\Gallery\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Perficient\Gallery\Model\Status;

class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;


    protected $_status;

    protected $_store;

    protected $_storeManager;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $newsStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $status,
        Store $store,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        $this->_store = $store;
        $this->_storeManager = $context->getStoreManager();
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Gallery Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Gallery Info');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {

        $model = $this->_coreRegistry->registry('gallery_post');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
//        $form->setHtmlIdPrefix('news_');
//        $form->setFieldNameSuffix('news');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getGalleryId()) {
            $fieldset->addField(
                'gallery_id',
                'hidden',
                ['name' => 'gallery_id']
            );
        }
        $fieldset->addField(
            'gallery_code',
            'text',
            [
                'name' => 'gallery_code',
                'label' => __('Banner Code'),
                'required' => true
            ]
        );


        $fieldset->addField(
            'category_ids',
            'Perficient\Gallery\Block\Adminhtml\Product\Helper\Form\Category',
            //'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category',
            [
                'name' => 'category_ids',
                'title' => 'Category',
                'label' => 'Category'
            ]
        );


        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_ids',
                'multiselect',
                [
                    'name' => 'store_ids[]',
                    'label' => __('Assign to Store Views'),
                    'title' => __('Assign to Store Views'),
                    'required' => true,
                    'values' => $this->_store->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        }
        $statuses = $this->_status->getOptionArray();
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'options' => $statuses
            ]
        );
     
        /*  $fieldset->addField(
              'summary',
              'textarea',
              [
                  'name'      => 'summary',
                  'label'     => __('Summary'),
                  'required'  => true,
                  'style'     => 'height: 15em; width: 30em;'
              ]
          );
          $wysiwygConfig = $this->_wysiwygConfig->getConfig();
          $fieldset->addField(
              'description',
              'editor',
              [
                  'name'        => 'description',
                  'label'    => __('Description'),
                  'required'     => true,
                  'config'    => $wysiwygConfig
              ]
          );*/

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}