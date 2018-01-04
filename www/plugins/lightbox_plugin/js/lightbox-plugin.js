!function($,e,t,s){"use strict";function o(e,s){if(this.el=e,this.$el=$(e),this.s=$.extend({},i,s),this.s.dynamic&&"undefined"!==this.s.dynamicEl&&this.s.dynamicEl.constructor===Array&&!this.s.dynamicEl.length)throw"When using dynamic mode, you must also define dynamicEl as an Array.";return this.modules={},this.lGalleryOn=!1,this.lgBusy=!1,this.hideBartimeout=!1,this.isTouch="ontouchstart"in t.documentElement,this.s.slideEndAnimatoin&&(this.s.hideControlOnEnd=!1),this.s.dynamic?this.$items=this.s.dynamicEl:"this"===this.s.selector?this.$items=this.$el:""!==this.s.selector?this.s.selectWithin?this.$items=$(this.s.selectWithin).find(this.s.selector):this.$items=this.$el.find($(this.s.selector)):this.$items=this.$el.children(),this.$slide="",this.$outer="",this.init(),this}var i={mode:"lg-slide",cssEasing:"ease",easing:"linear",speed:600,height:"100%",width:"100%",addClass:"",startClass:"lg-start-zoom",backdropDuration:150,hideBarsDelay:6e3,useLeft:!1,closable:!0,loop:!0,escKey:!0,keyPress:!0,controls:!0,slideEndAnimatoin:!0,hideControlOnEnd:!1,mousewheel:!0,getCaptionFromTitleOrAlt:!0,appendSubHtmlTo:".lg-sub-html",subHtmlSelectorRelative:!1,preload:1,showAfterLoad:!0,selector:"",selectWithin:"",nextHtml:"",prevHtml:"",index:!1,iframeMaxWidth:"100%",download:!0,counter:!0,appendCounterTo:".lg-toolbar",swipeThreshold:50,enableSwipe:!0,enableDrag:!0,dynamic:!1,dynamicEl:[],galleryId:1};o.prototype.init=function(){var t=this;t.s.preload>t.$items.length&&(t.s.preload=t.$items.length);var s=e.location.hash;s.indexOf("lg="+this.s.galleryId)>0&&(t.index=parseInt(s.split("&slide=")[1],10),$("body").addClass("lg-from-hash"),$("body").hasClass("lg-on")||setTimeout(function(){t.build(t.index),$("body").addClass("lg-on")})),t.s.dynamic?(t.$el.trigger("onBeforeOpen.lg"),t.index=t.s.index||0,$("body").hasClass("lg-on")||setTimeout(function(){t.build(t.index),$("body").addClass("lg-on")})):t.$items.on("click.lgcustom",function(e){try{e.preventDefault(),e.preventDefault()}catch(s){e.returnValue=!1}t.$el.trigger("onBeforeOpen.lg"),t.index=t.s.index||t.$items.index(this),$("body").hasClass("lg-on")||(t.build(t.index),$("body").addClass("lg-on"))})},o.prototype.build=function(e){var t=this;t.structure(),$.each($.fn.lightGallery.modules,function(e){t.modules[e]=new $.fn.lightGallery.modules[e](t.el)}),t.slide(e,!1,!1),t.s.keyPress&&t.keyPress(),t.$items.length>1&&(t.arrow(),setTimeout(function(){t.enableDrag(),t.enableSwipe()},50),t.s.mousewheel&&t.mousewheel()),t.counter(),t.closeGallery(),t.$el.trigger("onAfterOpen.lg"),t.$outer.on("mousemove.lg click.lg touchstart.lg",function(){t.$outer.removeClass("lg-hide-items"),clearTimeout(t.hideBartimeout),t.hideBartimeout=setTimeout(function(){t.$outer.addClass("lg-hide-items")},t.s.hideBarsDelay)})},o.prototype.structure=function(){var t="",s="",o=0,i="",l,r=this;for($("body").append('<div class="lg-backdrop"></div>'),$(".lg-backdrop").css("transition-duration",this.s.backdropDuration+"ms"),o=0;o<this.$items.length;o++)t+='<div class="lg-item"></div>';if(this.s.controls&&this.$items.length>1&&(s='<div class="lg-actions"><div class="lg-prev lg-icon">'+this.s.prevHtml+'</div><div class="lg-next lg-icon">'+this.s.nextHtml+"</div></div>"),".lg-sub-html"===this.s.appendSubHtmlTo&&(i='<div class="lg-sub-html"></div>'),l='<div class="lg-outer '+this.s.addClass+" "+this.s.startClass+'"><div class="lg" style="width:'+this.s.width+"; height:"+this.s.height+'"><div class="lg-inner">'+t+'</div><div class="lg-toolbar group"><span class="lg-close lg-icon"></span></div>'+s+i+"</div></div>",$("body").append(l),this.$outer=$(".lg-outer"),this.$slide=this.$outer.find(".lg-item"),this.s.useLeft?(this.$outer.addClass("lg-use-left"),this.s.mode="lg-slide"):this.$outer.addClass("lg-use-css3"),r.setTop(),$(e).on("resize.lg orientationchange.lg",function(){setTimeout(function(){r.setTop()},100)}),this.$slide.eq(this.index).addClass("lg-current"),this.doCss()?this.$outer.addClass("lg-css3"):(this.$outer.addClass("lg-css"),this.s.speed=0),this.$outer.addClass(this.s.mode),this.s.enableDrag&&this.$items.length>1&&this.$outer.addClass("lg-grab"),this.s.showAfterLoad&&this.$outer.addClass("lg-show-after-load"),this.doCss()){var a=this.$outer.find(".lg-inner");a.css("transition-timing-function",this.s.cssEasing),a.css("transition-duration",this.s.speed+"ms")}$(".lg-backdrop").addClass("in"),setTimeout(function(){r.$outer.addClass("lg-visible")},this.s.backdropDuration),this.s.download&&this.$outer.find(".lg-toolbar").append('<a id="lg-download" target="_blank" download class="lg-download lg-icon"></a>'),this.prevScrollTop=$(e).scrollTop()},o.prototype.setTop=function(){if("100%"!==this.s.height){var t=$(e).height(),s=(t-parseInt(this.s.height,10))/2,o=this.$outer.find(".lg");t>=parseInt(this.s.height,10)?o.css("top",s+"px"):o.css("top","0px")}},o.prototype.doCss=function(){var e=function(){var e=["transition","MozTransition","WebkitTransition","OTransition","msTransition","KhtmlTransition"],s=t.documentElement,o=0;for(o=0;o<e.length;o++)if(e[o]in s.style)return!0};return!!e()},o.prototype.isVideo=function(e,t){var s;if(s=this.s.dynamic?this.s.dynamicEl[t].html:this.$items.eq(t).attr("data-html"),!e&&s)return{html5:!0};var o=e.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i),i=e.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i),l=e.match(/\/\/(?:www\.)?dai.ly\/([0-9a-z\-_]+)/i),r=e.match(/\/\/(?:www\.)?(?:vk\.com|vkontakte\.ru)\/(?:video_ext\.php\?)(.*)/i);return o?{youtube:o}:i?{vimeo:i}:l?{dailymotion:l}:r?{vk:r}:void 0},o.prototype.counter=function(){this.s.counter&&$(this.s.appendCounterTo).append('<div id="lg-counter"><span id="lg-counter-current">'+(parseInt(this.index,10)+1)+'</span> / <span id="lg-counter-all">'+this.$items.length+"</span></div>")},o.prototype.addHtml=function(e){var t=null,s,o;if(this.s.dynamic?this.s.dynamicEl[e].subHtmlUrl?s=this.s.dynamicEl[e].subHtmlUrl:t=this.s.dynamicEl[e].subHtml:(o=this.$items.eq(e),o.attr("data-sub-html-url")?s=o.attr("data-sub-html-url"):(t=o.attr("data-sub-html"),this.s.getCaptionFromTitleOrAlt&&!t&&(t=o.attr("title")||o.find("img").first().attr("alt")))),!s)if("undefined"!=typeof t&&null!==t){var i=t.substring(0,1);"."!==i&&"#"!==i||(t=this.s.subHtmlSelectorRelative&&!this.s.dynamic?o.find(t).html():$(t).html())}else t="";".lg-sub-html"===this.s.appendSubHtmlTo?s?this.$outer.find(this.s.appendSubHtmlTo).load(s):this.$outer.find(this.s.appendSubHtmlTo).html(t):s?this.$slide.eq(e).load(s):this.$slide.eq(e).append(t),"undefined"!=typeof t&&null!==t&&(""===t?this.$outer.find(this.s.appendSubHtmlTo).addClass("lg-empty-html"):this.$outer.find(this.s.appendSubHtmlTo).removeClass("lg-empty-html")),this.$el.trigger("onAfterAppendSubHtml.lg",[e])},o.prototype.preload=function(e){var t=1,s=1;for(t=1;t<=this.s.preload&&!(t>=this.$items.length-e);t++)this.loadContent(e+t,!1,0);for(s=1;s<=this.s.preload&&!(0>e-s);s++)this.loadContent(e-s,!1,0)},o.prototype.loadContent=function(t,s,o){var i=this,l=!1,r,a,n,d,u,c,h=function(t){for(var s=[],o=[],i=0;i<t.length;i++){var l=t[i].split(" ");""===l[0]&&l.splice(0,1),o.push(l[0]),s.push(l[1])}for(var r=$(e).width(),n=0;n<s.length;n++)if(parseInt(s[n],10)>r){a=o[n];break}};if(i.s.dynamic){if(i.s.dynamicEl[t].poster&&(l=!0,n=i.s.dynamicEl[t].poster),c=i.s.dynamicEl[t].html,a=i.s.dynamicEl[t].src,i.s.dynamicEl[t].responsive){var g=i.s.dynamicEl[t].responsive.split(",");h(g)}d=i.s.dynamicEl[t].srcset,u=i.s.dynamicEl[t].sizes}else{if(i.$items.eq(t).attr("data-poster")&&(l=!0,n=i.$items.eq(t).attr("data-poster")),c=i.$items.eq(t).attr("data-html"),a=i.$items.eq(t).attr("href")||i.$items.eq(t).attr("data-src"),i.$items.eq(t).attr("data-responsive")){var m=i.$items.eq(t).attr("data-responsive").split(",");h(m)}d=i.$items.eq(t).attr("data-srcset"),u=i.$items.eq(t).attr("data-sizes")}var p=!1;i.s.dynamic?i.s.dynamicEl[t].iframe&&(p=!0):"true"===i.$items.eq(t).attr("data-iframe")&&(p=!0);var f=i.isVideo(a,t);if(!i.$slide.eq(t).hasClass("lg-loaded")){if(p)i.$slide.eq(t).prepend('<div class="lg-video-cont" style="max-width:'+i.s.iframeMaxWidth+'"><div class="lg-video"><iframe class="lg-object" frameborder="0" src="'+a+'"  allowfullscreen="true"></iframe></div></div>');else if(l){var b="";b=f&&f.youtube?"lg-has-youtube":f&&f.vimeo?"lg-has-vimeo":"lg-has-html5",i.$slide.eq(t).prepend('<div class="lg-video-cont '+b+' "><div class="lg-video"><span class="lg-video-play"></span><img class="lg-object lg-has-poster" src="'+n+'" /></div></div>')}else f?(i.$slide.eq(t).prepend('<div class="lg-video-cont "><div class="lg-video"></div></div>'),i.$el.trigger("hasVideo.lg",[t,a,c])):i.$slide.eq(t).prepend('<div class="lg-img-wrap"><img class="lg-object lg-image" src="'+a+'" /></div>');if(i.$el.trigger("onAferAppendSlide.lg",[t]),r=i.$slide.eq(t).find(".lg-object"),u&&r.attr("sizes",u),d){r.attr("srcset",d);try{picturefill({elements:[r[0]]})}catch(v){console.error("Make sure you have included Picturefill version 2")}}".lg-sub-html"!==this.s.appendSubHtmlTo&&i.addHtml(t),i.$slide.eq(t).addClass("lg-loaded")}i.$slide.eq(t).find(".lg-object").on("load.lg error.lg",function(){var e=0;o&&!$("body").hasClass("lg-from-hash")&&(e=o),setTimeout(function(){i.$slide.eq(t).addClass("lg-complete"),i.$el.trigger("onSlideItemLoad.lg",[t,o||0])},e)}),f&&f.html5&&!l&&i.$slide.eq(t).addClass("lg-complete"),s===!0&&(i.$slide.eq(t).hasClass("lg-complete")?i.preload(t):i.$slide.eq(t).find(".lg-object").on("load.lg error.lg",function(){i.preload(t)}))},o.prototype.slide=function(e,t,s){var o=this.$outer.find(".lg-current").index(),i=this;if(!i.lGalleryOn||o!==e){var l=this.$slide.length,r=i.lGalleryOn?this.s.speed:0,a=!1,n=!1;if(!i.lgBusy){if(this.s.download){var d;d=i.s.dynamic?i.s.dynamicEl[e].downloadUrl!==!1&&(i.s.dynamicEl[e].downloadUrl||i.s.dynamicEl[e].src):"false"!==i.$items.eq(e).attr("data-download-url")&&(i.$items.eq(e).attr("data-download-url")||i.$items.eq(e).attr("href")||i.$items.eq(e).attr("data-src")),d?($("#lg-download").attr("href",d),i.$outer.removeClass("lg-hide-download")):i.$outer.addClass("lg-hide-download")}if(this.$el.trigger("onBeforeSlide.lg",[o,e,t,s]),i.lgBusy=!0,clearTimeout(i.hideBartimeout),".lg-sub-html"===this.s.appendSubHtmlTo&&setTimeout(function(){i.addHtml(e)},r),this.arrowDisable(e),t){var u=e-1,c=e+1;0===e&&o===l-1?(c=0,u=l-1):e===l-1&&0===o&&(c=0,u=l-1),this.$slide.removeClass("lg-prev-slide lg-current lg-next-slide"),i.$slide.eq(u).addClass("lg-prev-slide"),i.$slide.eq(c).addClass("lg-next-slide"),i.$slide.eq(e).addClass("lg-current")}else i.$outer.addClass("lg-no-trans"),this.$slide.removeClass("lg-prev-slide lg-next-slide"),o>e?(n=!0,0!==e||o!==l-1||s||(n=!1,a=!0)):e>o&&(a=!0,e!==l-1||0!==o||s||(n=!0,a=!1)),n?(this.$slide.eq(e).addClass("lg-prev-slide"),this.$slide.eq(o).addClass("lg-next-slide")):a&&(this.$slide.eq(e).addClass("lg-next-slide"),this.$slide.eq(o).addClass("lg-prev-slide")),setTimeout(function(){i.$slide.removeClass("lg-current"),i.$slide.eq(e).addClass("lg-current"),i.$outer.removeClass("lg-no-trans")},50);i.lGalleryOn?(setTimeout(function(){i.loadContent(e,!0,0)},this.s.speed+50),setTimeout(function(){i.lgBusy=!1,i.$el.trigger("onAfterSlide.lg",[o,e,t,s])},this.s.speed)):(i.loadContent(e,!0,i.s.backdropDuration),i.lgBusy=!1,i.$el.trigger("onAfterSlide.lg",[o,e,t,s])),i.lGalleryOn=!0,this.s.counter&&$("#lg-counter-current").text(e+1)}}},o.prototype.goToNextSlide=function(e){var t=this;t.lgBusy||(t.index+1<t.$slide.length?(t.index++,t.$el.trigger("onBeforeNextSlide.lg",[t.index]),t.slide(t.index,e,!1)):t.s.loop?(t.index=0,t.$el.trigger("onBeforeNextSlide.lg",[t.index]),t.slide(t.index,e,!1)):t.s.slideEndAnimatoin&&(t.$outer.addClass("lg-right-end"),setTimeout(function(){t.$outer.removeClass("lg-right-end")},400)))},o.prototype.goToPrevSlide=function(e){var t=this;t.lgBusy||(t.index>0?(t.index--,t.$el.trigger("onBeforePrevSlide.lg",[t.index,e]),t.slide(t.index,e,!1)):t.s.loop?(t.index=t.$items.length-1,t.$el.trigger("onBeforePrevSlide.lg",[t.index,e]),t.slide(t.index,e,!1)):t.s.slideEndAnimatoin&&(t.$outer.addClass("lg-left-end"),setTimeout(function(){t.$outer.removeClass("lg-left-end")},400)))},o.prototype.keyPress=function(){var t=this;this.$items.length>1&&$(e).on("keyup.lg",function(e){t.$items.length>1&&(37===e.keyCode&&(e.preventDefault(),t.goToPrevSlide()),39===e.keyCode&&(e.preventDefault(),t.goToNextSlide()))}),$(e).on("keydown.lg",function(e){t.s.escKey===!0&&27===e.keyCode&&(e.preventDefault(),t.$outer.hasClass("lg-thumb-open")?t.$outer.removeClass("lg-thumb-open"):t.destroy())})},o.prototype.arrow=function(){var e=this;this.$outer.find(".lg-prev").on("click.lg",function(){e.goToPrevSlide()}),this.$outer.find(".lg-next").on("click.lg",function(){e.goToNextSlide()})},o.prototype.arrowDisable=function(e){!this.s.loop&&this.s.hideControlOnEnd&&(e+1<this.$slide.length?this.$outer.find(".lg-next").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-next").attr("disabled","disabled").addClass("disabled"),e>0?this.$outer.find(".lg-prev").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-prev").attr("disabled","disabled").addClass("disabled"))},o.prototype.setTranslate=function(e,t,s){this.s.useLeft?e.css("left",t):e.css({transform:"translate3d("+t+"px, "+s+"px, 0px)"})},o.prototype.touchMove=function(e,t){var s=t-e;Math.abs(s)>15&&(this.$outer.addClass("lg-dragging"),this.setTranslate(this.$slide.eq(this.index),s,0),this.setTranslate($(".lg-prev-slide"),-this.$slide.eq(this.index).width()+s,0),this.setTranslate($(".lg-next-slide"),this.$slide.eq(this.index).width()+s,0))},o.prototype.touchEnd=function(e){var t=this;"lg-slide"!==t.s.mode&&t.$outer.addClass("lg-slide"),this.$slide.not(".lg-current, .lg-prev-slide, .lg-next-slide").css("opacity","0"),setTimeout(function(){t.$outer.removeClass("lg-dragging"),0>e&&Math.abs(e)>t.s.swipeThreshold?t.goToNextSlide(!0):e>0&&Math.abs(e)>t.s.swipeThreshold?t.goToPrevSlide(!0):Math.abs(e)<5&&t.$el.trigger("onSlideClick.lg"),t.$slide.removeAttr("style")}),setTimeout(function(){t.$outer.hasClass("lg-dragging")||"lg-slide"===t.s.mode||t.$outer.removeClass("lg-slide")},t.s.speed+100)},o.prototype.enableSwipe=function(){var e=this,t=0,s=0,o=!1;e.s.enableSwipe&&e.isTouch&&e.doCss()&&(e.$slide.on("touchstart.lg",function(s){e.$outer.hasClass("lg-zoomed")||e.lgBusy||(s.preventDefault(),e.manageSwipeClass(),t=s.originalEvent.targetTouches[0].pageX)}),e.$slide.on("touchmove.lg",function(i){e.$outer.hasClass("lg-zoomed")||(i.preventDefault(),s=i.originalEvent.targetTouches[0].pageX,e.touchMove(t,s),o=!0)}),e.$slide.on("touchend.lg",function(){e.$outer.hasClass("lg-zoomed")||(o?(o=!1,e.touchEnd(s-t)):e.$el.trigger("onSlideClick.lg"))}))},o.prototype.enableDrag=function(){var t=this,s=0,o=0,i=!1,l=!1;t.s.enableDrag&&!t.isTouch&&t.doCss()&&(t.$slide.on("mousedown.lg",function(e){t.$outer.hasClass("lg-zoomed")||($(e.target).hasClass("lg-object")||$(e.target).hasClass("lg-video-play"))&&(e.preventDefault(),t.lgBusy||(t.manageSwipeClass(),s=e.pageX,i=!0,t.$outer.scrollLeft+=1,t.$outer.scrollLeft-=1,t.$outer.removeClass("lg-grab").addClass("lg-grabbing"),t.$el.trigger("onDragstart.lg")))}),$(e).on("mousemove.lg",function(e){i&&(l=!0,o=e.pageX,t.touchMove(s,o),t.$el.trigger("onDragmove.lg"))}),$(e).on("mouseup.lg",function(e){l?(l=!1,t.touchEnd(o-s),t.$el.trigger("onDragend.lg")):($(e.target).hasClass("lg-object")||$(e.target).hasClass("lg-video-play"))&&t.$el.trigger("onSlideClick.lg"),i&&(i=!1,t.$outer.removeClass("lg-grabbing").addClass("lg-grab"))}))},o.prototype.manageSwipeClass=function(){var e=this.index+1,t=this.index-1,s=this.$slide.length;this.s.loop&&(0===this.index?t=s-1:this.index===s-1&&(e=0)),this.$slide.removeClass("lg-next-slide lg-prev-slide"),t>-1&&this.$slide.eq(t).addClass("lg-prev-slide"),this.$slide.eq(e).addClass("lg-next-slide")},o.prototype.mousewheel=function(){var e=this;e.$outer.on("mousewheel.lg",function(t){t.deltaY&&(t.deltaY>0?e.goToPrevSlide():e.goToNextSlide(),t.preventDefault())})},o.prototype.closeGallery=function(){var e=this,t=!1;this.$outer.find(".lg-close").on("click.lg",function(){e.destroy()}),e.s.closable&&(e.$outer.on("mousedown.lg",function(e){t=!!($(e.target).is(".lg-outer")||$(e.target).is(".lg-item ")||$(e.target).is(".lg-img-wrap"))}),e.$outer.on("mouseup.lg",function(s){($(s.target).is(".lg-outer")||$(s.target).is(".lg-item ")||$(s.target).is(".lg-img-wrap")&&t)&&(e.$outer.hasClass("lg-dragging")||e.destroy())}))},o.prototype.destroy=function(t){var s=this;t||s.$el.trigger("onBeforeClose.lg"),$(e).scrollTop(s.prevScrollTop),t&&(s.s.dynamic||this.$items.off("click.lg click.lgcustom"),$.removeData(s.el,"lightGallery")),this.$el.off(".lg.tm"),$.each($.fn.lightGallery.modules,function(e){s.modules[e]&&s.modules[e].destroy()}),this.lGalleryOn=!1,clearTimeout(s.hideBartimeout),this.hideBartimeout=!1,$(e).off(".lg"),$("body").removeClass("lg-on lg-from-hash"),s.$outer&&s.$outer.removeClass("lg-visible"),$(".lg-backdrop").removeClass("in"),setTimeout(function(){s.$outer&&s.$outer.remove(),$(".lg-backdrop").remove(),t||s.$el.trigger("onCloseAfter.lg")},s.s.backdropDuration+50)},$.fn.lightGallery=function(e){return this.each(function(){if($.data(this,"lightGallery"))try{$(this).data("lightGallery").init()}catch(t){console.error("lightGallery has not initiated properly")}else $.data(this,"lightGallery",new o(this,e))})},$.fn.lightGallery.modules={}}(jQuery,window,document),/**
 * Autoplay Plugin
 * @version 1.2.0
 * @author Sachin N - @sachinchoolur
 * @license MIT License (MIT)
 */
function($,e,t,s){"use strict";var o={autoplay:!1,pause:5e3,progressBar:!0,fourceAutoplay:!1,autoplayControls:!0,appendAutoplayControlsTo:".lg-toolbar"},i=function(e){return this.core=$(e).data("lightGallery"),this.$el=$(e),this.core.$items.length<2?!1:(this.core.s=$.extend({},o,this.core.s),this.interval=!1,this.fromAuto=!0,this.canceledOnTouch=!1,this.fourceAutoplayTemp=this.core.s.fourceAutoplay,this.core.doCss()||(this.core.s.progressBar=!1),this.init(),this)};i.prototype.init=function(){var e=this;e.core.s.autoplayControls&&e.controls(),e.core.s.progressBar&&e.core.$outer.find(".lg").append('<div class="lg-progress-bar"><div class="lg-progress"></div></div>'),e.progress(),e.core.s.autoplay&&e.startlAuto(),e.$el.on("onDragstart.lg.tm touchstart.lg.tm",function(){e.interval&&(e.cancelAuto(),e.canceledOnTouch=!0)}),e.$el.on("onDragend.lg.tm touchend.lg.tm onSlideClick.lg.tm",function(){!e.interval&&e.canceledOnTouch&&(e.startlAuto(),e.canceledOnTouch=!1)})},i.prototype.progress=function(){var e=this,t,s;e.$el.on("onBeforeSlide.lg.tm",function(){e.core.s.progressBar&&e.fromAuto&&(t=e.core.$outer.find(".lg-progress-bar"),s=e.core.$outer.find(".lg-progress"),e.interval&&(s.removeAttr("style"),t.removeClass("lg-start"),setTimeout(function(){s.css("transition","width "+(e.core.s.speed+e.core.s.pause)+"ms ease 0s"),t.addClass("lg-start")},20))),e.fromAuto||e.core.s.fourceAutoplay||e.cancelAuto(),e.fromAuto=!1})},i.prototype.controls=function(){var e=this,t='<span class="lg-autoplay-button lg-icon"></span>';$(this.core.s.appendAutoplayControlsTo).append(t),e.core.$outer.find(".lg-autoplay-button").on("click.lg",function(){$(e.core.$outer).hasClass("lg-show-autoplay")?(e.cancelAuto(),e.core.s.fourceAutoplay=!1):e.interval||(e.startlAuto(),e.core.s.fourceAutoplay=e.fourceAutoplayTemp)})},i.prototype.startlAuto=function(){var e=this;e.core.$outer.find(".lg-progress").css("transition","width "+(e.core.s.speed+e.core.s.pause)+"ms ease 0s"),e.core.$outer.addClass("lg-show-autoplay"),e.core.$outer.find(".lg-progress-bar").addClass("lg-start"),e.interval=setInterval(function(){e.core.index+1<e.core.$items.length?e.core.index++:e.core.index=0,e.fromAuto=!0,e.core.slide(e.core.index,!1,!1)},e.core.s.speed+e.core.s.pause)},i.prototype.cancelAuto=function(){clearInterval(this.interval),this.interval=!1,this.core.$outer.find(".lg-progress").removeAttr("style"),this.core.$outer.removeClass("lg-show-autoplay"),this.core.$outer.find(".lg-progress-bar").removeClass("lg-start")},i.prototype.destroy=function(){this.cancelAuto(),this.core.$outer.find(".lg-progress-bar").remove()},$.fn.lightGallery.modules.autoplay=i}(jQuery,window,document),function($,e,t,s){"use strict";var o={fullScreen:!0},i=function(e){return this.core=$(e).data("lightGallery"),this.$el=$(e),this.core.s=$.extend({},o,this.core.s),this.init(),this};i.prototype.init=function(){var e="";if(this.core.s.fullScreen){if(!(t.fullscreenEnabled||t.webkitFullscreenEnabled||t.mozFullScreenEnabled||t.msFullscreenEnabled))return;e='<span class="lg-fullscreen lg-icon"></span>',this.core.$outer.find(".lg-toolbar").append(e),this.fullScreen()}},i.prototype.requestFullscreen=function(){var e=t.documentElement;e.requestFullscreen?e.requestFullscreen():e.msRequestFullscreen?e.msRequestFullscreen():e.mozRequestFullScreen?e.mozRequestFullScreen():e.webkitRequestFullscreen&&e.webkitRequestFullscreen()},i.prototype.exitFullscreen=function(){t.exitFullscreen?t.exitFullscreen():t.msExitFullscreen?t.msExitFullscreen():t.mozCancelFullScreen?t.mozCancelFullScreen():t.webkitExitFullscreen&&t.webkitExitFullscreen()},i.prototype.fullScreen=function(){var e=this;$(t).on("fullscreenchange.lg webkitfullscreenchange.lg mozfullscreenchange.lg MSFullscreenChange.lg",function(){e.core.$outer.toggleClass("lg-fullscreen-on")}),this.core.$outer.find(".lg-fullscreen").on("click.lg",function(){t.fullscreenElement||t.mozFullScreenElement||t.webkitFullscreenElement||t.msFullscreenElement?e.exitFullscreen():e.requestFullscreen()})},i.prototype.destroy=function(){this.exitFullscreen(),$(t).off("fullscreenchange.lg webkitfullscreenchange.lg mozfullscreenchange.lg MSFullscreenChange.lg")},$.fn.lightGallery.modules.fullscreen=i}(jQuery,window,document),function($,e,t,s){"use strict";var o={pager:!1},i=function(e){return this.core=$(e).data("lightGallery"),this.$el=$(e),this.core.s=$.extend({},o,this.core.s),this.core.s.pager&&this.core.$items.length>1&&this.init(),this};i.prototype.init=function(){var e=this,t="",s,o,i;if(e.core.$outer.find(".lg").append('<div class="lg-pager-outer"></div>'),e.core.s.dynamic)for(var l=0;l<e.core.s.dynamicEl.length;l++)t+='<span class="lg-pager-cont"> <span class="lg-pager"></span><div class="lg-pager-thumb-cont"><span class="lg-caret"></span> <img src="'+e.core.s.dynamicEl[l].thumb+'" /></div></span>';else e.core.$items.each(function(){t+=e.core.s.exThumbImage?'<span class="lg-pager-cont"> <span class="lg-pager"></span><div class="lg-pager-thumb-cont"><span class="lg-caret"></span> <img src="'+$(this).attr(e.core.s.exThumbImage)+'" /></div></span>':'<span class="lg-pager-cont"> <span class="lg-pager"></span><div class="lg-pager-thumb-cont"><span class="lg-caret"></span> <img src="'+$(this).find("img").attr("src")+'" /></div></span>'});o=e.core.$outer.find(".lg-pager-outer"),o.html(t),s=e.core.$outer.find(".lg-pager-cont"),s.on("click.lg touchend.lg",function(){var t=$(this);e.core.index=t.index(),e.core.slide(e.core.index,!1,!1)}),o.on("mouseover.lg",function(){clearTimeout(i),o.addClass("lg-pager-hover")}),o.on("mouseout.lg",function(){i=setTimeout(function(){o.removeClass("lg-pager-hover")})}),e.core.$el.on("onBeforeSlide.lg.tm",function(e,t,o){s.removeClass("lg-pager-active"),s.eq(o).addClass("lg-pager-active")})},i.prototype.destroy=function(){},$.fn.lightGallery.modules.pager=i}(jQuery,window,document),function($,e,t,s){"use strict";var o={thumbnail:!0,animateThumb:!0,currentPagerPosition:"middle",thumbWidth:100,thumbContHeight:100,thumbMargin:5,exThumbImage:!1,showThumbByDefault:!0,toogleThumb:!0,pullCaptionUp:!0,enableThumbDrag:!0,enableThumbSwipe:!0,swipeThreshold:50,loadYoutubeThumbnail:!0,youtubeThumbSize:1,loadVimeoThumbnail:!0,vimeoThumbSize:"thumbnail_small",loadDailymotionThumbnail:!0},i=function(e){return this.core=$(e).data("lightGallery"),this.core.s=$.extend({},o,this.core.s),this.$el=$(e),this.$thumbOuter=null,this.thumbOuterWidth=0,this.thumbTotalWidth=this.core.$items.length*(this.core.s.thumbWidth+this.core.s.thumbMargin),this.thumbIndex=this.core.index,this.left=0,this.init(),this};i.prototype.init=function(){var e=this;this.core.s.thumbnail&&this.core.$items.length>1&&(this.core.s.showThumbByDefault&&setTimeout(function(){e.core.$outer.addClass("lg-thumb-open")},700),this.core.s.pullCaptionUp&&this.core.$outer.addClass("lg-pull-caption-up"),this.build(),this.core.s.animateThumb?(this.core.s.enableThumbDrag&&!this.core.isTouch&&this.core.doCss()&&this.enableThumbDrag(),this.core.s.enableThumbSwipe&&this.core.isTouch&&this.core.doCss()&&this.enableThumbSwipe(),this.thumbClickable=!1):this.thumbClickable=!0,this.toogle(),this.thumbkeyPress())},i.prototype.build=function(){function t(e,t,l){var r=s.core.isVideo(e,l)||{},a,n="";r.youtube||r.vimeo||r.dailymotion?r.youtube?a=s.core.s.loadYoutubeThumbnail?"//img.youtube.com/vi/"+r.youtube[1]+"/"+s.core.s.youtubeThumbSize+".jpg":t:r.vimeo?s.core.s.loadVimeoThumbnail?(a="//i.vimeocdn.com/video/error_"+i+".jpg",n=r.vimeo[1]):a=t:r.dailymotion&&(a=s.core.s.loadDailymotionThumbnail?"//www.dailymotion.com/thumbnail/video/"+r.dailymotion[1]:t):a=t,o+='<div data-vimeo-id="'+n+'" class="lg-thumb-item" style="width:'+s.core.s.thumbWidth+"px; margin-right: "+s.core.s.thumbMargin+'px"><img src="'+a+'" /></div>',n=""}var s=this,o="",i="",l,r='<div class="lg-thumb-outer"><div class="lg-thumb group"></div></div>';switch(this.core.s.vimeoThumbSize){case"thumbnail_large":i="640";break;case"thumbnail_medium":i="200x150";break;case"thumbnail_small":i="100x75"}if(s.core.$outer.addClass("lg-has-thumb"),s.core.$outer.find(".lg").append(r),s.$thumbOuter=s.core.$outer.find(".lg-thumb-outer"),s.thumbOuterWidth=s.$thumbOuter.width(),s.core.s.animateThumb&&s.core.$outer.find(".lg-thumb").css({width:s.thumbTotalWidth+"px",position:"relative"}),this.core.s.animateThumb&&s.$thumbOuter.css("height",s.core.s.thumbContHeight+"px"),s.core.s.dynamic)for(var a=0;a<s.core.s.dynamicEl.length;a++)t(s.core.s.dynamicEl[a].src,s.core.s.dynamicEl[a].thumb,a);else s.core.$items.each(function(e){s.core.s.exThumbImage?t($(this).attr("href")||$(this).attr("data-src"),$(this).attr(s.core.s.exThumbImage),e):t($(this).attr("href")||$(this).attr("data-src"),$(this).find("img").attr("src"),e)});s.core.$outer.find(".lg-thumb").html(o),l=s.core.$outer.find(".lg-thumb-item"),l.each(function(){var e=$(this),t=e.attr("data-vimeo-id");t&&$.getJSON("//www.vimeo.com/api/v2/video/"+t+".json?callback=?",{format:"json"},function(t){e.find("img").attr("src",t[0][s.core.s.vimeoThumbSize])})}),l.eq(s.core.index).addClass("active"),s.core.$el.on("onBeforeSlide.lg.tm",function(){l.removeClass("active"),l.eq(s.core.index).addClass("active")}),l.on("click.lg touchend.lg",function(){var e=$(this);setTimeout(function(){(s.thumbClickable&&!s.core.lgBusy||!s.core.doCss())&&(s.core.index=e.index(),s.core.slide(s.core.index,!1,!0))},50)}),s.core.$el.on("onBeforeSlide.lg.tm",function(){s.animateThumb(s.core.index)}),$(e).on("resize.lg.thumb orientationchange.lg.thumb",function(){setTimeout(function(){s.animateThumb(s.core.index),s.thumbOuterWidth=s.$thumbOuter.width()},200)})},i.prototype.setTranslate=function(e){this.core.$outer.find(".lg-thumb").css({transform:"translate3d(-"+e+"px, 0px, 0px)"})},i.prototype.animateThumb=function(e){var t=this.core.$outer.find(".lg-thumb");if(this.core.s.animateThumb){var s;switch(this.core.s.currentPagerPosition){case"left":s=0;break;case"middle":s=this.thumbOuterWidth/2-this.core.s.thumbWidth/2;break;case"right":s=this.thumbOuterWidth-this.core.s.thumbWidth}this.left=(this.core.s.thumbWidth+this.core.s.thumbMargin)*e-1-s,this.left>this.thumbTotalWidth-this.thumbOuterWidth&&(this.left=this.thumbTotalWidth-this.thumbOuterWidth),this.left<0&&(this.left=0),this.core.lGalleryOn?(t.hasClass("on")||this.core.$outer.find(".lg-thumb").css("transition-duration",this.core.s.speed+"ms"),this.core.doCss()||t.animate({left:-this.left+"px"},this.core.s.speed)):this.core.doCss()||t.css("left",-this.left+"px"),this.setTranslate(this.left)}},i.prototype.enableThumbDrag=function(){var t=this,s=0,o=0,i=!1,l=!1,r=0;t.$thumbOuter.addClass("lg-grab"),t.core.$outer.find(".lg-thumb").on("mousedown.lg.thumb",function(e){t.thumbTotalWidth>t.thumbOuterWidth&&(e.preventDefault(),s=e.pageX,i=!0,t.core.$outer.scrollLeft+=1,t.core.$outer.scrollLeft-=1,t.thumbClickable=!1,t.$thumbOuter.removeClass("lg-grab").addClass("lg-grabbing"))}),$(e).on("mousemove.lg.thumb",function(e){i&&(r=t.left,l=!0,o=e.pageX,t.$thumbOuter.addClass("lg-dragging"),r-=o-s,r>t.thumbTotalWidth-t.thumbOuterWidth&&(r=t.thumbTotalWidth-t.thumbOuterWidth),0>r&&(r=0),t.setTranslate(r))}),$(e).on("mouseup.lg.thumb",function(){l?(l=!1,t.$thumbOuter.removeClass("lg-dragging"),t.left=r,Math.abs(o-s)<t.core.s.swipeThreshold&&(t.thumbClickable=!0)):t.thumbClickable=!0,i&&(i=!1,t.$thumbOuter.removeClass("lg-grabbing").addClass("lg-grab"))})},i.prototype.enableThumbSwipe=function(){var e=this,t=0,s=0,o=!1,i=0;e.core.$outer.find(".lg-thumb").on("touchstart.lg",function(s){e.thumbTotalWidth>e.thumbOuterWidth&&(s.preventDefault(),t=s.originalEvent.targetTouches[0].pageX,e.thumbClickable=!1)}),e.core.$outer.find(".lg-thumb").on("touchmove.lg",function(l){e.thumbTotalWidth>e.thumbOuterWidth&&(l.preventDefault(),s=l.originalEvent.targetTouches[0].pageX,o=!0,e.$thumbOuter.addClass("lg-dragging"),i=e.left,i-=s-t,i>e.thumbTotalWidth-e.thumbOuterWidth&&(i=e.thumbTotalWidth-e.thumbOuterWidth),0>i&&(i=0),e.setTranslate(i))}),e.core.$outer.find(".lg-thumb").on("touchend.lg",function(){e.thumbTotalWidth>e.thumbOuterWidth&&o?(o=!1,e.$thumbOuter.removeClass("lg-dragging"),Math.abs(s-t)<e.core.s.swipeThreshold&&(e.thumbClickable=!0),e.left=i):e.thumbClickable=!0})},i.prototype.toogle=function(){var e=this;e.core.s.toogleThumb&&(e.core.$outer.addClass("lg-can-toggle"),e.$thumbOuter.append('<span class="lg-toogle-thumb lg-icon"></span>'),e.core.$outer.find(".lg-toogle-thumb").on("click.lg",function(){e.core.$outer.toggleClass("lg-thumb-open")}))},i.prototype.thumbkeyPress=function(){var t=this;$(e).on("keydown.lg.thumb",function(e){38===e.keyCode?(e.preventDefault(),t.core.$outer.addClass("lg-thumb-open")):40===e.keyCode&&(e.preventDefault(),t.core.$outer.removeClass("lg-thumb-open"))})},i.prototype.destroy=function(){this.core.s.thumbnail&&this.core.$items.length>1&&($(e).off("resize.lg.thumb orientationchange.lg.thumb keydown.lg.thumb"),this.$thumbOuter.remove(),this.core.$outer.removeClass("lg-has-thumb"))},$.fn.lightGallery.modules.Thumbnail=i}(jQuery,window,document),function($,e,t,s){"use strict";var o={scale:1,zoom:!0,actualSize:!0,enableZoomAfter:300},i=function(t){return this.core=$(t).data("lightGallery"),this.core.s=$.extend({},o,this.core.s),this.core.s.zoom&&this.core.doCss()&&(this.init(),this.zoomabletimeout=!1,this.pageX=$(e).width()/2,this.pageY=$(e).height()/2+$(e).scrollTop()),this};i.prototype.init=function(){var t=this,s='<span id="lg-zoom-in" class="lg-icon"></span><span id="lg-zoom-out" class="lg-icon"></span>';t.core.s.actualSize&&(s+='<span id="lg-actual-size" class="lg-icon"></span>'),this.core.$outer.find(".lg-toolbar").append(s),t.core.$el.on("onSlideItemLoad.lg.tm.zoom",function(e,s,o){var i=t.core.s.enableZoomAfter+o;$("body").hasClass("lg-from-hash")&&o?i=0:$("body").removeClass("lg-from-hash"),t.zoomabletimeout=setTimeout(function(){t.core.$slide.eq(s).addClass("lg-zoomable")},i+30)});var o=1,i=function(s){var o=t.core.$outer.find(".lg-current .lg-image"),i,l,r=($(e).width()-o.width())/2,a=($(e).height()-o.height())/2+$(e).scrollTop();i=t.pageX-r,l=t.pageY-a;var n=(s-1)*i,d=(s-1)*l;o.css("transform","scale3d("+s+", "+s+", 1)").attr("data-scale",s),o.parent().css({left:-n+"px",top:-d+"px"}).attr("data-x",n).attr("data-y",d)},l=function(){o>1?t.core.$outer.addClass("lg-zoomed"):t.resetZoom(),1>o&&(o=1),i(o)},r=function(s,i,r,a){var n=i.width(),d;d=t.core.s.dynamic?t.core.s.dynamicEl[r].width||i[0].naturalWidth||n:t.core.$items.eq(r).attr("data-width")||i[0].naturalWidth||n;var u;t.core.$outer.hasClass("lg-zoomed")?o=1:d>n&&(u=d/n,o=u||2),a?(t.pageX=$(e).width()/2,t.pageY=$(e).height()/2+$(e).scrollTop()):(t.pageX=s.pageX||s.originalEvent.targetTouches[0].pageX,t.pageY=s.pageY||s.originalEvent.targetTouches[0].pageY),l(),setTimeout(function(){t.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")},10)},a=!1;t.core.$el.on("onAferAppendSlide.lg.tm.zoom",function(e,s){var o=t.core.$slide.eq(s).find(".lg-image");o.on("dblclick",function(e){r(e,o,s)}),o.on("touchstart",function(e){a?(clearTimeout(a),a=null,r(e,o,s)):a=setTimeout(function(){a=null},300),e.preventDefault()})}),$(e).on("resize.lg.zoom scroll.lg.zoom orientationchange.lg.zoom",function(){t.pageX=$(e).width()/2,t.pageY=$(e).height()/2+$(e).scrollTop(),i(o)}),$("#lg-zoom-out").on("click.lg",function(){t.core.$outer.find(".lg-current .lg-image").length&&(o-=t.core.s.scale,l())}),$("#lg-zoom-in").on("click.lg",function(){t.core.$outer.find(".lg-current .lg-image").length&&(o+=t.core.s.scale,l())}),$("#lg-actual-size").on("click.lg",function(e){r(e,t.core.$slide.eq(t.core.index).find(".lg-image"),t.core.index,!0)}),t.core.$el.on("onBeforeSlide.lg.tm",function(){o=1,t.resetZoom()}),t.core.isTouch||t.zoomDrag(),t.core.isTouch&&t.zoomSwipe()},i.prototype.resetZoom=function(){this.core.$outer.removeClass("lg-zoomed"),this.core.$slide.find(".lg-img-wrap").removeAttr("style data-x data-y"),this.core.$slide.find(".lg-image").removeAttr("style data-scale"),this.pageX=$(e).width()/2,this.pageY=$(e).height()/2+$(e).scrollTop()},i.prototype.zoomSwipe=function(){var e=this,t={},s={},o=!1,i=!1,l=!1;e.core.$slide.on("touchstart.lg",function(s){if(e.core.$outer.hasClass("lg-zoomed")){var o=e.core.$slide.eq(e.core.index).find(".lg-object");l=o.outerHeight()*o.attr("data-scale")>e.core.$outer.find(".lg").height(),i=o.outerWidth()*o.attr("data-scale")>e.core.$outer.find(".lg").width(),(i||l)&&(s.preventDefault(),t={x:s.originalEvent.targetTouches[0].pageX,y:s.originalEvent.targetTouches[0].pageY})}}),e.core.$slide.on("touchmove.lg",function(r){if(e.core.$outer.hasClass("lg-zoomed")){var a=e.core.$slide.eq(e.core.index).find(".lg-img-wrap"),n,d;r.preventDefault(),o=!0,s={x:r.originalEvent.targetTouches[0].pageX,y:r.originalEvent.targetTouches[0].pageY},e.core.$outer.addClass("lg-zoom-dragging"),d=l?-Math.abs(a.attr("data-y"))+(s.y-t.y):-Math.abs(a.attr("data-y")),n=i?-Math.abs(a.attr("data-x"))+(s.x-t.x):-Math.abs(a.attr("data-x")),(Math.abs(s.x-t.x)>15||Math.abs(s.y-t.y)>15)&&a.css({left:n+"px",top:d+"px"})}}),e.core.$slide.on("touchend.lg",function(){e.core.$outer.hasClass("lg-zoomed")&&o&&(o=!1,e.core.$outer.removeClass("lg-zoom-dragging"),e.touchendZoom(t,s,i,l))})},i.prototype.zoomDrag=function(){var t=this,s={},o={},i=!1,l=!1,r=!1,a=!1;t.core.$slide.on("mousedown.lg.zoom",function(e){var o=t.core.$slide.eq(t.core.index).find(".lg-object");a=o.outerHeight()*o.attr("data-scale")>t.core.$outer.find(".lg").height(),r=o.outerWidth()*o.attr("data-scale")>t.core.$outer.find(".lg").width(),t.core.$outer.hasClass("lg-zoomed")&&$(e.target).hasClass("lg-object")&&(r||a)&&(e.preventDefault(),s={x:e.pageX,y:e.pageY},i=!0,t.core.$outer.scrollLeft+=1,t.core.$outer.scrollLeft-=1,t.core.$outer.removeClass("lg-grab").addClass("lg-grabbing"))}),$(e).on("mousemove.lg.zoom",function(e){if(i){var n=t.core.$slide.eq(t.core.index).find(".lg-img-wrap"),d,u;l=!0,o={x:e.pageX,y:e.pageY},t.core.$outer.addClass("lg-zoom-dragging"),u=a?-Math.abs(n.attr("data-y"))+(o.y-s.y):-Math.abs(n.attr("data-y")),d=r?-Math.abs(n.attr("data-x"))+(o.x-s.x):-Math.abs(n.attr("data-x")),n.css({left:d+"px",top:u+"px"})}}),$(e).on("mouseup.lg.zoom",function(e){i&&(i=!1,t.core.$outer.removeClass("lg-zoom-dragging"),!l||s.x===o.x&&s.y===o.y||(o={x:e.pageX,y:e.pageY},t.touchendZoom(s,o,r,a)),l=!1),t.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")})},i.prototype.touchendZoom=function(e,t,s,o){var i=this,l=i.core.$slide.eq(i.core.index).find(".lg-img-wrap"),r=i.core.$slide.eq(i.core.index).find(".lg-object"),a=-Math.abs(l.attr("data-x"))+(t.x-e.x),n=-Math.abs(l.attr("data-y"))+(t.y-e.y),d=(i.core.$outer.find(".lg").height()-r.outerHeight())/2,u=Math.abs(r.outerHeight()*Math.abs(r.attr("data-scale"))-i.core.$outer.find(".lg").height()+d),c=(i.core.$outer.find(".lg").width()-r.outerWidth())/2,h=Math.abs(r.outerWidth()*Math.abs(r.attr("data-scale"))-i.core.$outer.find(".lg").width()+c);(Math.abs(t.x-e.x)>15||Math.abs(t.y-e.y)>15)&&(o&&(-u>=n?n=-u:n>=-d&&(n=-d)),s&&(-h>=a?a=-h:a>=-c&&(a=-c)),o?l.attr("data-y",Math.abs(n)):n=-Math.abs(l.attr("data-y")),s?l.attr("data-x",Math.abs(a)):a=-Math.abs(l.attr("data-x")),l.css({left:a+"px",top:n+"px"}))},i.prototype.destroy=function(){var t=this;t.core.$el.off(".lg.zoom"),$(e).off(".lg.zoom"),t.core.$slide.off(".lg.zoom"),t.core.$el.off(".lg.tm.zoom"),t.resetZoom(),clearTimeout(t.zoomabletimeout),t.zoomabletimeout=!1},$.fn.lightGallery.modules.zoom=i}(jQuery,window,document),function($,e,t,s){"use strict";$.LightBoxSimple=function(e){e=$.extend({classImageThumbnail:"lb-thumbnail"},e);var t=$("img").filter(function(){return $(this).parent("a").length<=0});t.length&&t.each(function(){var t=$(this).attr("src"),s=$(this).hasClass("nolb");if(~t.indexOf("thumbs")&&!s){var o=t.replace("thumbs","uploads").replace("thumbnail.","");if($(this).is('[class*="group"]')){var i=$(this).attr("class").split(" "),l,r;for(r=0;r<i.length;r++)if(~i[r].indexOf("group")){l=i[r];break}$(this).wrap('<a class="lb-gallery-image '+e.classImageThumbnail+'" href="'+o+'" data-rel="'+l+'" data-sub-html="'+$(this).attr("alt")+'"></a>')}else $(this).wrap('<a class="lb-only-image '+e.classImageThumbnail+'" href="'+o+'" data-sub-html="'+$(this).attr("alt")+'"></a>')}});var s=$(".lb-gallery-image"),o={},i;if(s.length){s.each(function(){i=$(this).attr("data-rel"),o[i]=!0});for(var l in o)s.filter("[data-rel*="+l+"]").wrapAll('<div id="lb-gallery-'+l+'"></div>')}}}(jQuery,window,document);