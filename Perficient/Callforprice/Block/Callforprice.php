<?php
namespace Perficient\Callforprice\Block;

/**
 * Product price block
 */
class Callforprice extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{

    /**
     * Wrap with standard required container
     *
     * @param string $html
     * @return string
     */
    public function wrapResult($html)
    {


        if($this->getSaleableItem()->getCallForPrice()!=1):
            return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
            'data-role="priceBox" ' .
            'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
            '>' . $html . '</div>';
        else :
            return '<div class="price-box "><span>'.$this->getSaleableItem()->getCallforpriceText().'</span></div>';
        endif;

    }

}
