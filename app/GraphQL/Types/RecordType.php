<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RecordType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Record',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Id record'
            ],
            'amount' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Amount record'
            ],
            'type' => [
                'type' => Type::nonNull(GraphQL::type('operation')),
                'description' => 'Type record'
            ],
            'date' => [
                'type' => Type::nonNull(GraphQL::type('date')),
//                'type' => Type::string(),
                'description' => 'Date record',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description record'
            ],
            'tags' => [
                'type' => Type::string(),
                'description' => 'Tags record'
            ],
            'note' => [
                'type' => Type::string(),
                'description' => 'Note record'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('user')),
                'description' => 'user',
            ],
            'account' => [
                'type' => Type::nonNull(GraphQL::type('accounts')),
                'description' => 'account',
            ],
            'category' => [
                'type' => GraphQL::type('categories'),
                'description' => 'category',
            ],
        ];
    }
}
