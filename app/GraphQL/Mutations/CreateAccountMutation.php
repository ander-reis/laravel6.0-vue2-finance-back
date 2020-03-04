<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\User;
use Closure;
use GraphQL;
use JWTAuth;
use App\Account;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;


class CreateAccountMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createAccount',
        'description' => 'A mutation'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return GraphQL::type('accounts');
    }

    public function args(): array
    {
        return [
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'description'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $userId = auth()->user()->id;

        $account =  Account::create([
            'description' => $args['description'],
            'user_id' => $userId
        ]);

        return [
            'id' => $account->id,
            'description' => $account->description,
            'user' => $account->user
        ];
    }
}
