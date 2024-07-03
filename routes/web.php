<?php

use Botble\Base\Facades\BaseHelper;
use FriendsOfBotble\FloatingButtons\Http\Controllers\Settings\FloatingButtonsSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix(BaseHelper::getAdminPrefix() . '/floating-buttons')
    ->name('fob-floating-buttons.settings')
    ->middleware(['core', 'web', 'auth'])
    ->group(function () {
        Route::group(['permission' => 'fob-floating-buttons.settings'], function () {
            Route::get('/', [FloatingButtonsSettingController::class, 'edit']);
            Route::put('/', [FloatingButtonsSettingController::class, 'update'])->name('.update');
        });
    });
