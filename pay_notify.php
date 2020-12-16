<?php

    /**
    * 支付成功后通知回调地址
    */

    require_once('config.php');
    require_once('helper.php');

    $merchToken = MERCHANT_TOKEN; 

    $txnId = $_POST["txn_id"];
    $orderId = $_POST["order_id"];
    $amount = $_POST["amount"];
    $amountPay = $_POST["amount_pay"];
    $signature = $_POST["signature"];

    $signatureData = md5($txnId . $orderId . $amount . $amountPay . $merchToken);

    if ($signature != $signatureData){
        _log('支付失败：加密串不匹配。');
    } else {
        _log('支付成功：执行订单支付成功的逻辑，比如增加用户积分，延长服务时间等...');
    }
?>