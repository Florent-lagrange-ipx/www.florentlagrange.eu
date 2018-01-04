jQuery(document).ready(function ($) {
var _SlideshowTransitions = [
{$Duration:1400,x:0.25,$Zoom:1.5,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Zoom:$JssorEasing$.$EaseInSine},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1400,x:-0.25,$Zoom:1.5,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Zoom:$JssorEasing$.$EaseInSine},$Opacity:2,$ZIndex:-10}},
{$Duration:1600,x:-0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Opacity:$JssorEasing$.$EaseInOutQuad},$Assembly:260,$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:1000,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Opacity:$JssorEasing$.$EaseInOutQuad},$Opacity:2,$Round:{$Top:0.5}}},
{$Duration:1200,$Delay:20,$Clip:3,$Easing:{$Clip:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Assembly:260,$Opacity:2},
{$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Round:{$Left:1.3,$Top:2.5}},
{$Duration:800,$Delay:30,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Opacity:2},
{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Assembly:2050,$Outside:true,$Round:{$Top:1.3}},
{$Duration:1200,x:0.2,y:-0.1,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:3},$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Outside:true,$Round:{$Left:1.3,$Top:2.5}}
];

var _CaptionTransitions = [];
_CaptionTransitions["L"] = {$Duration:900,x:0.6,$Easing:{$Left:$JssorEasing$.$EaseInOutSine},$Opacity:2};
_CaptionTransitions["B|IB"] = {$Duration:1200,y:-0.6,$Easing:{$Top:$JssorEasing$.$EaseInOutBack},$Opacity:2};
_CaptionTransitions["T|IE"] = {$Duration:1200,y:0.6,$Easing:{$Top:$JssorEasing$.$EaseInOutElastic},$Opacity:2};
_CaptionTransitions["TR|EP"] = {$Duration:1200,x:-0.6,y:0.6,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Top:$JssorEasing$.$EaseInOutExpo},$Opacity:2};
_CaptionTransitions["T|IEFAST"] = {$Duration:600,y:0.6,$Easing:{$Top:$JssorEasing$.$EaseInOutElastic},$Opacity:2};
_CaptionTransitions["CLIP|LR"] = {$Duration:900,$Clip:3,$Easing:{$Clip:$JssorEasing$.$EaseInOutCubic},$Opacity:2};
_CaptionTransitions["MCLIP|L"] = {$Duration:900,$Clip:1,$Move:true,$Easing:{$Clip:$JssorEasing$.$EaseInOutCubic}};
_CaptionTransitions["LISTH|L"] = {$Duration:1500,x:0.8,$Clip:1,$Easing:$JssorEasing$.$EaseInOutCubic,$ScaleClip:0.8,$Opacity:2,$During:{$Left:[0.4,0.6],$Clip:[0,0.4],$Opacity:[0.4,0.6]}};
_CaptionTransitions["FADE"] = {$Duration:900,$Opacity:2};
_CaptionTransitions["B"] = {$Duration:900,y:-0.6,$Easing:{$Top:$JssorEasing$.$EaseInOutSine},$Opacity:2};
_CaptionTransitions["FADE-B*"] = {$Duration:1500,y:-0.5,$Rotate:6.25,$Easing:$JssorEasing$.$EaseLinear,$Opacity:2,$During:{$Top:[0,0.33],$Rotate:[0,0.33]},$Round:{$Rotate:0.25}};
_CaptionTransitions["T"] = {$Duration:900,y:0.6,$Easing:{$Top:$JssorEasing$.$EaseInOutSine},$Opacity:2};
_CaptionTransitions["MCLIP|B"] = { $Duration: 600, $Clip: 8, $Move: true, $Easing: $JssorEasing$.$EaseOutExpo };
_CaptionTransitions["RTT|2"] = {$Duration:900,$Zoom:3,$Rotate:1,$Easing:{$Zoom:$JssorEasing$.$EaseInQuad,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInQuad},$Opacity:2,$Round:{$Rotate:0.5}};
_CaptionTransitions["R-B*"] = {$Duration:1500,x:-0.5,y:-0.5,$Rotate:-1,$Easing:$JssorEasing$.$EaseLinear,$Opacity:2,$During:{$Left:[0.67,0.33],$Top:[0,0.33],$Rotate:[0,0.33]},$Round:{$Rotate:0.25}};
_CaptionTransitions["L|EP"] = {$Duration:1200,x:0.6,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo},$Opacity:2};
_CaptionTransitions["ZM*WVC|RT"] = {$Duration:1200,x:-0.5,y:0.3,$Zoom:11,$Easing:{$Left:$JssorEasing$.$EaseLinear,$Top:$JssorEasing$.$EaseOutWave},$Opacity:2,$Round:{$Rotate:0.8}};
_CaptionTransitions["MCLIP|T-FADE"] = {$Duration:1200,$Clip:4,$Move:true,$Opacity:1.7,$During:{$Clip:[0.5,0.5],$Opacity:[0,0.5]}};
_CaptionTransitions["FADE-R*"] = {$Duration:1500,x:-0.5,$Rotate:6.25,$Easing:$JssorEasing$.$EaseLinear,$Opacity:2,$During:{$Left:[0,0.33],$Rotate:[0,0.33]},$Round:{$Rotate:0.25}};
_CaptionTransitions["L-*IB"] = {$Duration:900,x:0.7,$Rotate:-0.5,$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseInQuad,$Rotate:$JssorEasing$.$EaseInBack},$Opacity:2,$During:{$Left:[0.2,0.8]}};
_CaptionTransitions["ZM"] = {$Duration:900,$Zoom:1,$Easing:$JssorEasing$.$EaseInCubic,$Opacity:2};
_CaptionTransitions["RTT|10"] = { $Duration: 900, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
_CaptionTransitions["ZMF|10"] = { $Duration: 900, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
_CaptionTransitions["MCLIP|R"] = { $Duration: 900, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
_CaptionTransitions["RTTL|BR"] = { $Duration: 900, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };

var options = {
$AutoPlay: true,
$AutoPlayInterval: 2000,
$SlideDuration: 800,
$ArrowKeyNavigation: false,
$PauseOnHover: 1,
$FillMode: 2,
$PlayOrientation: 1,
$DragOrientation: 1,

$SlideshowOptions: {
$Class: $JssorSlideshowRunner$,
$Transitions: _SlideshowTransitions,
$TransitionsOrder: 1,
$ShowLink: true
},

$CaptionSliderOptions: {
$Class: $JssorCaptionSlider$,
$CaptionTransitions: _CaptionTransitions,
$PlayInMode: 1,
$PlayOutMode: 1
},

$BulletNavigatorOptions: {
$Class: $JssorBulletNavigator$,
$ChanceToShow: 1,
$AutoCenter: 1,
$ActionMode: 1,
$SpacingX: 0,
$SpacingY: 0
},

$ArrowNavigatorOptions: {
$Class: $JssorArrowNavigator$,
$AutoCenter: 0,
$ChanceToShow: 1
},

$ThumbnailNavigatorOptions: {
$Class: $JssorThumbnailNavigator$,
$ChanceToShow: 1,
$ActionMode: 1,
$DisableDrag: false,
$Orientation: 1
}
};

var jssor_slider1 = new $JssorSlider$("slider1_container", options);

function ScaleSlider() {
var bodyWidth = document.body.clientWidth;
if (bodyWidth)
jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
else
window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
$('.jssor-slider .slider-inner').attr('style', 'display: block;');
});