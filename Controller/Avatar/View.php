<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-03 15:18:20
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-05 08:23:06
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerProfilePicture\Controller\Avatar;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\Exception\NotFoundException;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var \Magento\Framework\Url\DecoderInterface
     */
    protected $urlDecoder;

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Url\DecoderInterface $urlDecoder
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\Url\DecoderInterface $urlDecoder,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->resultRawFactory    = $resultRawFactory;
        $this->urlDecoder  = $urlDecoder;
        $this->fileFactory = $fileFactory;
        return parent::__construct($context);
    }

    /**
     * View action
     *
     * @return \Magento\Framework\View\Result\PageFactory
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $file = null;
        $plain = false;
        if ($this->getRequest()->getParam('file')) {
            // download file
            $file = $this->urlDecoder->decode(
                $this->getRequest()->getParam('file')
            );
        } elseif ($this->getRequest()->getParam('image')) {
            // show plain image
            $file = $this->urlDecoder->decode(
                $this->getRequest()->getParam('image')
            );
            $plain = true;
        } else {
            throw new NotFoundException(__('Page not found.'));
        }

        /** @var \Magento\Framework\Filesystem $filesystem */
        $filesystem = $this->_objectManager->get('Magento\Framework\Filesystem');
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $fileName = CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER . '/' . ltrim($file, '/');
        $path = $directory->getAbsolutePath($fileName);

        if (!$directory->isFile($fileName)
            && !$this->_objectManager->get('Magento\MediaStorage\Helper\File\Storage')->processStorageFile($path)
        ) {
            throw new NotFoundException(__('Page not found.'));
        }

        if ($plain) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            switch (strtolower($extension)) {
                case 'gif':
                    $contentType = 'image/gif';
                    break;
                case 'jpg':
                    $contentType = 'image/jpeg';
                    break;
                case 'png':
                    $contentType = 'image/png';
                    break;
                default:
                    $contentType = 'application/octet-stream';
                    break;
            }
            $stat = $directory->stat($fileName);
            $contentLength = $stat['size'];
            $contentModify = $stat['mtime'];

            /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
            $resultRaw = $this->resultRawFactory->create();
            $resultRaw->setHttpResponseCode(200)
                ->setHeader('Pragma', 'public', true)
                ->setHeader('Content-type', $contentType, true)
                ->setHeader('Content-Length', $contentLength)
                ->setHeader('Last-Modified', date('r', $contentModify));
            $resultRaw->setContents($directory->readFile($fileName));
            return $resultRaw;
        } else {
            $name = pathinfo($path, PATHINFO_BASENAME);
            $this->fileFactory->create(
                $name,
                ['type' => 'filename', 'value' => $fileName],
                DirectoryList::MEDIA
            );
        }
    }
}
