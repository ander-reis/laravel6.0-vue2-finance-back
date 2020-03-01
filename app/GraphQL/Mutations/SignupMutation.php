<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\User;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Tymon\JWTAuth\Facades\JWTAuth;

class SignupMutation extends Mutation
{
    protected $attributes = [
        'name' => 'signup',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('signup');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'email'
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'password'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => Hash::make($args['password']),
        ]);

        $credentials = ['email' => $args['email'], 'password' => $args['password']];
        $token = null;
        $token = JWTAuth::attempt($credentials);

        return ['token' => $token] ?? null;
    }
}
