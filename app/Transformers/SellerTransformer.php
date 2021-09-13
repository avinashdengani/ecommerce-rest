<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'name' => $seller->name,
            'email' => $seller->email,
            'isVerified' => (bool)$seller->isVerified(),
            'creationDate' => $seller->created_at,
            'lastChangedDate' => $seller->updated_at,
            'deletionDate' => $seller->deleted_at ?? null,
        ];
    }

    public static function getOriginalAttribute(string $transformedAttribute)
    {
        $attribute =  [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'creationDate' => 'created_at',
            'lastChangedDate' => 'updated_at',
            'deletionDate' => 'deleted_at'
        ];

        return $attribute[$transformedAttribute] ?? null;
    }
}
