<?php
// Auth


use Illuminate\Support\Facades\Route;

Auth::routes();

// Change Language
Route::post('language/', array('before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage'));

// auth APP
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function (){
// home
        Route::get('/', 'HomeController@index')->name('home');
        // Dashboard
        Route::get('dashboard', 'Dashboard\DashboardController')->name('dashboard');

        // Members
        Route::namespace('Rh')->group(function () {;
            Route::prefix('member')->group(function () {
                Route::get('/', 'MemberController@index')->name('member.list');
                // prefix member
                Route::prefix('{member}')->middleware('can:view,member')->group(function () {
                    // profile member
                    Route::get('/', 'MemberController@show')->name('member.show');

                    Route::middleware('can:range,member')->group(function (){
                        // range member
                        Route::get('/range', 'MemberController@range')->name('member.range');
                        Route::put('/range', 'MemberController@updateRange')->name('member.range.update');
                        // status member
                        Route::get('/status', 'MemberController@status')->name('member.status');
                        Route::put('/status', 'MemberController@updateStatus')->name('member.status.update');

                    });
                });
            });
            // params members
            Route::get('/params', 'MemberController@params')->name('member.params');
            Route::put('/params', 'MemberController@updateParams')->name('member.params.update');

            // Position
            Route::resource('position', 'PositionController');
        });

        // Tokens
        Route::resource('token', 'Token\TokenController')->except(['edit', 'update', 'show']);
        // product
        Route::namespace('Store')->group(function (){
            Route::resource('product', 'ProductController');
            Route::get('DestroyImg/{img}', 'ProductController@destroyImg')->name('product.destroyImg');
        });
        // Deals
        Route::namespace('Deal')->group(function () {
            //provider
            Route::resource('provider', 'ProviderController');
            // client
            Route::resource('client', 'clientController');
        });
        // Trade
        Route::prefix('trade')->group(function () {
            // Trade
            Route::get('/', 'Trade\TradeController')->name('trade');
            // Buy
            Route::resource('buy', 'Trade\Buy\BuyController')->only(['index', 'store', 'show', 'destroy']);
            Route::prefix('buy')->group(function () {
                // Buy_bc
                Route::post('{buy}/bc/products', 'Trade\Buy\BcController@products')->name('bc.products');
                Route::resource('{buy}/bc', 'Trade\Buy\BcController')->only(['create', 'store', 'destroy']);
                Route::get('{buy}/bc/confirm', 'Trade\Buy\BcController@confirm')->name('buy.bc.confirm');
                // ressource des devis des achats en except index
                Route::get('{buy}/dv/confirm', 'Trade\Buy\DvController@confirm')->name('buy.dv.confirm');
                Route::resource('{buy}/dv', 'Trade\Buy\DvController')->except(['index', 'edit', 'update']);
                Route::get('{buy}/dv/{dv}/selected', 'Trade\Buy\DvController@selected')->name('buy.dv.selected');
                // buy_tasks
                Route::get('{buy}/tasks/{trade}', function ($buy, $trade) {
                    if (($trade == 'done') || ($trade == 'delivery') || ($trade == 'store') || ($trade == 'finish')) {
                        $class = new \App\Http\Controllers\Trade\Buy\TradeActionController();
                        $buy = \App\Buy::where('slug', $buy)->first();
                        return $class->$trade($buy);
                    }
                    abort(404);
                    return false;
                });
                Route::post('{buy}/bl','Trade\Buy\TradeActionController@bl')->name('buy.bl');
                Route::delete('{buy}/bl','Trade\Buy\TradeActionController@blDestroy')->name('buy.bl.destroy');
                Route::post('{buy}/fc','Trade\Buy\TradeActionController@fc')->name('buy.fc');
                Route::delete('{buy}/fc','Trade\Buy\TradeActionController@fcDestroy')->name('buy.fc.destroy');
            });
            //sale
            Route::resource('sale', 'Trade\Sale\SaleController');
            Route::prefix('sale/{sale}')->namespace('Trade\Sale')->group(function (){
                Route::post('sale_bc/product', 'BcController@products')->name('sale_bc.products');
                Route::resource('sale_bc', 'BcController');
                Route::get('bc/sale_bc/confirm', 'BcController@confirm')->name('sale.bc.confirm');
                Route::get('bc/sale_bc/release/{id}', 'BcController@productsRelease')->name('sale.bc.release');
                // sale_tasks
                Route::get('tasks/{trade}', function ($sale, $trade) {
                    if (($trade == 'done') || ($trade == 'delivery') || ($trade == 'store') || ($trade == 'finish') || ($trade == 'bl') || ($trade == 'fc')) {
                        $class = new \App\Http\Controllers\Trade\Sale\TradeActionController();
                        $sale = \App\Sale::where('slug', $sale)->first();
                        return $class->$trade($sale);
                    }
                    abort(404);
                    return false;
                });
            });
        });
        // money
        //accounting
        Route::get('accounting', 'Money\AccountingController@index')->name('accounting.index');
        Route::get('accounting/{month}', 'Money\AccountingController@show')->name('accounting.show');
        // unload
        // todo : update chargeOn
        Route::resource('unload', 'Money\UnloadController');
    });

    //todo : administration
    //todo : documentation
    Route::prefix('admin')->middleware('member')->group(function () {
        Route::resource('company', 'Admin\CompanyController');
        Route::get('company/{company}/sold', 'Admin\CompanyController@sold')->name('company.sold');
        Route::put('company/{company}/sold', 'Admin\CompanyController@updateSold')->name('company.updateSold');
        Route::get('company/{company}/status', 'Admin\CompanyController@status')->name('company.status');
        Route::put('company/{company}/status', 'Admin\CompanyController@updateStatus')->name('company.updateStatus');

        Route::resource('admin', 'Admin\AdminController')->except(['edit','update']);
        Route::get('params','Admin\AdminController@edit')->name('admin.params');
        Route::put('edit','Admin\AdminController@update')->name('admin.params.update');
    });
});
