<?php
    namespace Perficient\Overriding\Model\Rewrite\Catalog;

    class Product extends \Magento\Catalog\Model\Product
    {
        /**
         * Get product name
         *
         * @return string
         * @codeCoverageIgnoreStart
         */
        public function getName()
        {
            return "HS-".$this->_getData(self::NAME);
        }

    }