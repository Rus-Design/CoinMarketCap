<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'CoinMarketCap` (
`convert_id` int(32) NOT NULL AUTO_INCREMENT,
`convert_date` timestamp DEFAULT CURRENT_TIMESTAMP, 
`ip_address` varchar(32) DEFAULT NULL, 
`amount_coins` varchar(32) DEFAULT NULL, 
`select_amount_coin` varchar(32) DEFAULT NULL, 
`result_convert_coin` varchar(32) DEFAULT NULL,
PRIMARY KEY (`convert_id`),
 UNIQUE `convert_date_ip_address` (`convert_date`, `ip_address`)
 )
ENGINE=' . _MYSQL_ENGINE_ . ' 
DEFAULT CHARSET=utf8;
';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
