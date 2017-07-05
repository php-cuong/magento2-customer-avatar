<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-01 13:23:24
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-05 10:13:17
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerProfilePicture\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Avatar extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Framework\View\Element\AbstractBlock
     */
    protected $viewFileUrl;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->viewFileUrl = $viewFileUrl;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $customer = new \Magento\Framework\DataObject($item);
                $picture_url = !empty($customer["profile_picture"]) ? $this->urlBuilder->getUrl(
                    'customer/index/viewfile/image/'.base64_encode($customer["profile_picture"])) : $this->viewFileUrl->getUrl('PHPCuong_CustomerProfilePicture::images/no-profile-photo.jpg');
                $item[$fieldName . '_src'] = $picture_url;
                $item[$fieldName . '_orig_src'] = $picture_url;
                $item[$fieldName . '_alt'] = 'The profile picture';
            }
        }

        return $dataSource;
    }
}
