{*
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
*}
<div class="coin_market_cap_block col-md-12">
    <h3>{l s='Cryptocurrency Converter' mod='CoinMarketCap'}</h3>
<div class="convert_form">
    <div class="form_group">
        <input type="text" name="amount" value="1" class="convert_input">
        <select name="amount_coin" class="conver_select" id="amount_coin">
            {foreach $crypto_datas as $data}
                <option value="{$data['symbol']}" data-id="{$data['id']}" data-name="{$data['name']}"> {$data['symbol']}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_group">
        <input type="text" name="convert_result" value="1" id="convert_result" class="convert_input">
        <select name="convert_result_coin" class="conver_select" id="convert_result_coin">
            {foreach $crypto_datas as $data}
                <option value="{$data['symbol']}" data-id="{$data['id']}" data-name="{$data['name']}"> {$data['symbol']}</option>
            {/foreach}
        </select>
    </div>
</div>
    <div class="convert_history col-md-12">
        <h3 class="subheading">{l s='Recently converted' mod='CoinMarketCap'}</h3>
        {if $convert_history}
        <div class="col-md-6">
            <ul>
                {foreach array_slice($convert_history, 0, 5) as $convert}
                    <li>
                        {$convert["amount_coins"]} {$convert["select_amount_coin"]} {l s=' to ' mod='CoinMarketCap'} {$convert["result_convert_coin"]}
                    </li>
                {/foreach}
            </ul>
        </div>
        <div class="col-md-6">
        <ul>
            {foreach array_slice($convert_history, 5) as $convert}
                <li>
                    {$convert["amount_coins"]} {$convert["select_amount_coin"]} {l s=' to ' mod='CoinMarketCap'} {$convert["result_convert_coin"]}
                </li>
            {/foreach}
        </ul>
        </div>
        {/if}
    </div>
</div>
