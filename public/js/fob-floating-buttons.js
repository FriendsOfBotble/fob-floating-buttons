!function(t){"use strict";t(document).ready((function(){var e=t(".floating-buttons");if(e.length){var o=["right","bottom"];switch(e.data("position")){case"bottom_left":o=["left","bottom"];break;case"bottom_right":o=["right","bottom"];break;case"center_left":o=["left","center"];break;case"center_right":o=["right","center"]}e.superSidebar({position:o,offset:[e.data("offset-x"),e.data("offset-y")],buttonShape:"round",buttonColor:"default",buttonOverColor:"default",iconColor:"white",iconOverColor:"white",labelEnabled:!0,labelColor:"match",labelTextColor:"match",labelEffect:"slide-out-fade",labelAnimate:[400,"easeOutQuad"],labelConnected:!0,sideSpace:!0,buttonSpace:!0,labelSpace:!1,showAfterPosition:!1,barAnimate:[250,"easeOutQuad"],hideUnderWidth:!1,shareTarget:"default"})}t(document).on("click",".floating-buttons .sb-btn-mobile",(function(o){o.preventDefault(),t(this).toggleClass("active");var a=e.find(".floating-buttons-collapsed");t(this).hasClass("active")?(a.fadeTo(150,0),a.css("visibility","hidden")):(a.fadeTo(150,1),a.css("visibility","visible"))}))}))}($);