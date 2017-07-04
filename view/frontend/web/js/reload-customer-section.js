/*
* @Author: Ngo Quang Cuong
* @Date:   2017-07-04 22:07:24
* @Last Modified by:   nquangcuong
* @Last Modified time: 2017-07-04 22:07:43
*/
require([
    'Magento_Customer/js/customer-data'
], function (customerData) {
    var sections = ['customer'];
    customerData.invalidate(sections);
    customerData.reload(sections, true);
});
