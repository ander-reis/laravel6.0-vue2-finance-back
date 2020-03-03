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
                'type' => Type::int(),
                'description' => 'Id record'
            ],
            'amount' => [
                'type' => Type::float(),
                'description' => 'Amount record'
            ],
            'type' => [
                'type' => GraphQL::type('operation'),
                'description' => 'Type record'
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date record',
                'resolve' => function($model) {
                    return (string) Carbon::parse($model->date)->format('Y-m-d');
                }
            ],
            'description' => [
                'type' => Type::string(),
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
                'type' => GraphQL::type('user'),
                'description' => 'user',
            ],
            'account' => [
                'type' => GraphQL::type('accounts'),
                'description' => 'account',
            ],
            'category' => [
                'type' => GraphQL::type('categories'),
                'description' => 'category',
            ],
        ];
    }
}
