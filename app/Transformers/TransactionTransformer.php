<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
    public function transform(Transaction $transaction)
    {
        return [
            'identifier' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->buyer_id,
            'product' => (int)$transaction->product_id,
            'creationDate' => $transaction->created_at,
            'lastChangedDate' => $transaction->updated_at,
            'deletionDate' => $transaction->deleted_at ?? null,
        ];
    }

    public static function getOriginalAttribute(string $transformedAttribute)
    {
        $attribute =  [
            'identifier' => 'id',
            'quantity' => 'quantity',
            'buyer' => 'buyer_id',
            'product' => 'product_id',
            'creationDate' => 'created_at',
            'lastChangedDate' => 'updated_at',
            'deletionDate' => 'deleted_at'
        ];

        return $attribute[$transformedAttribute] ?? null;
    }
}
