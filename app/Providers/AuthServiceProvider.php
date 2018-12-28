<?php

namespace App\Providers;

use App\Accounting;
use App\Admin;
use App\Buy;
use App\Client;
use App\Echeance;
use App\Member;
use App\Policies\Accounting\AccountingPolicy;
use App\Policies\Accounting\UnloadPolicy;
use App\Policies\Admin\AdminPolicy;
use App\Policies\Deal\ClientPolicy;
use App\Policies\Deal\ProviderPolicy;
use App\Policies\Money\EcheancePolicy;
use App\Policies\Rh\MemberPolicy;
use App\Policies\Rh\PositionPolicy;
use App\Policies\Store\ProductPolicy;
use App\Policies\Trade\BuyPolicy;
use App\Policies\Trade\SalePolicy;
use App\Position;
use App\Product;
use App\Provider;
use App\Sale;
use App\Unload;
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
        Product::class => ProductPolicy::class,
        Provider::class => ProviderPolicy::class,
        Client::class => ClientPolicy::class,
        Buy::class => BuyPolicy::class,
        Sale::class => SalePolicy::class,
        Accounting::class => AccountingPolicy::class,
        Unload::class => UnloadPolicy::class,
        Admin::class => AdminPolicy::class,
        Echeance::class => EcheancePolicy::class,
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
