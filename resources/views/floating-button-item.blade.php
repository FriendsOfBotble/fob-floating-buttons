@php
    $floatingButton = collect($floatingButton)->pluck('value', 'key');
    $title = $floatingButton->get('title');
    $bgColor = $floatingButton->get('background_color');
    $bgColor = $bgColor === 'transparent' ? 'var(--primary-color)' : $bgColor;
    $enableRingAnimation = $floatingButton->get('enable_ring_animation');
    $marginBetween = setting('fob-floating-buttons.margin_between', 0);

    $url = $floatingButton->get('url');

    switch ($floatingButton->get('type')) {
        case 'phone':
            $url = 'tel:' . $url;
            break;
        case 'email':
            $url = 'mailto:' . $url;
            break;
        case 'whatsapp':
            $url = 'https://wa.me/' . $url;
            break;
    }
@endphp
<li class="sb-{{ Str::slug($title) }} {{ $wrapperClass ?? '' }}"

    @style(["--fb-background-color: $bgColor" => $bgColor, "margin: {$marginBetween}px 0" => $marginBetween])
>
    <a href="{{ $url }}" @if($floatingButton->get('open_in_the_new_tab')) target="_blank" @endif class="ring-animation">
        @if ($icon = ($floatingButton->get('icon_image') ?: $floatingButton->get('icon')))
            <div class="sb-icon">
                @if($enableRingAnimation)
                    <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show"
                        style="
                            --circle-fill-background-color: {{ $bgColor }};
                            --circle-item-background-color: {{ BaseHelper::hexToRgba($bgColor, 0.5) }};
                            --circle-border-background-color: {{ $bgColor }};
                        "
                    >
                        <div class="coccoc-alo-ph-circle"></div>
                        <div class="coccoc-alo-ph-circle-fill"></div>
                    </div>
                @endif
                @if ($floatingButton->get('icon_image'))
                    {{ RvMedia::image($icon, $title, attributes: ['class' => 'sb-icon']) }}
                @else
                    <x-core::icon :name="$icon" />
                @endif
            </div>
        @endif

        <div class="sb-label">{{ $title }}</div>
    </a>
</li>
