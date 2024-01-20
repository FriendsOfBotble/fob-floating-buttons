<?php

namespace FriendsOfBotble\FloatingButtons\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Theme\Facades\Theme;
use Illuminate\Routing\Events\RouteMatched;

class FloatingButtonsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/fob-floating-buttons')
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->publishAssets()
            ->loadRoutes();

        $this->app->booted(callback: function () {
            $this->app['events']->listen(RouteMatched::class, function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'cms-plugins-floating-buttons',
                        'priority' => 9999,
                        'parent_id' => null,
                        'name' => 'plugins/fob-floating-buttons::fob-floating-buttons.name',
                        'icon' => 'ti ti-list',
                        'url' => fn () => route('fob-floating-buttons.settings'),
                    ]);

            });

            if (setting('fob-floating-buttons.enabled')) {
                Theme::asset()
                    ->usePath(false)
                    ->add('fob-floating-buttons-default-css', asset('vendor/core/plugins/fob-floating-buttons/css/default.min.css'))
                    ->add('fob-floating-buttons-css', asset('vendor/core/plugins/fob-floating-buttons/css/fob-floating-buttons.css'));

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add('fob-velocity-js', asset('vendor/core/plugins/fob-floating-buttons/js/velocity.min.js'),  ['jquery'])
                    ->add('fob-floating-buttons-default-js', asset('vendor/core/plugins/fob-floating-buttons/js/default.min.js'),  ['jquery'])
                    ->add('fob-floating-buttons-js', asset('vendor/core/plugins/fob-floating-buttons/js/fob-floating-buttons.js'), ['jquery']);

                add_filter(THEME_FRONT_FOOTER, function (string|null $data): string|null {
                    return $data . view('plugins/fob-floating-buttons::floating-buttons')->render();
                }, 192);
            }
        });
    }
}
