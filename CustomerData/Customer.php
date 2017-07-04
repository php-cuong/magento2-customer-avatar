<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-04 18:41:56
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-04 22:19:51
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerAttributes\CustomerData;


use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;
use PHPCuong\CustomerAttributes\Block\Attributes\Avatar;

class Customer
{
    /**
     * @var Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var \Magento\Customer\Helper\View
     */
    protected $customerViewHelper;

    /**
     * @var \PHPCuong\CustomerAttributes\Block\Attributes\Avatar $avatar
     */
    protected $customerAvatar;

    /**
     * @param CurrentCustomer $currentCustomer
     * @param View $customerViewHelper
     * @param Avatar $customerAvatar
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        View $customerViewHelper,
        Avatar $customerAvatar
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->customerViewHelper = $customerViewHelper;
        $this->customerAvatar = $customerAvatar;
    }

    /**
     * {@inheritdoc}
     */
    public function afterGetSectionData()
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return [];
        }
        $customer = $this->currentCustomer->getCustomer();
        return [
            'fullname' => $this->customerViewHelper->getCustomerName($customer),
            'firstname' => $customer->getFirstname(),
            'avatar' => $this->customerAvatar->getAvatarCurrentCustomer($customer->getCustomAttribute('customer_picture')->getValue())
        ];
    }
}
