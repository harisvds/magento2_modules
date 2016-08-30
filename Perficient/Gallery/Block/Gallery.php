<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/6/2016
 * Time: 12:28 PM
 */

namespace Perficient\Gallery\Block;

use Magento\Framework\View\Element\Template;
use Perficient\Gallery\Model\GalleryFactory;
use Perficient\Gallery\Model\ImagesFactory;


class Gallery extends Template
{
    protected $_resultGalleryFactory;
    protected $_resultImageFactory;

    public function __construct(
        Template\Context $context,
        GalleryFactory $galleryFactory,
        ImagesFactory $imagesFactory,
        array $data)
    {
        $this->_resultGalleryFactory = $galleryFactory;
        $this->_resultImageFactory = $imagesFactory;
        parent::__construct($context, $data);
        // echo "IN side constructr";exit;
    }

    public function getGalleryData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->get('Magento\Framework\Registry')
            ->registry('current_category');//get current category
        $catId = $category->getId();
        $gallries = $this->getGallery($catId);

        $data = array();
        foreach ($gallries->getData() as $gallery) {
            $data['title'] = $gallery['gallery_code'];
            $data['images'] = $this->getImages($gallery['image_ids'])->getData();
        }

        return $data;
    }

    public function getGallery($catId = null)
    {

        $gallery = $this->_resultGalleryFactory->create()
            ->getCollection()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('category_ids', array('finset' => $catId));
        // echo "dfaf".$gallery->getSelect()->__toString(); exit;
        return $gallery;
    }

    public function getImages($ids)
    {
        $images = $this->_resultImageFactory->create()
            ->getCollection()
            ->addFieldToSelect('image_url')
            ->addFieldtoFilter('status', 1)
            ->addFieldToFilter('image_id', array('in' => explode(',', $ids)));
        return $images;

    }

}
