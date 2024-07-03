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
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->publishAssets()
            ->loadMigrations()
            ->loadRoutes();

        $this->app->booted(function () {
            $this->app['events']->listen(RouteMatched::class, function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'cms-plugins-floating-buttons',
                        'priority' => 9999,
                        'parent_id' => null,
                        'name' => 'plugins/fob-floating-buttons::fob-floating-buttons.name',
                        'icon' => 'ti ti-social',
                        'url' => fn () => route('fob-floating-buttons.settings'),
                        'permissions' => ['fob-floating-buttons.settings'],
                    ]);

            });

            if (setting('fob-floating-buttons.enabled')) {
                Theme::asset()
                    ->usePath(false)
                    ->add('fob-floating-buttons-default-css', asset('vendor/core/plugins/fob-floating-buttons/css/default.min.css'), version: '1.0.1')
                    ->add('fob-floating-buttons-css', asset('vendor/core/plugins/fob-floating-buttons/css/fob-floating-buttons.css'), version: '1.0.1');

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add('fob-velocity-js', asset('vendor/core/plugins/fob-floating-buttons/js/velocity.min.js'), ['jquery'], version: '1.0.1')
                    ->add('fob-floating-buttons-default-js', asset('vendor/core/plugins/fob-floating-buttons/js/default.min.js'), ['jquery'], version: '1.0.1')
                    ->add('fob-floating-buttons-js', asset('vendor/core/plugins/fob-floating-buttons/js/fob-floating-buttons.js'), ['jquery'], version: '1.0.1');

                add_filter(THEME_FRONT_FOOTER, function (?string $data): ?string {
                    $floatingButtons = setting('fob-floating-buttons.items');

                    if (empty($floatingButtons)) {
                        return $data;
                    }

                    $floatingButtons = json_decode($floatingButtons, true);

                    $collapsedOnMobile = setting('fob-floating-buttons.display_on_mobile', 'collapsed') == 'collapsed';

                    return $data . view('plugins/fob-floating-buttons::floating-buttons', compact('floatingButtons', 'collapsedOnMobile'))->render();
                }, 192);
            }
        });
    }
}
