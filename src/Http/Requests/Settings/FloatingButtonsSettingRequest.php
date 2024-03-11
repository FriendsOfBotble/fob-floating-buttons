<?php

namespace FriendsOfBotble\FloatingButtons\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class FloatingButtonsSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'enabled' => $onOffRule = new OnOffRule(),
            'position' => ['required', 'string', Rule::in(['bottom_right', 'bottom_left', 'center_right', 'center_left'])],
            'display_on_mobile' => ['required', 'string', Rule::in(['hide', 'collapsed'])],
            'offset_x' => ['required', 'integer'],
            'offset_y' => ['required', 'integer'],
            'margin_between' => ['required', 'integer'],
            'items' => ['nullable'],
            'items.*.0.key' => ['nullable', 'string'],
            'items.*.1.value' => ['nullable', 'string'],
            'items.*.2.value' => ['nullable', 'string'],
            'items.*.3.value' => ['nullable', 'string'],
            'items.*.4.value' => $onOffRule,
            'items.*.5.value' => $onOffRule,
            'items.*.6.value' => ['nullable', 'string'],
            'items.*.7.value' => ['required', 'string', Rule::in(['custom', 'phone', 'email', 'whatsapp'])],
        ];
    }

    public function attributes(): array
    {
        return [
            'items.*.0.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.title'),
            'items.*.1.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.url'),
            'items.*.2.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.icon_image'),
            'items.*.3.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.enable_ring_animation'),
            'items.*.4.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.open_in_the_new_tab'),
            'items.*.5.value' => trans('plugins/fob-floating-buttons::fob-floating-buttons.form.background_image'),
        ];
    }
}
