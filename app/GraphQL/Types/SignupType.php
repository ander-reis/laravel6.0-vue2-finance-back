<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SignupType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Signup',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'token'
            ],
        ];
    }
}
