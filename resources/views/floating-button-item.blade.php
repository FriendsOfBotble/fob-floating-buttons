@php
    $floatingButton = collect($floatingButton)->pluck('value', 'key');
    $title = $floatingButton->get('title');
    $bgColor = $floatingButton->get('background_color');
    $bgColor = $bgColor === 'transparent' ? 'var(--primary-color)' : $bgColor;
    $enableRingAnimation = $floatingButton->get('enable_ring_animation');
@endphp
<li class="sb-{{ Str::slug($title) }} {{ $wrapperClass ?? '' }}"

    @style(["--fb-background-color: $bgColor" => $bgColor, "margin-bottom: 20px" => $enableRingAnimation])
>
    <a href="{{ $floatingButton->get('url') }}" @if($floatingButton->get('open_in_the_new_tab')) target="_blank" @endif class="ring-animation">
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
