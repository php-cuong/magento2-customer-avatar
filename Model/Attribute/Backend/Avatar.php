<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-03 08:33:28
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-05 08:30:51
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerProfilePicture\Model\Attribute\Backend;

use \PHPCuong\CustomerProfilePicture\Model\Source\Validation\Image;

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
        if ($attrCode == 'profile_picture') {
            if ($validation->isImageValid('tmpp_name', $attrCode) === false) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The profile picture is not a valid image.')
                );
            }
        }

        return parent::beforeSave($object);
    }
}
