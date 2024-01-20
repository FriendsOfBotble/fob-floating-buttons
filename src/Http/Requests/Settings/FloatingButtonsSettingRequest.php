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
            'position' => ['required', 'string', Rule::in(['left', 'right'])],
            'display_on_mobile' => ['required', 'string', Rule::in(['hide', 'collapsed'])],
            'items' => ['nullable'],
            'items.*.0.key' => ['required', 'string'],
            'items.*.1.value' => ['required', 'string'],
            'items.*.2.value' => ['required', 'string'],
            'items.*.3.value' => $onOffRule,
            'items.*.4.value' => $onOffRule,
            'items.*.5.value' => ['required', 'string'],
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
