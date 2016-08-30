<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/24/2016
 * Time: 1:53 PM
 */
namespace Perficient\Pimport\Model\Import\Page\Validator;

use Magento\Framework\Validator\AbstractValidator;
use Perficient\Pimport\Model\Import\Page\RowValidatorInterface;

abstract class AbstractImportValidator extends AbstractValidator implements RowValidatorInterface
{
    /**
     * @var \Magento\CatalogImportExport\Model\Import\Product
     */
    protected $context;

    /**
     * @param \Magento\CatalogImportExport\Model\Import\Product $context
     * @return $this
     */
    public function init($context)
    {
        $this->context = $context;
        return $this;
    }
}
