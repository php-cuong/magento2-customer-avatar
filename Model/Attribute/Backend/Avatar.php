<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-03 08:33:28
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-03 14:39:56
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerAttributes\Model\Attribute\Backend;

use \PHPCuong\CustomerAttributes\Model\Source\Validation\Image;

class Avatar extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @param \Magento\Framework\DataObject $object
     *
     * @return $this
     */
    public function beforeSave($object)
    {
        $validation = new Image();
        $attrCode = $this->getAttribute()->getAttributeCode();
        if ($attrCode == 'customer_picture') {
            if ($validation->isImageValid('tmpp_name', $attrCode) === false) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The avatar is not a valid image.')
                );
            }
        }

        return parent::beforeSave($object);
    }
}
