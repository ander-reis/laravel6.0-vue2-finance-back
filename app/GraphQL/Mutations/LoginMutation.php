<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\User;
use Auth;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginMutation extends Mutation
{

    protected $attributes = [
        'name' => 'login',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('login');
    }

    public function args(): array
    {
        return [
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

//        $user = User::with(array_keys($fields->getRelations()))
//            ->where('id', $this->auth->id)
//            ->select($fields->getSelect())->first();

        $input = ['email' => $args['email'], 'password' => $args['password']];
        $token = null;
        $token = JWTAuth::attempt($input);
        if (!$token) {
            return false;
        }
        return ['token' => $token];
    }
}
