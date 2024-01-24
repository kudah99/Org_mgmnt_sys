<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Members;

use App\Models\Member;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteMemberMutation extends Mutation
{
    protected $attributes = [
        'name' => 'members/DeleteMember',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The auto incremented Article ID'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $member = Member::findOrFail($args['id']);

        return $member ->delete();
    }
}
