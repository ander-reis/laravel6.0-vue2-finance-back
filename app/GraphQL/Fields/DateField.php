<?php

declare(strict_types=1);

namespace App\GraphQL\Fields;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Field;

class DateField extends Field
{
    protected $attributes = [
        'name' => 'DateField',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function resolve($root, $args): string
    {
        return Carbon::parse($args['date'])->format('Y-m-d');
    }
}
