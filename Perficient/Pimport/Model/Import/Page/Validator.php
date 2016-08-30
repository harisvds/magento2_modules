<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/24/2016
 * Time: 4:09 PM
 */
namespace Perficient\PimportExport\Model\Import\Pages;


use Perficient\Pimport\Model\Import\Page\RowValidatorInterface;
use \Magento\Framework\Validator\AbstractValidator;


class Validator extends AbstractValidator implements RowValidatorInterface
{
    /**
     * @var RowValidatorInterface[]|AbstractValidator[]
     */
    protected $validators = [];

    /**
     * @param RowValidatorInterface[] $validators
     */
    public function __construct($validators = [])
    {
        $this->validators = $validators;
    }

    /**
     * Check value is valid
     * @param array $value
     * @return bool
     */
    public function isValid($value)
    {
        $returnValue = true;
        $this->_clearMessages();
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($value)) {
                $returnValue = false;
                $this->_addMessages($validator->getMessages());
            }
        }
        return $returnValue;
    }


    public function init($context)
    {
        foreach ($this->validators as $validator) {
            $validator->init($context);
        }
        return $this;
    }
}
