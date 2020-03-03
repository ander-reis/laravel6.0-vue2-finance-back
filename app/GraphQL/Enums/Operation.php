<?php

declare(strict_types=1);

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class Operation extends EnumType
{
    protected $attributes = [
        'name' => 'Operation',
        'description' => 'Operation enum',
        'values' => [
            'DEBIT' => 'DEBIT',
            'CREDIT' => 'CREDIT'
        ],
    ];
}
