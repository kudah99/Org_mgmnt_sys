<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Articles;


use App\Models\Articles;
use App\Models\Member;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class MemberQuery extends Query
{
    protected $attributes = [
        'name' => 'members/Memebers',
        'description' => 'A query to fetch all Members'
    ];

    public function type(): Type
    {
        // return Type::listOf(GraphQL::type('Members')); //return all results
        return GraphQL::paginate('Members'); //return paginated results
    }

    public function args(): array
    {
        return [
            'limit' => [
                'type' => Type::int()
            ],
            'page' => [
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        if (!array_key_exists('limit', $args) || !array_key_exists('page', $args)) {
            $articles = Member::with($with)->select($select)
                ->paginate(5, ['*'], 'page', 1);
        } else {
            $articles =Member::with($with)->select($select)
                ->paginate($args['limit'], ['*'], 'page', $args['page']);
        }

        return $articles;

        // return Member::select($select)->with($with)->get(); This returns all records without pagination
    }
}