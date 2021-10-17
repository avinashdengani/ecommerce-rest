<?php

namespace App\Providers;

use App\Models\Buyer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\BuyerPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SellerPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Buyer::class => BuyerPolicy::class,
        Seller::class => SellerPolicy::class,
        User::class => UserPolicy::class,
        Transaction::class => TransactionPolicy::class,
        Product::class => ProductPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addMinutes(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::tokensCan([
            'purchase-product' => 'Create a new Transaction for a specific product',
            'manage-account' => 'Read your account data such as id, name, email, is_verified, and is_admin (password is not given). Modify you account data (email and password), CANNOT DELETE ACCOUNT',
            'manage-product' => 'CRUD for products',
            'read-general' => 'Read general info like categories, products, purchased products, your transactions'
        ]);

        Gate::define('admin', function (User $user) {
            return $user->isAdmin()
                        ? Response::allow()
                        : Response::deny('You must be an administrator.');
        });
    }
}
