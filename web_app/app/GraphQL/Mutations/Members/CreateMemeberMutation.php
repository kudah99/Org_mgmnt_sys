<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Members;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Member;

class CreateMemberMutation extends Mutation
{
    protected $attributes = [
        'name' => 'members/CreateMemeber',
        'description' => 'A mutation for Creating an Member'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
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
        return Member::create($args);
    }
}
