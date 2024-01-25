<?php

declare(strict_types=1);

namespace App\GraphQL\Types;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Member;

class MemberType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Member',
        'description' => 'A type for the Members Model',
        'model' => Member::class
    ];

    public function fields(): array
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

    public function resolve($root, $args)
    {
        $member = new Member();
        $member->first_name = $args['first_name'];
        $member->last_name = $args['last_name'];
        $member->gender = $args['gender'];
        $member->address = $args['address'];
        $member->phone_number = $args['phone_number'];
        $member->email = $args['email'];
        $member->birth_date = $args['birth_date'];
    
        return $member;
    }
    
}
