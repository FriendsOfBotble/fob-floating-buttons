<?php

use Botble\Setting\Facades\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $floatingButtons = setting('fob-floating-buttons.items');

        if (empty($floatingButtons)) {
            return;
        }

        Setting::set('fob-floating-buttons.items', json_encode($floatingButtons));

        Setting::save();

        DB::table('settings')
            ->where('key', 'like', 'fob-floating-buttons.items.%')
            ->delete();
    }
};
