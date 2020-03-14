<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Category;
use Closure;
use GraphQL;
use JWTAuth;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'cotegory',
        'description' => 'A query'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('categories'))));
    }

    public function args(): array
    {
        return [
            'operation' => [
                'type' => GraphQL::type('operation'),
                'description' => 'Type operation'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $category = JWTAuth::user()->categories;

        return $category;
    }
}
