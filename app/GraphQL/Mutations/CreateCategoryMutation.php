<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Category;
use App\GraphQL\Enums\Operation;
use Closure;
use GraphQL;
use JWTAuth;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'A mutation'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('categories'));
    }

    public function args(): array
    {
        return [
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'description'
            ],
            'operation' => [
                'type' => Type::nonNull(GraphQL::type('operation')),
                'description' => 'operation'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $userId = auth()->user()->id;

        $operation =  Category::create([
            'description' => $args['description'],
            'operation' => strtoupper($args['operation']),
            'user_id' => $userId
        ]);

        return ['operation' => $operation];
    }
}
