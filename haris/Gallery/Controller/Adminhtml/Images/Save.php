<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/3/2016
 * Time: 6:56 PM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Images;

use Magento\Backend\App\Action;
use Magento\Framework\Filesystem;

class Save extends Action
{


    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $adapterFactory;
    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploader;
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */

    public function __construct(
        Action\Context $context,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem

    )
    {
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();

        $model = $this->_objectManager
            ->create('Perficient\Gallery\Model\Images');

        $requestData = $this->getRequest()->getParams();

        $id = $this->getRequest()->getParam('image_id');
        $data = array();
        if ($id) {
            $data['image_id'] = $id;
            $model->load($id);
        }
        if (isset($_FILES['image_url']) && isset($_FILES['image_url']['name']) && strlen($_FILES['image_url']['name'])) {
            /*
            * Save image upload
            */

            try {
                $base_media_path = 'perficient/gallery/images/';
                $uploader = $this->uploader->create(
                    ['fileId' => 'image_url']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                $imageAdapter = $this->adapterFactory->create();

                $uploader->addValidateCallback(
                    'image_url',
                    $imageAdapter, 'validateUploadFile');

                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $result = $uploader->save(
                    $mediaDirectory->getAbsolutePath($base_media_path)
                );


                if ($result) {

                    $data['image_url'] = $base_media_path . $result['file'];
                    $data['description'] = $requestData['description'];
                    $data['status'] = $requestData['status'];

                    $model->setData($data);
                    $model->save();

                    $this->messageManager
                        ->addSuccess('Image information saved succesfully');

                    return $resultRedirect->setPath('*/*/');
                }
                $this->_getSession()->setFormData($data);


            } catch (\Exception $e) {

                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }

        } else {
            try {
                $model->setData($requestData);
                $model->save();
                $this->messageManager
                    ->addSuccess('Image information saved succesfully');
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }

        }


    }
}