<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api/vi')->namespace('Api\v1')->name('api.v1.')->group(static function (): void {
    Route::prefix('user')->namespace('User')->name('user.')->group(static function (): void {
        Route::get('/', 'ListController')->name('list');
        Route::get('/{user}', 'ReadController')->name('read');
        Route::post('/', 'CreateController')->name('create');
        Route::patch('/{user}', 'UpdateController')->name('update');
        Route::delete('/{user}', 'DeleteController')->name('delete');

        Route::prefix('{user}/relationships')->namespace('Relationships')->name('relationships.')->group(static function (): void {
            Route::prefix('address')->namespace('Address')->name('address.')->group(static function (): void {
                Route::get('/', 'ListController')->name('list');
                Route::get('/{address}', 'ReadController')->name('read');
                Route::post('/', 'CreateController')->name('create');
                Route::patch('/{address}', 'UpdateController')->name('update');
                Route::delete('/{address}', 'DeleteController')->name('delete');
            });

            Route::prefix('skill')->namespace('Skill')->name('skill.')->group(static function (): void {
                Route::get('/', 'ListController')->name('list');
                Route::get('/{user-skill}', 'ReadController')->name('read');
                Route::post('/', 'CreateController')->name('create');
                Route::patch('/{skill}', 'UpdateController')->name('update');
                Route::delete('/{skill}', 'DeleteController')->name('delete');
            });
        });
    });

    Route::prefix('address')->namespace('Address')->name('address.')->group(static function (): void {
        Route::get('/', 'ListController')->name('list');
        Route::get('/{address}', 'ReadController')->name('read');
    });

    Route::prefix('skill')->namespace('Skill')->name('skill.')->group(static function (): void {
        Route::get('/', 'ListController')->name('list');
        Route::get('/{skill}', 'ReadController')->name('read');
    });
});
