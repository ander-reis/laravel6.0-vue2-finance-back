<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Record;
use Closure;
use JWTAuth;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class TotalBalanceQuery extends Query
{
    protected $attributes = [
        'name' => 'totalBalance',
        'description' => 'A query'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return Type::float();
    }

    public function args(): array
    {
        return [
            'date' => [
//                'type' => Type::string(),
                'type' => GraphQL::type('date'),
                'description' => 'date amount record'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $totalBalance = JWTAuth::user()->records->where('date', '<=', $args['date'])->sum('amount');

        return $totalBalance;
    }
}
