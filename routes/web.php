<?php

use Botble\Base\Facades\AdminHelper;
use FriendsOfBotble\FloatingButtons\Http\Controllers\Settings\FloatingButtonsSettingController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group([
        'permission' => 'fob-floating-buttons.settings',
        'as' => 'fob-floating-buttons.settings.',
        'prefix' => 'settings/floating-buttons',
    ], function () {
        Route::get('/', [FloatingButtonsSettingController::class, 'edit'])->name('edit');
        Route::put('/', [FloatingButtonsSettingController::class, 'update'])->name('update');
    });
});
