<?php
// Auth
Auth::routes();

// Change Language
Route::post('language/',array(
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@changeLanguage'
));

// home
Route::get('/', 'HomeController@index')->name('home');
