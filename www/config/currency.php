<?php

use App\Enums\Currency;

return [
    'supported_currencies' => [Currency::TWD, Currency::USD],
    'currency_to_twd_rate' => [
        Currency::TWD => 1,
        Currency::USD => 31,
    ]
];