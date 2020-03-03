<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Record;
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
        return [];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $userId = auth()->user()->id;
        $record = Record::where('user_id', $userId)->get();
        return $record;
    }
}
