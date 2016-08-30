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


class Page extends
    \Magento\ImportExport\Model\Import\Entity\AbstractEntity
{
    const TITLE = 'title';
    const PAGE_LAYOUT = 'page_layout';
    const META_KEYWORDS = 'meta_keywords';
    const META_DESCRIPTION = 'meta_description';
    const IDENTIFIER = 'identifier';
    const CONTENT_HEADING = 'content_heading';
    const CONTENT = 'content';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const IS_ACTIVE = 'is_active';
    const SORT_ORDER = 'sort_order';
    const LAYOUT_UPDATE = 'layout_update_xml';
    const CUSTOM_THEME = 'custom_theme';
    const CUSTOM_ROOT = 'custom_root_template';
    const CUSTOM_LAYOUT = 'custom_layout_update_xml';
    const CUSTOM_THEME_FORM = 'custom_theme_from';
    const CUSTOM_THEME_TO = 'custom_theme_to';
    const META_TITLE = 'meta_title';


    const TABLE_Entity = 'cms_page';

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
        self::PAGE_LAYOUT,
        self::META_KEYWORDS,
        self::META_DESCRIPTION,
        self::IDENTIFIER,
        self::CONTENT_HEADING,
        self::CONTENT,
        self::CREATION_TIME,
        self::UPDATE_TIME,
        self::IS_ACTIVE,
        self::SORT_ORDER,
        self::LAYOUT_UPDATE,
        self::CUSTOM_THEME,
        self::CUSTOM_ROOT,
        self::CUSTOM_LAYOUT,
        self::CUSTOM_THEME_FORM,
        self::CUSTOM_THEME_TO,
        self::META_TITLE

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
        self::PAGE_LAYOUT,
        self::META_KEYWORDS,
        self::META_DESCRIPTION,
        self::IDENTIFIER,
        self::CONTENT_HEADING,
        self::CONTENT,
        self::CREATION_TIME,
        self::UPDATE_TIME,
        self::IS_ACTIVE,
        self::SORT_ORDER,
        self::LAYOUT_UPDATE,
        self::CUSTOM_THEME,
        self::CUSTOM_ROOT,
        self::CUSTOM_LAYOUT,
        self::CUSTOM_THEME_FORM,
        self::CUSTOM_THEME_TO,
        self::META_TITLE

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
        return 'cms_page_code';
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

    /**
     * Deletes newsletter subscriber data from raw data.
     *
     * @return $this
     */
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
        $this->logger->info(print_r($listTitle,1));
        if ($listTitle) {
            $this->deleteEntityFinish(array_unique($listTitle), self::TABLE_Entity);
        }
        return $this;
    }

    /**
     * Row validation.
     *
     * @param array $rowData
     * @param int $rowNum
     * @return bool
     */
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
            $this->logger->info('In side deleteEntity'.$table);
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

    /**
     * Replace newsletter subscriber
     *
     * @return $this
     */
    public function replaceEntity()
    {
        $this->saveAndReplaceEntity();
        return $this;
    }

    /**
     * Save and replace newsletter subscriber
     *
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                    self::PAGE_LAYOUT => $rowData[ self::PAGE_LAYOUT],
                    self::META_KEYWORDS => $rowData[ self::META_KEYWORDS],
                    self::META_DESCRIPTION => $rowData[ self::META_DESCRIPTION],
                    self::IDENTIFIER => $rowData[ self::IDENTIFIER],
                    self::CONTENT_HEADING => $rowData[ self::CONTENT_HEADING],
                    self::CONTENT => $rowData[ self::CONTENT],
                    self::CREATION_TIME => $rowData[ self::CREATION_TIME],
                    self::UPDATE_TIME => $rowData[ self::UPDATE_TIME],
                    self::IS_ACTIVE => $rowData[ self::IS_ACTIVE],
                    self::SORT_ORDER => $rowData[ self::SORT_ORDER],
                    self::LAYOUT_UPDATE => $rowData[ self::LAYOUT_UPDATE],
                    self::CUSTOM_THEME => $rowData[ self::CUSTOM_THEME],
                    self::CUSTOM_ROOT => $rowData[ self::CUSTOM_ROOT],
                    self::CUSTOM_LAYOUT => $rowData[ self::CUSTOM_LAYOUT],
                    self::CUSTOM_THEME_FORM => $rowData[ self::CUSTOM_THEME_FORM],
                    self::CUSTOM_THEME_TO => $rowData[ self::CUSTOM_THEME_TO],
                    self::META_TITLE => $rowData[ self::META_TITLE],

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

    /**
     * Save product prices.
     *
     * @param array $priceData
     * @param string $table
     * @return $this
     */
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
