<?php

namespace FriendsOfBotble\FloatingButtons\Providers;

use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Botble\Theme\Facades\Theme;

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
            PanelSectionManager::default()->beforeRendering(function (): void {
                PanelSectionManager::registerItem(
                    SettingOthersPanelSection::class,
                    fn () => PanelSectionItem::make('fob-floating-buttons')
                        ->setTitle(trans('plugins/fob-floating-buttons::fob-floating-buttons.name'))
                        ->withDescription(trans('plugins/fob-floating-buttons::fob-floating-buttons.description'))
                        ->withIcon('ti ti-social')
                        ->withPriority(9999)
                        ->withRoute('fob-floating-buttons.settings.edit')
                        ->withPermission('fob-floating-buttons.settings')
                );
            });

            if (setting('fob-floating-buttons.enabled')) {
                Theme::asset()
                    ->usePath(false)
                    ->add(
                        'fob-floating-buttons-default-css',
                        asset('vendor/core/plugins/fob-floating-buttons/css/default.min.css'),
                        version: '1.0.1'
                    )
                    ->add(
                        'fob-floating-buttons-css',
                        asset('vendor/core/plugins/fob-floating-buttons/css/fob-floating-buttons.css'),
                        version: '1.0.1'
                    );

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'fob-velocity-js',
                        asset('vendor/core/plugins/fob-floating-buttons/js/velocity.min.js'),
                        ['jquery'],
                        version: '1.0.1'
                    )
                    ->add(
                        'fob-floating-buttons-default-js',
                        asset('vendor/core/plugins/fob-floating-buttons/js/default.min.js'),
                        ['jquery'],
                        version: '1.0.1'
                    )
                    ->add(
                        'fob-floating-buttons-js',
                        asset('vendor/core/plugins/fob-floating-buttons/js/fob-floating-buttons.js'),
                        ['jquery'],
                        version: '1.0.1'
                    );

                add_filter(THEME_FRONT_FOOTER, function (?string $data): ?string {
                    $floatingButtons = setting('fob-floating-buttons.items');

                    if (empty($floatingButtons)) {
                        return $data;
                    }

                    $floatingButtons = json_decode($floatingButtons, true);

                    $collapsedOnMobile = setting('fob-floating-buttons.display_on_mobile', 'collapsed') == 'collapsed';

                    return $data.view(
                        'plugins/fob-floating-buttons::floating-buttons',
                        compact('floatingButtons', 'collapsedOnMobile')
                    )->render();
                }, 192);
            }
        });
    }
}
