<?php

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/stripe.php';

        Stripe::setApiKey(
            $this->config['secret_key']
        );
    }

    public function createCheckoutSession(array $booking): string
    {
        $amount = (int) ($booking['total_price'] * 100);
        

        $consultationLabel =
            $booking['type'] === 'consultation_video'
            ? 'Consultation vidéo'
            : 'Consultation à domicile';

        $session = Session::create([
            'mode' => 'payment',

            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',

                    'product_data' => [
                        'name' => $consultationLabel
                    ],

                    'unit_amount' => $amount
                ],

                'quantity' => 1
            ]],

            'success_url' =>
                'http://localhost/Therazen/public/?page=stripe-success&session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' =>
                'http://localhost/Therazen/public/?page=booking-informations'
        ]);

        return $session->url;
    }
    public function getSession(string $sessionId): Session
{
    return Session::retrieve($sessionId);
}
}