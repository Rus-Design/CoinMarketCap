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


include_once(dirname(__FILE__) . '/../../config/config.inc.php');
include_once(dirname(__FILE__) . '/../../init.php');

class CoinMarketCapConvertAjaxModuleFrontController extends ModuleFrontController
{
    public $coin_amount;
    public $coin_amount_selected;
    public $coin_result_selected;
    public $coin_price_amount;

    public function initContent() {
        parent::initContent();
        $this->ajax = true;
        $this->convert();
        $this->setDataInDb();
        die();
    }

    public function convert() {

        $api_key = Configuration::get('COINMARKETCAP_API_KEY');
        $url = 'https://pro-api.coinmarketcap.com/v2/tools/price-conversion';

        $this->coin_amount = Tools::getValue('amount');
        $coin_result = Tools::getValue('convert_result');
        $this->coin_amount_selected = Tools::getValue('amount_coin');
        $this->coin_result_selected = Tools::getValue('convert_result_coin');

        $parameters = [
            'symbol' => $this->coin_amount_selected,
            'amount' => $this->coin_amount,
            'convert' => $this->coin_result_selected
        ];
        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: '.$api_key
        ];
        $qs = http_build_query($parameters);
        $request = "{$url}?{$qs}";


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => 1,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $coin_result_selected_price = json_decode($response)->data[0]->quote;

        foreach ($coin_result_selected_price as $result_price) {
            $this->coin_price_amount = $result_price->price;

        }

        echo $this->coin_price_amount;

    }

    public function setDataInDb() {
        $db = Db::getInstance();
        $ip_address = Tools::getRemoteAddr();
        
//        $count_rows = $db->getValue("SELECT count(*) FROM `" . _DB_PREFIX_ . "CoinMarketCap`");

        $sql = "REPLACE INTO `" . _DB_PREFIX_ . "CoinMarketCap` (
        `ip_address`,
        `amount_coins`,
        `select_amount_coin`,
        `result_convert_coin`)
        VALUES (
        '$ip_address',
        '$this->coin_amount',
        '$this->coin_amount_selected',
        '$this->coin_result_selected')
        ";

        $result = $db->Execute($sql);

    }
}

