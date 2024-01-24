<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Members;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Member;

class UpdateMemberMutation extends Mutation
{
    protected $attributes = [
        'name' => 'members/UpdateMember',
        'description' => 'A mutation for Updating an Member'
    ];

    public function type(): Type
    {
        return GraphQL::type('Members');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The auto incremented Member ID'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'A first_name of the Member'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The last_name of the Member'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the Member'
            ],
            'phone_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The phone number of the member'
            ],
            'birth_date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'birth_date field'
            ],
            'address' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'address field'
            ],
            'gender' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The gender of the member'
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $member = Member::findOrFail($args['id']);

        $member->update($args);

        return $member;
    }
}
