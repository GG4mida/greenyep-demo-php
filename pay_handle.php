<?php
    /**
     * 下单逻辑
     */

    require_once('config.php');
    require_once('helper.php');

    // 支付金额
    // 必填
    $payAmount = $_POST['amount'];

    // 支付类型，支付宝 = 1，微信 = 2
    // 必填
    $payType = $_POST['type'];

    if(!isset($payAmount) || !isset($payType)) {
        die("请求参数异常。");
    }

    // 商户 uid
    // 必填
    $payMerchId = MERCHANT_UID;     

    // 商户 token
    // 必填
    $payMerchToken = MERCHANT_TOKEN; 

    // 收款账号
    // 选填
    $payAccount = "";

    // 支付成功后通知回调地址，必须是公网地址
    // 必填
    $payNotifyUrl = "http://www.greenyep-demo-php.com/pay_notify.php";

    // 支付成功后同步跳转地址，必须是公网地址
    // 如果是自定义收银台，可不指定。
    $payRedirectUrl = "http://www.greenyep-demo-php.com/pay_result.php";

    // 自定义订单号
    // 选填
    $payOrderId = _getRandomCode(12);

    // 自定义用户编号
    // 选填
    $payCustomerId = _getRandomCode(12);

    // 商品名称
    // 选填
    $payProductName = "TEST PRODUCT NAME";

    // 将上述参数进行 md5-32 处理
    $paySignature = md5($payMerchId. $payAmount. $payType. $payAccount. $payOrderId. $payCustomerId. $payProductName. $payNotifyUrl. $payRedirectUrl. $payMerchToken);

    $payData = array(
        "uid" => $payMerchId,
        "amount" => $payAmount,
        "type" => $payType,
        "account" => $payAccount,
        "order_id" => $payOrderId,
        "customer_id" => $payCustomerId,
        "product_name" => $payProductName,
        "notify_url" => $payNotifyUrl,
        "redirect_url" => $payRedirectUrl,
        "signature" => $paySignature
    );

    $payApi = API_TRANSACTION_CREATE;

    try {
        $result = _http_post($payApi, $payData);
        $result = json_decode($result);

        if($result->code != 200) {
            die($result->content);
        }

        $txnId = $result->content->txn_id;
        $amount = $result->content->amount;
        $amountPay = $result->content->amount_pay;
        $timeout = $result->content->timeout;
        $cashierUrl = $result->content->cashier_url;
        $qrcodeUrl = $result->content->qrcode_url;
        $queryUrl = $result->content->query_url;
        $signature = $result->content->signature;

        $signatureData = md5($txnId. $amount. $amountPay. $timeout. $cashierUrl. $qrcodeUrl. $queryUrl. MERCHANT_TOKEN);

        if($signature != $signatureData) {
            die("签名串不匹配。");
        }

        // 这里可以跳转至 cashier_url（官方收银台），供用户支付。
        // 也可以使用返回的数据，自定义收银台。

        header('Location: '.$cashierUrl);
        exit();

    } catch (Exception $e) {
        die($e->getMessage());
    }
?>