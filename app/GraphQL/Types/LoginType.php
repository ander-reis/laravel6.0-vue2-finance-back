<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class LoginType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Login',
        'description' => 'A type',
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'token'
            ],
//            'user' => [
//                'type' => GraphQL::type('user'),
//                'description' => 'user login',
//                'always' => ['id', 'name', 'email'],
//                'query' => function(array $args, $query){
//                    return $query->where('email', '=', $args['email'])->first();
//                }
//            ]
        ];
    }
}
