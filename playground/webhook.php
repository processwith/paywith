<?php
use ProcessWith\ProcessWith;

require '../vendor/autoload.php';
require 'config.php';

$amount = '1000';
$email  = 'ikwuje@gmail.com';

$processwith = new ProcessWith('paystack', PSTK_SECRET_KEY);

$transaction = $processwith->transaction();
$transaction->webhook();

// // file_put_contents( 'hook.txt', $transaction->webhook() );

if ($transaction->status()) {
    // check the email and the amount
    // before giving value
    if ( $amount == $transaction->getAmount() && $email == $transaction->getEmail() ) {
        file_put_contents( 'results/hook.txt', 'Webhook: Thanks for making a payment' );
    }
    else {
        file_put_contents( 'results/hook.txt', 'Webhook: Amount does not match' );
    }
}
else {
    file_put_contents( 'results/hook.txt', $transaction->getMessage() );
}