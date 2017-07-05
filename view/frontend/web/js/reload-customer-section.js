/*
* @Author: Ngo Quang Cuong
* @Date:   2017-07-04 22:07:24
* @Last Modified by:   nquangcuong
* @Last Modified time: 2017-07-05 10:23:38
*/
require([
    'Magento_Customer/js/customer-data'
], function (customerData) {
    var sections = ['customer'];
    customerData.invalidate(sections);
});
