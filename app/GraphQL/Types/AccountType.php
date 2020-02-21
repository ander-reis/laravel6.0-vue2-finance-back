<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Account;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AccountType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Account',
        'description' => 'A type',
        'model' => Account::class
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
                'type' => GraphQL::type('user'),
                'description' => 'user account',
                'always' => ['id', 'name'],
//                'query' => function(array $args, $query){
//                    return $query->where('id', '=', $args['id']);
//                }
            ]
        ];
    }
}
