@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <form action="{{ route('fob-floating-buttons.settings') }}" method="post">
        @method('PUT')
        @csrf

        <x-core-setting::section
            :title="trans('plugins/fob-floating-buttons::fob-floating-buttons.name')"
            :description="trans('plugins/fob-floating-buttons::fob-floating-buttons.description')"
        >
            <div class="mb-3">
                <x-core-setting::on-off
                    :label="trans('plugins/fob-floating-buttons::fob-floating-buttons.enable')"
                    name="enabled"
                    :value="setting('fob-floating-buttons.enabled')"
                    data-bb-toggle="collapse"
                    data-bb-target=".floating-buttons-settings"
                />
            </div>

            <div class="floating-buttons-settings" data-bb-value="1" @style(['display: none' => ! setting('fob-floating-buttons.enabled')])>
                <x-core-setting::radio
                    :label="trans('plugins/fob-floating-buttons::fob-floating-buttons.position')"
                    name="position"
                    :options="[
                        'right' => trans('plugins/fob-floating-buttons::fob-floating-buttons.right'),
                        'left' => trans('plugins/fob-floating-buttons::fob-floating-buttons.left'),
                    ]"
                    :value="setting('fob-floating-buttons.position', 'right')"
                />

                <div class="mb-3">
                    <x-core-setting::on-off
                        :label="trans('plugins/fob-floating-buttons::fob-floating-buttons.hide_on_mobile')"
                        name="hide_on_mobile"
                        :value="setting('fob-floating-buttons.hide_on_mobile', false)"
                        data-bb-toggle="collapse"
                        data-bb-target=".floating-buttons-settings-hide-on-menu"
                    />
                </div>

                <div class="floating-buttons-settings-hide-on-menu"  data-bb-value="0" @style(['display: none' => setting('fob-floating-buttons.hide_on_mobile')])>
                    <div class="mb-3">
                        <x-core-setting::on-off
                            :label="trans('plugins/fob-floating-buttons::fob-floating-buttons.collapsed_on_mobile')"
                            name="collapsed_on_mobile"
                            :value="setting('fob-floating-buttons.collapsed_on_mobile', true)"
                        />
                    </div>
                </div>

                {!! $floatingForms !!}
            </div>
        </x-core-setting::section>

        <div class="flexbox-annotated-section" style="border: none">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content">
                <x-core::button type="submit" color="primary">
                    {{ trans('core/setting::setting.save_settings') }}
                </x-core::button>
            </div>
        </div>
    </form>
@stop

@push('footer')
    {!! $jsValidation !!}
@endpush
