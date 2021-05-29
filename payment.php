<?php

require_once('config.php');
require('../../vendor/libs/razorpay/2.7.0/Razorpay.php');
session_start();

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

$receipt = "1234";
$amount = "599";


$orderData = [
    'receipt'         => $receipt,
    'amount'          => $amount * 100, // Rupees in Paise
    'currency'        => 'INR',
    'payment_capture' => 1 // Auto Capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "DJ Tiesto",
    "description"       => "Tron Legacy",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => "customer@merchant.com",
    "contact"           => "9999999999",
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

$json = json_encode($data);

require("checkout/automatic.php");
