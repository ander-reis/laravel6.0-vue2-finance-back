<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Account;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AccountQuery extends Query
{
    protected $attributes = [
        'name' => 'account',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('accounts'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'id account'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        if(isset($args['id'])){
            return Account::where('id', $args['id'])->get();
        }

        $accounts = Account::select($select)->with($with);
        return $accounts->get();

//        return Account::with($with)->get();
    }
}
