<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Record;
use Closure;
use GraphQL;
use JWTAuth;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateRecordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createRecordMutation',
        'description' => 'A mutation'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $user = JWTAuth::parseToken()->toUser();
        return $user ? true : false;
    }

    public function type(): Type
    {
        return GraphQL::type('records');
    }

    public function args(): array
    {
        return [
            'accountId' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'account_id'
            ],
            'categoryId' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'category_id'
            ],
            'amount' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'amount'
            ],
            'type' => [
                'type' => Type::nonNull(GraphQL::type('operation')),
                'description' => 'type'
            ],
            'date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'date'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'description'
            ],
            'tags' => [
                'type' => Type::string(),
                'description' => 'tags'
            ],
            'note' => [
                'type' => Type::string(),
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

        $record = Record::create([
            'user_id' => $userId,
            'account_id' => $args['accountId'],
            'category_id' => $args['categoryId'],
            'amount' => $args['amount'],
            'type' => strtoupper($args['type']),
            'date' => $args['date'],
            'description' => $args['description'],
            'tags' => $args['tags'],
            'note' => $args['note']
        ]);

        return [
            'id' => $record->id,
            'amount' => $record->amount,
            'type' => $record->type,
            'date' => $record->date,
            'description' => $record->description,
            'tags' => $record->tags,
            'note' => $record->note,
            'user' => $record->user,
            'account' => $record->account,
            'category' => $record->category
        ];
    }
}
