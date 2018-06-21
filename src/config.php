<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_7XqrePNmYHrmwGlzr7eeZgxa",
  "publishable_key" => "pk_test_7mOhYK3kppbVTa1fS2VRFQ6A"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>