<?php
namespace Perficient\Gallery\Block\Adminhtml\Product\Helper\Form;

class Category extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category
{



    /**
     * Attach category suggest widget initialization
     *
     * @return string
     */
    public function getAfterElementHtml()
    {
        if (!$this->isAllowed()) {
            return '';
        }
        $htmlId = $this->getHtmlId();
        $suggestPlaceholder = __('start typing to search category');
        $selectorOptions = $this->_jsonEncoder->encode($this->_getSelectorOptionsX());
        $newCategoryCaption = __('New Category');

        $button = $this->_layout->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            [
                'id' => 'add_category_button',
                'label' => $newCategoryCaption,
                'title' => $newCategoryCaption,
                'onclick' => 'jQuery("#new-category").modal("openModal")',
                'disabled' => $this->getDisabled(),
            ]
        );
        $return = <<<HTML
    <input id="{$htmlId}-suggest" placeholder="$suggestPlaceholder" />
    <script>
        require(["jquery", "mage/mage"], function($){
            $('#{$htmlId}-suggest').mage('treeSuggest', {$selectorOptions});
        });
    </script>
HTML;
        return $return . $button->toHtml();
    }

    /**
     * Get selector options
     *
     * @return array
     */
    protected function _getSelectorOptionsX()
    {
      
        return [
            'source' => $this->_backendData->getUrl('gallery/category/SuggestCategories'),
            'valueField' => '#' . $this->getHtmlId(),
            'className' => 'category-select',
            'multiselect' => true,
            'showAll' => true
        ];
    }

}

