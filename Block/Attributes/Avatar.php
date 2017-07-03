<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-02 12:04:38
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-03 22:29:46
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerAttributes\Block\Attributes;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\ObjectManagerInterface;

class Avatar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\View\Element\AbstractBlock
     */
    protected $viewFileUrl;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     *
     * @param Context $context
     * @param QuestionHelper $questionHelper
     * @param CategoryHelper $categoryHelper
     * @param DirectoryList $directoryList
     * @param FaqResourceModel $faqResourceModel
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        \Magento\Framework\App\Http\Context $httpContext
    ) {
        $this->objectManager = $objectManager;
        $this->viewFileUrl = $viewFileUrl;
        $this->httpContext = $httpContext;
        parent::__construct($context);
    }

    public function checkImageFile($file)
    {
        $file = base64_decode($file);
        $filesystem = $this->objectManager->get('Magento\Framework\Filesystem');
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $fileName = CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER . '/' . ltrim($file, '/');
        $path = $directory->getAbsolutePath($fileName);
        if (!$directory->isFile($fileName)
            && !$this->objectManager->get('Magento\MediaStorage\Helper\File\Storage')->processStorageFile($path)
        ) {
            return false;
        }
        return true;
    }

    public function getVatarFile()
    {
        $customerSession = $this->objectManager->get('Magento\Customer\Model\Session');
        if($customerSession->isLoggedIn()) {
            if (!empty($customerSession->getCustomer()->getCustomerPicture())) {
                $file = $customerSession->getCustomer()->getCustomerPicture();
                if ($this->checkImageFile(base64_encode($file)) === true) {
                    return $this->getUrl('viewfile/avatar/view/', ['image' => base64_encode($file)]);
                }
            }
        }
        return $this->viewFileUrl->getUrl('PHPCuong_CustomerAttributes::images/no-profile-photo.jpg');
    }
}
