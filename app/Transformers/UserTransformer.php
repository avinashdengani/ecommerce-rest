<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'isVerified' => (bool)$user->isVerified(),
            'isAdmin' => (bool)$user->isAdmin(),
            'creationDate' => $user->created_at,
            'lastChangedDate' => $user->updated_at,
            'deletionDate' => $user->deleted_at ?? null,

            //HATEOAS IMPLEMENTATION

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id)
                ],
            ],
        ];
    }

    public static function getOriginalAttribute(string $transformedAttribute)
    {
        $attribute =  [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'creationDate' => 'created_at',
            'lastChangedDate' => 'updated_at',
            'deletionDate' => 'deleted_at',
        ];

        return $attribute[$transformedAttribute] ?? null;
    }
}
