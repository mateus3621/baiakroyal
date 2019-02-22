<?php

require_once 'custom_scripts/PagSeguroLibrary/PagSeguroLibrary.php';
require 'config/config.php';

$paymentRequest = new PagSeguroPaymentRequest();
$paymentRequest->addItem('1', $config['pagSeguro']['productName'], $_POST['itemCount'], $config['pagSeguro']['productValue']);
$paymentRequest->setCurrency("BRL");
$paymentRequest->setReference($_POST['reference']);
$paymentRequest->setRedirectUrl($config['pagSeguro']['urlRedirect']);
$paymentRequest->addParameter('notificationURL', $config['pagSeguro']['urlNotification']);

try {

	$credentials = PagSeguroConfig::getAccountCredentials();
	$checkoutUrl = $paymentRequest->register($credentials);
	header('location:' . $checkoutUrl);

} catch (PagSeguroServiceException $e) {
	die($e->getMessage());
}

?>