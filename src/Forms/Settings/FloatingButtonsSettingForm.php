<?php

namespace FriendsOfBotble\FloatingButtons\Forms\Settings;

use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\RadioField;
use Botble\Base\Forms\Fields\RepeaterField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Setting\Forms\SettingForm;
use FriendsOfBotble\FloatingButtons\Http\Requests\Settings\FloatingButtonsSettingRequest;

class FloatingButtonsSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $fields = [
            [
                'type' => 'text',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.title'),
                'required' => true,
                'attributes' => [
                    'name' => 'title',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'type' => 'text',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.url'),
                'required' => true,
                'attributes' => [
                    'name' => 'url',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'type' => 'coreIcon',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.icon'),
                'required' => true,
                'attributes' => [
                    'name' => 'icon',
                    'value' => null,
                    'options' => [
                        'class' => 'form-select',
                    ],
                ],
            ],
            [
                'type' => 'mediaImage',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.icon_image'),
                'required' => true,
                'attributes' => [
                    'name' => 'icon_image',
                ],
            ],
            [
                'type' => 'onOff',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.enable_ring_animation'),
                'attributes' => [
                    'name' => 'enable_ring_animation',
                ],
            ],
            [
                'type' => 'onOff',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.open_in_the_new_tab'),
                'required' => true,
                'attributes' => [
                    'name' => 'open_in_the_new_tab',
                ],
            ],
            [
                'type' => 'customColor',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.background_color'),
                'required' => true,
                'attributes' => [
                    'name' => 'background_color',
                ],
            ],
            [
                'type' => 'customSelect',
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.type'),
                'required' => true,
                'attributes' => [
                    'name' => 'type',
                    'choices' => [
                        'custom' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.custom'),
                        'phone' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.phone'),
                        'email' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.email'),
                        'whatsapp' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.whatsapp'),
                    ],
                    'value' => null,
                    'options' => [
                        'class' => 'form-select',
                    ],
                    [],
                    [],
                ],
            ],
        ];

        $this
            ->setSectionTitle(trans('plugins/fob-floating-buttons::fob-floating-buttons.name'))
            ->setSectionDescription(trans('plugins/fob-floating-buttons::fob-floating-buttons.description'))
            ->setValidatorClass(FloatingButtonsSettingRequest::class)
            ->add(
                'enabled',
                OnOffCheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.enable'))
                    ->attributes([
                        'data-bb-toggle' => 'collapse',
                        'data-bb-target' => '.floating-buttons-settings',
                    ])
                    ->value(setting('fob-floating-buttons.enabled'))
                    ->toArray()
            )
            ->add('open_floating_buttons_settings', HtmlField::class, [
                'html' => sprintf(
                    '<fieldset class="floating-buttons-settings form-fieldset"
                    data-bb-value="1"
                    style="display: %s"/>',
                    old('enabled', setting('fob-floating-buttons.enabled')) ? 'block' : 'none',
                ),
            ])
            ->add(
                'position',
                SelectField::class,
                SelectFieldOption::make()
                    ->choices([
                        'bottom_right' => trans('plugins/fob-floating-buttons::fob-floating-buttons.bottom_right'),
                        'bottom_left' => trans('plugins/fob-floating-buttons::fob-floating-buttons.bottom_left'),
                        'center_right' => trans('plugins/fob-floating-buttons::fob-floating-buttons.center_right'),
                        'center_left' => trans('plugins/fob-floating-buttons::fob-floating-buttons.center_left'),
                    ])
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.position'))
                    ->selected(setting('fob-floating-buttons.position', 'bottom_right'))
                    ->toArray()
            )
            ->add(
                'offset_x',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.offset_x'))
                    ->value(setting('fob-floating-buttons.offset_x', 20))
                    ->toArray()
            )
            ->add(
                'offset_y',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.offset_y'))
                    ->value(setting('fob-floating-buttons.offset_y', 30))
                    ->toArray()
            )
            ->add(
                'margin_between',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.margin_between'))
                    ->value(setting('fob-floating-buttons.margin_between', 0))
                    ->toArray()
            )
            ->add(
                'display_on_mobile',
                RadioField::class,
                RadioFieldOption::make()
                    ->choices([
                        'hide' => trans('plugins/fob-floating-buttons::fob-floating-buttons.hide_on_mobile'),
                        'collapsed' => trans('plugins/fob-floating-buttons::fob-floating-buttons.collapsed_on_mobile'),
                    ])
                    ->selected(setting('fob-floating-buttons.display_on_mobile', 'collapsed'))
                    ->label(trans('plugins/fob-floating-buttons::fob-floating-buttons.display_on_mobile'))
                    ->toArray()
            )
            ->add('items', RepeaterField::class, [
                'fields' => $fields,
                'value' => $this->getDataItems(),
                'label' => trans('plugins/fob-floating-buttons::fob-floating-buttons.floating_button_items'),
            ])
            ->add('close_floating_buttons_settings', HtmlField::class, [
                'html' => '</fieldset>',
            ]);
    }

    protected function getDataItems(): array
    {
        $items = setting('fob-floating-buttons.items');

        if (! empty($items)) {
            $items = json_decode($items, true);
        }

        if (! is_array($items)) {
            return [];
        }

        foreach ($items as $i => $item) {
            foreach ($item as $j => $childItem) {
                $items[$i][$j] = collect($childItem)->toArray();
            }
        }

        return $items;
    }
}
