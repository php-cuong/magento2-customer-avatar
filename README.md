# You can get the professional version of this extension here (No issues and is supported free)
https://www.giaphugroup.com/magento-2-customer-avatar-extension.html

# How to add the profile picture for a customer in Magento 2
This is an awesome module, it allows the customers the opportunity to personalize their account by uploading an avatar.

Please donate if you enjoy my extension.

[![](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CR756BABGNDC4)

## See the video How I can make this extension here
https://www.youtube.com/watch?v=akcaOBrLTzM&list=PL98CDCbI3TNvPczWSOnpaMoyxVISLVzYQ

## The features of this extension:
### Frontend:
- The customer can upload a new avatar.
- The avatar can be displayed in the header of the website.
- The avatar can be displayed in the reviews list.

### Backend:
- Display the avatar of the customer in the customer's grid of Magento Admin.
- Upload a new avatar or delete an avatar of the customer.

## Introduction installation:

### 1 - Using Composer

```
composer require php-cuong/magento2-customer-avatar:dev-master

```

### 2- Enable the Customer Avatar extension
 * php bin/magento setup:upgrade
 * php bin/magento setup:static-content:deploy
 * php bin/magento indexer:reindex
 * php bin/magento cache:flush

### 3 - See results
#### Frontend
Log into your customer account, go to Edit Account Information

##### The avatar in the header

![ScreenShot](https://raw.githubusercontent.com/php-cuong/magento2-customer-avatar/master/Snapshot/header-avatar.png)

##### The avatar in the edit account information

![ScreenShot](https://raw.githubusercontent.com/php-cuong/magento2-customer-avatar/master/Snapshot/upload-new-avatar.png)

##### The avatar in the reviews list

![ScreenShot](https://raw.githubusercontent.com/php-cuong/magento2-customer-avatar/master/Snapshot/customer-review.png)

#### Backend
Log into your Magento admin, go to Customers -> All Customers

##### The avatar in the customer's grid of Magento Admin

![ScreenShot](https://raw.githubusercontent.com/php-cuong/magento2-customer-avatar/master/Snapshot/avatar-in-customer-grid.png)

##### Upload a new avatar or delete an avatar of the customer

![ScreenShot](https://raw.githubusercontent.com/php-cuong/magento2-customer-avatar/master/Snapshot/upload-delete-an-avatar.png)

## Donations
Please donate if you enjoy my extension.

[![](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CR756BABGNDC4)


