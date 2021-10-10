<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->isAdmin()) {
            return true;
        }
    }
    public function view(User $user, Transaction $transaction)
    {
        return $user->id == $transaction->buyer_id;
    }

    public function isBuyer(User $user, Transaction $transaction)
    {
        return $user->id == $transaction->product->seller->id;
    }
}
