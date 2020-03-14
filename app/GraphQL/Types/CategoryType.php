<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Id da categoria'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descrição da categoria'
            ],
            'operation' => [
                'type' => Type::nonNull(GraphQL::type('operation')),
                'description' => 'Operação da categoria'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'user account',
//                'always' => ['id', 'name'],
            ]
        ];
    }
}
