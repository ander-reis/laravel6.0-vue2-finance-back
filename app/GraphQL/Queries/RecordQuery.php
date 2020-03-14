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
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('records'))));
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
                'type' => Type::listOf(Type::id()),
                'description' => 'account record id'
            ],
            'categoriesIds' => [
                'type' => Type::listOf(Type::id()),
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
        $month = isset($args['month']) ? $args['month'] : null;
        $date_start = null;
        $date_end = null;
        $type = isset($args['type']) ? $args['type'] : null;
        $accountId = isset($args['accountsIds']) ? $args['accountsIds'] : null;
        $categoryId = isset($args['categoriesIds']) ? $args['categoriesIds'] : null;

        if (isset($month)) {
            $data = $month ? explode('-', $month) : null;
            $mes = $data[0];
            $ano = $data[1];

            $date = Carbon::parse("{$ano}-{$mes}");
            $date_start = $date->parse('01-' . $args['month'])->format('Y-m-d');
            $date_end = $date->parse('30-' . $args['month'])->format('Y-m-d');

            //dd($date, $date->copy()->startOfMonth(), $date->endOfMonth()->copy());
        }

        $record = Record::when($userId, function ($query, $userId) {
            return $query->where('user_id', $userId);
        })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($accountId, function ($query, $accountId) {
                return $query->where('account_id', $accountId);
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($month, function ($query) use ($date_start, $date_end) {
                return $query->whereBetween('date', [$date_start, $date_end]);
            })
            ->orderBy('date', 'asc')
            ->get();

        return $record;
    }
}
