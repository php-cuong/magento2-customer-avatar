<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-03 14:09:36
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-05 08:32:11
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerProfilePicture\Model\Source\Validation;

class Image
{
    /**
     * Check the image file
     * @param $tmp_name, $attrCode
     * @return bool
     */
    public function isImageValid($tmp_name, $attrCode)
    {
        if ($attrCode == 'profile_picture') {
            if (!empty($_FILES[$attrCode][$tmp_name])) {
                $imageFile = @getimagesize($_FILES[$attrCode][$tmp_name]);
                if ($imageFile === false) {
                    return false;
                } else {
                    $valid_types = ['image/gif', 'image/jpeg', 'image/png'];
                    if (!in_array($imageFile['mime'], $valid_types)) {
                        return false;
                    }
                }
                return true;
            }
        }
        return true;
    }
}
