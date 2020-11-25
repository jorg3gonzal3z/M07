<?php
session_start();
include("funcions.php");

require 'stripe/init.php';
\Stripe\Stripe::setApiKey('sk_test_51HowCgCH8plbppBNlnIHkBbcp0Q7DjETtzJiFqz7zRCZYdmb7am0CammmOceeM2Na0nbGuqr07MXR6n4FvBn8Chq00soC0yfOF');
$_SESSION["Token"]=generate_string(200);

header('Content-Type: application/json');
//server javi//
$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $_SESSION["lista_precios"],
      'product_data' => [
        'name' => 'Stubborn Attachments',
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  //paginas de mi server_javi a las que redirigo en estos casos//
  'success_url' => $YOUR_DOMAIN . '/jgonzalez/M07/activitat_6_i_7/success.php?token='.$_SESSION["Token"],//si el pago es correcto
  'cancel_url' => $YOUR_DOMAIN . '/jgonzalez/M07/activitat_6_i_7/cancel.php',//si hay algun tipo de error
]);

echo json_encode(['id' => $checkout_session->id]);
