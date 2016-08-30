<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/24/2016
 * Time: 1:53 PM
 */
namespace Perficient\Pimport\Model\Import;

use Perficient\Pimport\Model\Import\Page\RowValidatorInterface as ValidatorInterface;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;


class Block extends
    \Magento\ImportExport\Model\Import\Entity\AbstractEntity
{
    const TITLE = 'title';
    const CONTENT = 'content';
    const IDENTIFIER = 'identifier';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const IS_ACTIVE = 'is_active';


    const TABLE_Entity = 'cms_block';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = [
        ValidatorInterface::ERROR_TITLE_IS_EMPTY => 'TITLE is empty',
    ];

    protected $_permanentAttributes = [
        self::TITLE,
        self::IDENTIFIER,
        self::CONTENT,
        self::CREATION_TIME,
        self::UPDATE_TIME,
        self::IS_ACTIVE,

    ];

    /**
     * If we should check column names
     *
     * @var bool
     */
    protected $needColumnCheck = true;
    protected $pageFactory;
    /**
     * Valid column names
     *
     * @array
     */
    protected $validColumnNames = [
        self::TITLE,
        self::IDENTIFIER,
        self::CONTENT,
        self::CREATION_TIME,
        self::UPDATE_TIME,
        self::IS_ACTIVE,


    ];
    protected $logger;

    /**
     * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
     */
    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\ImportExport\Helper\Data $importExportData,
        \Magento\ImportExport\Model\ResourceModel\Import\Data $importData,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\ImportExport\Model\ResourceModel\Helper $resourceHelper,
        \Magento\Framework\Stdlib\StringUtils $string,
        ProcessingErrorAggregatorInterface $errorAggregator,
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->jsonHelper = $jsonHelper;
        $this->_importExportData = $importExportData;
        $this->_resourceHelper = $resourceHelper;
        $this->_dataSourceModel = $importData;
        $this->_resource = $resource;
        $this->_connection = $resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator = $errorAggregator;
        $this->pageFactory = $pageFactory;

    }

    public function getValidColumnNames()
    {
        return $this->validColumnNames;
    }

    /**
     * Entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return 'cms_block_code';
    }

    /**
     * Create Advanced price data from raw data.
     *
     * @throws \Exception
     * @return bool Result of operation.
     */
    protected function _importData()
    {

        if (\Magento\ImportExport\Model\Import::BEHAVIOR_DELETE == $this->getBehavior()) {
            $this->deleteEntity();
        } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_REPLACE == $this->getBehavior()) {
            $this->replaceEntity();
        } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_APPEND == $this->getBehavior()) {
            $this->saveEntity();
        }
        return true;
    }


    public function deleteEntity()
    {

        $listTitle = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            foreach ($bunch as $rowNum => $rowData) {
                $this->validateRow($rowData, $rowNum);
                if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                    $rowTtile = $rowData[self::TITLE];
                    $listTitle[] = $rowTtile;
                }
                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                }
            }
        }
        $this->logger->info(print_r($listTitle, 1));
        if ($listTitle) {
            $this->deleteEntityFinish(array_unique($listTitle), self::TABLE_Entity);
        }
        return $this;
    }


    public function validateRow(array $rowData, $rowNum)
    {

        $title = false;

        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }

        $this->_validatedRows[$rowNum] = true;

        if (!isset($rowData[self::TITLE]) || empty($rowData[self::TITLE])) {
            $this->addRowError(ValidatorInterface::ERROR_TITLE_IS_EMPTY, $rowNum);
            return false;
        }

        return !$this->getErrorAggregator()->isRowInvalid($rowNum);
    }

    protected function deleteEntityFinish(array $listTitle, $table)
    {
        if ($table && $listTitle) {
            $this->logger->info('In side deleteEntity' . $table);
            try {
                $this->countItemsDeleted += $this->_connection->delete(
                    $this->_connection->getTableName($table),
                    $this->_connection->quoteInto('title IN (?)', $listTitle)
                );
                return true;
            } catch (\Exception $e) {
                return false;
            }

        } else {
            return false;
        }
    }


    public function replaceEntity()
    {
        $this->saveAndReplaceEntity();
        return $this;
    }


    protected function saveAndReplaceEntity()
    {
        $behavior = $this->getBehavior();
        $listTitle = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            $entityList = [];
            foreach ($bunch as $rowNum => $rowData) {
                if (!$this->validateRow($rowData, $rowNum)) {
                    $this->addRowError(ValidatorInterface::ERROR_TITLE_IS_EMPTY, $rowNum);
                    continue;
                }
                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                    continue;
                }
                $rowTtile = $rowData[self::TITLE];
                $listTitle[] = $rowTtile;
                $entityList[$rowTtile][] = [
                    self::TITLE => $rowData[self::TITLE],
                    self::IDENTIFIER => $rowData[self::IDENTIFIER],
                    self::CONTENT => $rowData[self::CONTENT],
                    self::CREATION_TIME => $rowData[self::CREATION_TIME],
                    self::UPDATE_TIME => $rowData[self::UPDATE_TIME],
                    self::IS_ACTIVE => $rowData[self::IS_ACTIVE],

                ];
            }
            if (\Magento\ImportExport\Model\Import::BEHAVIOR_REPLACE == $behavior) {
                if ($listTitle) {
                    if ($this->deleteEntityFinish(array_unique($listTitle), self::TABLE_Entity)) {
                        $this->saveEntityFinish($entityList, self::TABLE_Entity);
                    }
                }
            } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_APPEND == $behavior) {
                $this->saveEntityFinish($entityList, self::TABLE_Entity);
            }
        }
        return $this;
    }


    protected function saveEntityFinish(array $entityData, $table)
    {
        if ($entityData) {
            $tableName = $this->_connection->getTableName($table);
            $entityIn = [];
            foreach ($entityData as $id => $entityRows) {
                foreach ($entityRows as $row) {
                    $entityIn[] = $row;
                }
            }
            if ($entityIn) {
                $this->_connection->insertOnDuplicate($tableName, $entityIn, [
                    self::TITLE,
                ]);
            }
        }
        return $this;
    }

    /**
     * Save newsletter subscriber
     *
     * @return $this
     */
    public function saveEntity()
    {
        $this->saveAndReplaceEntity();
        return $this;
    }


}
