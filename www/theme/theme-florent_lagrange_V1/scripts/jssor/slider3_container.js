jQuery(document).ready(function ($) {
var _SlideshowTransitions = [
{$Duration:1500,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$JssorEasing$.$EaseInOutCubic},$Opacity:2,$Brother:{$Duration:1500,$Opacity:2}},
{$Duration:500,y:1,$Easing:$JssorEasing$.$EaseInQuad},
{$Duration:1500,y:-0.5,$Delay:60,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:$JssorEasing$.$EaseInWave,$Round:{$Top:1.5}},
{$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2},
{$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Outside:true,$Round:{$Left:1.3,$Top:2.5}},
{$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Outside:true,$Round:{$Left:1.3,$Top:2.5}}
];
var options = {
$AutoPlay: true,
$AutoPlayInterval: 1500,
$SlideDuration: 600,
$ArrowKeyNavigation: true,
$PauseOnHover: 1,
$FillMode: 0,
$PlayOrientation: 1,
$DragOrientation: 3,
$SlideEasing: $JssorEasing$.$EaseOutQuad,
$Cols: 1,
$SlideSpacing: 0,
$Align: 0,

$SlideshowOptions: {
$Class: $JssorSlideshowRunner$,
$Transitions: _SlideshowTransitions,
$TransitionsOrder: 1,
$ShowLink: true
},

$BulletNavigatorOptions: {
$Class: $JssorBulletNavigator$,
$ChanceToShow: 0
},

$ArrowNavigatorOptions: {
$Class: $JssorArrowNavigator$,
$ChanceToShow: 1,
$AutoCenter: 0
},

$ThumbnailNavigatorOptions: {
$Class: $JssorThumbnailNavigator$,
$ChanceToShow: 2,
$ActionMode: 1,
$DisableDrag: false,
$Orientation: 2,
$Rows: 2,
$ParkingPosition: 156,
$AutoCenter: 3,
$SpacingX: 14,
$SpacingY: 12,
$Cols: 6
}
};

var jssor_slider1 = new $JssorSlider$("slider3_container", options);

function ScaleSlider() {
var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
if (parentWidth)
jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 960), 300));
else
window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
});