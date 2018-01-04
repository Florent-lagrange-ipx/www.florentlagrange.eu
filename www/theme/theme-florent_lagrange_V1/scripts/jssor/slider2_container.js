var options = {
$AutoPlay: true,
$AutoPlayInterval: 0,
$SlideDuration: 1600,
$ArrowKeyNavigation: true,
$PauseOnHover: 4,
$FillMode: 0,
$PlayOrientation: 1,
$DragOrientation: 1,
$SlideEasing: $JssorEasing$.$EaseLinear,
$Cols: 7,
$SlideWidth: 140,
$SlideSpacing: 0,
$Align: 0,

$BulletNavigatorOptions: {
$Class: $JssorBulletNavigator$,
$ChanceToShow: 0
},

$ArrowNavigatorOptions: {
$Class: $JssorArrowNavigator$,
$ChanceToShow: 0
},

$ThumbnailNavigatorOptions: {
$Class: $JssorThumbnailNavigator$,
$ChanceToShow: 0
}
};

var jssor_slider1 = new $JssorSlider$("slider2_container", options);

function ScaleSlider() {
var bodyWidth = document.body.clientWidth;
if (bodyWidth)
jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 980));
else
window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
