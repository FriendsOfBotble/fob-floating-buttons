@php
    $floatingButton = collect($floatingButton)->pluck('value', 'key');
    $title = $floatingButton->get('title');
    $bgColor = $floatingButton->get('background_color');
    $enableRingAnimation = $floatingButton->get('enable_ring_animation')
@endphp
<li class="sb-{{ Str::slug($title) }} {{ $wrapperClass ?? '' }}"

    @style(["--fb-background-color: $bgColor" => $bgColor, "margin-bottom: 20px" => $enableRingAnimation])
>
    <a href="{{ $floatingButton->get('url') }}" target="_blank" title="{{ $title }}" class="ring-animation">
        @if ($image = $floatingButton->get('icon_image'))
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
                {{ RvMedia::image($image, $title, attributes: ['class' => 'sb-icon']) }}
            </div>
        @endif

        <div class="sb-label">{{ $title }}</div>
    </a>
</li>
