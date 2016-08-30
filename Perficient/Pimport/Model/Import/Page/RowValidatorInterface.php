<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/24/2016
 * Time: 3:42 PM
 */

namespace Perficient\Pimport\Model\Import\Page;

interface RowValidatorInterface extends \Magento\Framework\Validator\ValidatorInterface
{
    const ERROR_INVALID_TITLE= 'InvalidValueTITLE';
    const ERROR_TITLE_IS_EMPTY = 'EmptyTITLE';
    /**
     * Initialize validator
     *
     * @return $this
     */
    public function init($context);
}
