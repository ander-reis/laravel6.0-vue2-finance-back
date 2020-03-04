<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TotalBalanceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'TotalBalance',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'totalBalance' => [
                'type' => Type::float(),
                'description' => 'totalBalance float'
            ]
        ];
    }
}
