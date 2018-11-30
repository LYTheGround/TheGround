<?php
// Auth
Auth::routes();

// Change Language
Route::post('language/', array('before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage'));

// home
Route::get('/', 'HomeController@index')->name('home');
// auth APP
Route::middleware('auth')->group(function () {
    // Position
    Route::resource('position', 'Rh\PositionController');
    // Members
    Route::namespace('Rh')->group(function (){
        Route::prefix('member')->group(function (){
            Route::get('/','MemberController@index')->name('member.list');
            Route::get('/{member}','MemberController@show')->name('member.show');
        });

        Route::get('/params','MemberController@params')->name('member.params');
        Route::put('/params','MemberController@updateParams')->name('member.params.update');

        Route::prefix('{member}')->middleware('can:view,member')->middleware('can:range,member')->group(function (){
            Route::get('/range','MemberController@range')->name('member.range');
            Route::put('/range','MemberController@updateRange')->name('member.range.update');

            Route::get('/status','MemberController@status')->name('member.status');
            Route::put('/status','MemberController@updateStatus')->name('member.status.update');
        });
    });

    // Tokens
    Route::resource('token','Token\TokenController')->except(['edit', 'update', 'show']);
    // product
    Route::resource('product','Store\ProductController');
    Route::get('DestroyImg/{img}','Store\ProductController@destroyImg')->name('product.destroyImg');
    // Deals
    Route::namespace('Trade')->group(function (){
        //provider
        Route::resource('provider','ProviderController');
        // client
        Route::resource('Client','ClientController');
    });

// Trade
    Route::prefix('trade')->group(function (){
        // Trade
        Route::get('/','Trade\TradeController')->name('trade');
        // Buy
        Route::resource('buy','Trade\Buy\BuyController')->only(['index','store','show']);
        Route::prefix('buy')->group(function (){
            // Buy_bc
            Route::post('buy/{buy}/bc/products','Trade\Buy\BcController@products')->name('bc.products');
            Route::resource('buy/{buy}/bc','Trade\Buy\BcController')->only(['create','store','destroy']);
            Route::get('buy/{buy}/bc/confirm','Trade\Buy\BcController@confirm')->name('buy.bc.confirm');
            // ressource des devis des achats en except index
            Route::get('buy/{buy}/dv/confirm', 'Trade\Buy\DvController@confirm')->name('buy.dv.confirm');
            Route::resource('buy/{buy}/dv','Trade\Buy\DvController')->except(['index','edit','update']);
            Route::get('buy/{buy}/dv/{dv}/selected', 'Trade\Buy\DvController@selected')->name('buy.dv.selected');
            // buy_tasks
            Route::get('buy/{buy}/tasks/{trade}', function ($buy, $trade) {
                if(($trade == 'done') || ($trade == 'delivery') || ($trade == 'store') || ($trade == 'finish')){
                    $class = new \App\Http\Controllers\Trade\Buy\TradeActionController();
                    $buy = \App\Buy::where('slug',$buy)->first();
                    return $class->$trade($buy);
                }
                abort(404);
                return false;
            });
        });
        //sale
        Route::resource('sale','Trade\Sale\SaleController')->only(['index','store','show']);

    });

});
