<div
    class="floating-buttons"
    data-position="{{ setting('fob-floating-buttons.position', 'bottom_right') }}"
    data-offset-x="{{ setting('fob-floating-buttons.offset_x', 20) }}"
    data-offset-y="{{ setting('fob-floating-buttons.offset_y', 100) }}"
>
    <ul @class(['sb-bar', 'd-none d-sm-block' => setting('fob-floating-buttons.display_on_mobile', 'collapsed') == 'hide'])>
        @if ($collapsedOnMobile)
            <div class="floating-buttons-collapsed d-sm-none">
                @foreach($floatingButtons as $floatingButton)
                    @include('plugins/fob-floating-buttons::floating-button-item', ['floatingButton' => $floatingButton])
                @endforeach
            </div>
        @endif

        @foreach($floatingButtons as $floatingButton)
            @include('plugins/fob-floating-buttons::floating-button-item', [
                'floatingButton' => $floatingButton,
                'wrapperClass' => $collapsedOnMobile ? 'd-none d-sm-block' : '',
            ])
        @endforeach

        @if ($collapsedOnMobile)
            <li class="sb-btn-mobile d-sm-none active">
                <a href="#" class="">
                    <div class="sb-icon">
                        <svg class="close"  xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 384 512" fill="#ffffff">
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                        </svg>
                        <svg class="open" xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 448 512" fill="#ffffff">
                            <path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/>
                        </svg>
                    </div>
                </a>
            </li>
        @endif
    </ul>
</div>
