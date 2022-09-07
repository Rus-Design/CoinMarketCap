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
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
jQuery(document).ready(function($){

    $("#amount_coin").select2({
        templateResult: formatCoins,
        dropdownAutoWidth: true
    });

    $("#convert_result_coin").select2({
    templateResult: formatCoins,
        dropdownAutoWidth: true
});

    $('.conver_select').on('change',function(e) {
        var amount = $("input[name=amount]").val();
        var amount_coin = $("select[name=amount_coin]").val();
        var convert_result_coin = $("select[name=convert_result_coin]").val();
        var convert_result = $("input[name=convert_result]").val();
        $.ajax({
            type: "post",
            url: "/module/CoinMarketCap/ConvertAjax",
        data:{
            amount: amount,
            amount_coin: amount_coin,
            convert_result_coin: convert_result_coin,
        },
            success: function(price){
                convert_result = price;
                $('#convert_result').val(price);
            }
    });
    });
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms (5 seconds)

//on keyup, start the countdown
    $('.convert_input').bind('input',function(){
        clearTimeout(typingTimer);
        if ($('.convert_input').val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

//user is "finished typing," do something
    function doneTyping () {
        var amount = $("input[name=amount]").val();
        var amount_coin = $("select[name=amount_coin]").val();
        var convert_result_coin = $("select[name=convert_result_coin]").val();
        var convert_result = $("input[name=convert_result]").val();
        $.ajax({
            type: "post",
            url: "/module/CoinMarketCap/ConvertAjax",
            data:{
                amount: amount,
                amount_coin: amount_coin,
                convert_result_coin: convert_result_coin,
            },
            success: function(price){
                convert_result = price;
                $('#convert_result').val(price);
            }
        });
    }

    // $('.convert_input').bind('input',function(e){
    //     var amount = $("input[name=amount]").val();
    //     var amount_coin = $("select[name=amount_coin]").val();
    //     var convert_result_coin = $("select[name=convert_result_coin]").val();
    //     var convert_result = $("input[name=convert_result]").val();
    //     $.ajax({
    //         type: "post",
    //         url: "/module/CoinMarketCap/ConvertAjax",
    //         data:{
    //             amount: amount,
    //             amount_coin: amount_coin,
    //             convert_result_coin: convert_result_coin,
    //         },
    //         success: function(price){
    //             convert_result = price;
    //             $('#convert_result').val(price);
    //         }
    //     });
    // });

});

function formatCoins (coins) {
    if (!coins.id) {
        return coins.text;
    }
    var image = "https://s2.coinmarketcap.com/static/img/coins/32x32/" + coins.element.getAttribute("data-id") + ".png";
    var $coins = $(
        '<span class="coins_list"><img src="' + image + '" class="img-flag coins_image" /> ' + coins.text + ' - ' + coins.element.getAttribute("data-name") +'</span>'
    );
    return $coins;
};