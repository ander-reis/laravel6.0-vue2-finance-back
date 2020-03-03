<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CreateAccountType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CreateAccount',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do usuário no banco'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'A descrição de account'
            ],
            'user' => [
                'type' => Type::listOf(GraphQL::type('user')),
                'description' => 'user account',
            ]
        ];
    }
}
