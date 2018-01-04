jQuery(document).ready(function ($) {
var options = {
$AutoPlay: true,
$AutoPlayInterval: 6000,
$SlideDuration: 500,
$ArrowKeyNavigation: true,
$PauseOnHover: 1,
$PlayOrientation: 1,
$DragOrientation: 3,
$SlideSpacing: 0,

$BulletNavigatorOptions: {
$Class: $JssorBulletNavigator$,
$ChanceToShow: 3,
$AutoCenter: 0,
$ActionMode: 1,
$SpacingX: 10,
$SpacingY: 10,
$Orientation: 2
},

$ArrowNavigatorOptions: {
$Class: $JssorArrowNavigator$,
$ChanceToShow: 2,
$AutoCenter: 0
},

$ThumbnailNavigatorOptions: {
$Class: $JssorThumbnailNavigator$,
$ChanceToShow: 2,
$ActionMode: 0,
$DisableDrag: false,
$Orientation: 2,
$AutoCenter: 3
}
};

var jssor_slider1 = new $JssorSlider$("slider4_container", options);

function ScaleSlider() {
var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
if (parentWidth)
jssor_slider1.$ScaleWidth(Math.min(parentWidth, 960));
else
window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
});