;(function ($) {
    'use strict'

    $(document).ready(function () {
        const floatingButtons = $('.floating-buttons')
        if (floatingButtons.length) {
            let position = floatingButtons.attr('data-position') || 'left'

            floatingButtons.superSidebar({
                position: [position, 'center'],
                offset: [0, 100],
                buttonShape: 'round',
                buttonColor: 'default',
                buttonOverColor: 'default',
                iconColor: 'white',
                iconOverColor: 'white',
                labelEnabled: !0,
                labelColor: 'match',
                labelTextColor: 'match',
                labelEffect: 'slide-out-fade',
                labelAnimate: [400, 'easeOutQuad'],
                labelConnected: !0,
                sideSpace: !0,
                buttonSpace: !0,
                labelSpace: !1,
                showAfterPosition: !1,
                barAnimate: [250, 'easeOutQuad'],
                hideUnderWidth: !1,
                shareTarget: 'default',
            })
        }

        $(document).on('click', '.floating-buttons .sb-btn-mobile', function (event) {
            event.preventDefault()

            $(this).toggleClass('active')

            const floatingButtonCollapsed = floatingButtons.find('.floating-buttons-collapsed')

            if ($(this).hasClass('active')) {
                floatingButtonCollapsed.fadeTo(150, 0)
                floatingButtonCollapsed.css('visibility', 'hidden')
            } else {
                floatingButtonCollapsed.fadeTo(150, 1)
                floatingButtonCollapsed.css('visibility', 'visible')
            }
        })
    })
})($)

