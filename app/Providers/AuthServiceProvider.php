<?php

namespace App\Providers;

use App\Member;
use App\Policies\Premium\PremiumPolicy;
use App\Policies\Premium\TokenPolicy;
use App\Policies\Rh\MemberPolicy;
use App\Policies\Rh\PositionPolicy;
use App\Policies\Store\ProductPolicy;
use App\Policies\UserPolicy;
use App\Position;
use App\Premium;
use App\Product;
use App\Token;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Position::class => PositionPolicy::class,
        Member::class => MemberPolicy::class,
        Token::class => TokenPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
