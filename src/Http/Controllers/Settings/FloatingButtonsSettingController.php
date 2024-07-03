<?php

namespace FriendsOfBotble\FloatingButtons\Http\Controllers\Settings;

use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Setting\Facades\Setting;
use FriendsOfBotble\FloatingButtons\Forms\Settings\FloatingButtonsSettingForm;
use FriendsOfBotble\FloatingButtons\Http\Requests\Settings\FloatingButtonsSettingRequest;
use Illuminate\Support\Arr;

class FloatingButtonsSettingController extends BaseController
{
    public function edit()
    {
        PageTitle::setTitle(trans('plugins/fob-floating-buttons::fob-floating-buttons.name'));

        return FloatingButtonsSettingForm::create()->renderForm();
    }

    public function update(FloatingButtonsSettingRequest $request)
    {
        $data = $request->validated();

        foreach (Arr::except($data, 'items') as $key => $value) {
            Setting::set(sprintf('fob-floating-buttons.%s', $key), $value);
        }

        if (Arr::has($data, 'items')) {
            Setting::set('fob-floating-buttons.items', json_encode(Arr::get($data, 'items', [])));
        }

        Setting::save();

        return $this
            ->httpResponse()
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
