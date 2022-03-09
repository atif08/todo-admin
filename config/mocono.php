<?php
return [
    'https_mocono_base_url' => env('HTTPS_MOCONO_BASE_URL'),
    'mocono_support_team_email' => env('MOCONO_SUPPORT_TEAM_EMAIL'),
    'protocol_wordpress' => env('PROTOCOL_WORDPRESS'),
    'test_password_wordpress' => env('TEST_PASSWORD'),
    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
    'stripe_currency_charge' => env('STRIPE_CURRENCY_CHARGE'),
    'currency_symbol' => env('CURRENCY_SYMBOL'),
    'currency' => env('CURRENCY'),
    'mocono_comission_rate' => env('MOCONO_COMISSION_RATE'),
    'sales_tax' => env('SALES_TAX'),

    'userType' => [
        'publishers' => 1,
        'subscriber' => 2,
        'normal' => 0,
    ],
    'membershipType' => [
        'days' => 1,
        'monthly' => 2,
        'yearly' => 3,
        'free_trial' => 4,
    ],
    'paywall' => [
        'roleType' => [
            'after_certain_number_articles' => 1,
            'after_certain_amount_time_days' => 2,
            'after_certain_amount_time_weeks' => 3,
            'after_certain_amount_time_monthly' => 4,
            'after_certain_amount_time_yearly' => 5,
            'for_all_articles_with_following_tags' => 6,
            'every_thing' => 7,
        ]
    ],
    'abTest' => [
        'type' => [
            '1' => 'pricing',
            '2' => 'branding',
            '3' => 'rules',
        ]
    ],
    'emailOption' => [
        'welcome' => 1, //This email will  be sent whenever a new subscriber successfully registers for a subscription.
        'invoice' => 2,
        'card_expiring' => 3,
        'payment_failed' => 4,
        'subscription_cancelled_auto' => 5,
        'cancel' => 6,
        'restart' => 7,
        'subscription_renewal_due' => 8,
        'inactivity' => 9,
        'reset_password' => 10,
        'subscription_paused_auto' => 11,
        'subscription_paused' => 12,
        'payment_received' => 13,
    ]
];
