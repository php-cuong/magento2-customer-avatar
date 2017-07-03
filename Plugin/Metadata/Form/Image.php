<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-03 11:15:40
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-03 14:41:20
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerAttributes\Plugin\Metadata\Form;

class Image
{
    protected $validImage;

    public function __construct(
        \PHPCuong\CustomerAttributes\Model\Source\Validation\Image $validImage
    ) {
        $this->validImage = $validImage;
    }

    /**
     * {@inheritdoc}
     *
     * @return ImageContentInterface|array|string|null
     */
    public function beforeExtractValue(\Magento\Customer\Model\Metadata\Form\Image $subject, $value)
    {
        $attrCode = $subject->getAttribute()->getAttributeCode();

        if ($this->validImage->isImageValid('tmp_name', $attrCode) === false) {
            $_FILES[$attrCode]['tmpp_name'] = $_FILES[$attrCode]['tmp_name'];
            unset($_FILES[$attrCode]['tmp_name']);
        }

        return [];
    }
}
