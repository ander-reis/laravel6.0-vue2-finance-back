<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Record;
use Carbon\Carbon;
use Closure;
use GraphQL;
use JWTAuth;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class RecordQuery extends Query
{
    protected $attributes = [
        'name' => 'record',
        'description' => 'A query'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('records'));
    }

    public function args(): array
    {
        return [
            'month' => [
                'type' => Type::string(),
                'description' => 'month record'
            ],
            'type' => [
                'type' => GraphQL::type('operation'),
                'description' => 'operation record'
            ],
            'accountsIds' => [
                'type' => Type::listOf(GraphQL::type('accounts')),
                'description' => 'account record id'
            ],
            'categoriesIds' => [
                'type' => Type::listOf(GraphQL::type('categories')),
                'description' => 'categories record id'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $userId = auth()->user()->id;
//        $record = Record::where('user_id', $userId)->get();

        $date = Carbon::now();
        $date_start = $date->parse('01-' . $args['month'])->format('Y-m-d');
        $date_end = $date->format('Y-m-d');

//        $record = Record::where('user_id', $userId)
//            ->where('type', '=', $args['type'] ?? null)
//            ->where('account_id', $args['accountsIds'] ?? null)
//            ->whereBetween('date' , [$date_start, $date_end])
//            ->orderBy('date')
//            ->get();

//        dd($record);


        $record = JWTAuth::user()->records;
        return $record;
    }
}
