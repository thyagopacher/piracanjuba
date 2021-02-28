var CookieCreate = {
	create: function(name,value,days) {
			if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
			}
			else {
				var expires = "";
			}
			document.cookie = name+"="+value+expires+"; path=/";
	},
	read: function(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		},
		erase: function (name) {
				this.create(name,"",-1);
		}
};
function Slugfy(str)
{
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	  str = str.toLowerCase();

	  // remove accents, swap ñ for n, etc
	  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
	  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
	  for (var i=0, l=from.length ; i<l ; i++) {
	    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	  }

	  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
	    .replace(/\s+/g, '-') // collapse whitespace and replace by -
	    .replace(/-+/g, '-'); // collapse dashes

	  return str;
}
function Mediabox2($)
{
	$.fn.Mediabox2 = function (options){
		var defaults = {
			mask: '.mask',
			btnPrev: '.btnPrev',
			btnNext: '.btnNext',
			list: '.destRotativo',
			listItem: 'li',
			itemTime: 5000,
			animTime: 500
		}
		$.fn.Mediabox2.options = $.extend(defaults, options);
		return this.each(function (){



			var $this = $(this), $mask = $($.fn.Mediabox2.options.mask, $this), $btnPrev = $($.fn.Mediabox2.options.btnPrev, $this), $btnNext = $($.fn.Mediabox2.options.btnNext, $this),  $list = $($.fn.Mediabox2.options.list, $this), $listItems = $($.fn.Mediabox2.options.listItem, $list);


			var itemWidth = $listItems.outerWidth(true);
			var listLeng = $listItems.length;
			var wdtList = itemWidth*($listItems.length+1);

			$list.css({"width": wdtList, "left": 0, 'position': 'absolute'});
			$mask.css({
				"width": itemWidth,
				"height": $listItems.outerHeight(true),
				"overflow": 'hidden',
				'position': 'relative'
			})
			var $first = $($.fn.Mediabox2.options.listItem+":first", $list);
			var $clone = $first.clone().addClass("cloned").appendTo($list);

			$first.addClass("selected");

			var timeout =  setTimeout(function (){
				$btnNext.click();
			}, $.fn.Mediabox2.options.itemTime);

			$btnNext.click(function (e){
				if(e.preventDefault){e.preventDefault();}

				clearTimeout(timeout);

				var fakeAnim = false;
				var $current = $($.fn.Mediabox2.options.listItem+".selected", $list);
				var $next = $current.next($.fn.Mediabox2.options.listItem);
				if($next.hasClass("cloned")){
					$next = $($.fn.Mediabox2.options.listItem+":first", $list);
					fakeAnim = true;
				}
				if($next[0])
				{
					$current.removeClass("selected");
					$next.addClass("selected");
					var index = $listItems.index($next);

					var pos = (index*itemWidth) * (-1);
					if(!fakeAnim)
					{



						$list.animate({'left': pos}, $.fn.Mediabox2.options.animTime);
					} else {
						pos = ((listLeng) * itemWidth) * (-1);
						$list.animate({'left': pos}, $.fn.Mediabox2.options.animTime, function (){
							$list.css({"left": 0});
						});
					}

					timeout =  setTimeout(function (){
						$btnNext.click();
					}, $.fn.Mediabox2.options.itemTime);

				}
				return false;
			})
			$btnPrev.click(function (e){
				if(e.preventDefault){e.preventDefault();}
				clearTimeout(timeout);

				var $current = $($.fn.Mediabox2.options.listItem+".selected", $list);
				var $next = $current.prev($.fn.Mediabox2.options.listItem);
				if(!$next[0])
				{
					$next = $($.fn.Mediabox2.options.listItem+":last", $list).prev($.fn.Mediabox2.options.listItem);
				}
				if($next[0])
				{
					$current.removeClass("selected");
					$next.addClass("selected");
					var index = $listItems.index($next);

					var pos = (index*itemWidth) * (-1);
					$list.animate({'left': pos}, $.fn.Mediabox2.options.animTime);
				}

				timeout =  setTimeout(function (){
					$btnNext.click();
				}, $.fn.Mediabox2.options.itemTime);
				return false;
			})

		})
	}
}
Mediabox2(jQuery)
function Mediabox3($)
{
	$.fn.Mediabox3 = function (options){
		var defaults = {
			mask: '.mask',
			btnPrev: '.btnPrev',
			btnNext: '.btnNext',
			list: '.destRotativo',
			listItem: 'li',
			itemTime: 5000,
			animTime: 500
		}
		$.fn.Mediabox3.options = $.extend(defaults, options);
		return this.each(function (){



			var $this = $(this), $mask = $($.fn.Mediabox3.options.mask, $this), $btnPrev = $($.fn.Mediabox3.options.btnPrev, $this), $btnNext = $($.fn.Mediabox3.options.btnNext, $this),  $list = $($.fn.Mediabox3.options.list, $this), $listItems = $($.fn.Mediabox3.options.listItem, $list);


			var itemWidth = $listItems.outerWidth(true);
			var listLeng = $listItems.length;
			var wdtList = itemWidth*($listItems.length+1);

			$list.css({"width": wdtList, "left": 0, 'position': 'absolute'});
			$mask.css({
				"width": itemWidth,
				"height": $listItems.outerHeight(true),
				"overflow": 'hidden',
				'position': 'relative'
			})
			var $first = $($.fn.Mediabox3.options.listItem+":first", $list);
			var $clone = $first.clone().addClass("cloned").appendTo($list);

			$first.addClass("selected");

			var timeout =  setTimeout(function (){
				$btnNext.click();
			}, $.fn.Mediabox3.options.itemTime);

			$btnNext.click(function (e){
				if(e.preventDefault){e.preventDefault();}

				clearTimeout(timeout);

				var fakeAnim = false;
				var $current = $($.fn.Mediabox3.options.listItem+".selected", $list);
				var $next = $current.next($.fn.Mediabox3.options.listItem);
				if($next.hasClass("cloned")){
					$next = $($.fn.Mediabox3.options.listItem+":first", $list);
					fakeAnim = true;
				}
				if($next[0])
				{
					$current.removeClass("selected");
					$next.addClass("selected");
					var index = $listItems.index($next);

					var pos = (index*itemWidth) * (-1);
					if(!fakeAnim)
					{



						$list.animate({'left': pos}, $.fn.Mediabox3.options.animTime);
					} else {
						pos = ((listLeng) * itemWidth) * (-1);
						$list.animate({'left': pos}, $.fn.Mediabox3.options.animTime, function (){
							$list.css({"left": 0});
						});
					}

					timeout =  setTimeout(function (){
						$btnNext.click();
					}, $.fn.Mediabox3.options.itemTime);

				}
				return false;
			})
			$btnPrev.click(function (e){
				if(e.preventDefault){e.preventDefault();}
				clearTimeout(timeout);

				var $current = $($.fn.Mediabox3.options.listItem+".selected", $list);
				var $next = $current.prev($.fn.Mediabox3.options.listItem);
				if(!$next[0])
				{
					$next = $($.fn.Mediabox3.options.listItem+":last", $list).prev($.fn.Mediabox3.options.listItem);
				}
				if($next[0])
				{
					$current.removeClass("selected");
					$next.addClass("selected");
					var index = $listItems.index($next);

					var pos = (index*itemWidth) * (-1);
					$list.animate({'left': pos}, $.fn.Mediabox3.options.animTime);
				}

				timeout =  setTimeout(function (){
					$btnNext.click();
				}, $.fn.Mediabox3.options.itemTime);
				return false;
			})

		})
	}
}
Mediabox3(jQuery);
function Mediabox4($)
{
	$.fn.Mediabox4  = function (options)
	{
		var defaults = {
			mask: ".mask",
			list: "destRotativo",
			listItem: 'li',
			btnPrev: ".btnPrev",
			btnNext: ".btnNext",
			mask: ".mask",
			pagers: ".nav-corta-pra-mim ul",
			pagerItem: "<li><span class=\"\"></span></li>",
			pagerClass: "cycle-pager-active",
			pagerTgt: "span",
			itemTime: 5000,
			animTime: 500
		}
		$.fn.Mediabox4.goSlid = function (pos, $ul, $this, maxX){
			$ul.animate({"left": pos}, 500);
			if(pos == maxX)
			{
				$this.addClass("BtnNextHide");
			} else {
				$this.removeClass("BtnNextHide");
			}
			if(pos == 0)
			{
				$this.addClass("BtnPrevHide");
			} else {
				$this.removeClass("BtnPrevHide");
			}
		}
		$.fn.Mediabox4.options = $.extend(defaults, options);
		return this.each(function (){
			var $this = $(this), $mask = $($.fn.Mediabox4.options.mask, $this), $ul = $($.fn.Mediabox4.options.list, $mask), $pagers = $($.fn.Mediabox4.options.pagers, $this);
			$pagers.html("");

			if($.fn.Mediabox4.options.btnPrev != null)
			{
				var $btnPrev = $($.fn.Mediabox4.options.btnPrev, $this)
			}
			if($.fn.Mediabox4.options.btnNext)
			{
				var $btnNext = $($.fn.Mediabox4.options.btnNext, $this)
			}

			var $itens = $("li", $ul), $fItem = $("li:first", $ul), $lItem = $("li:last", $ul), lP = $lItem.css("margin-left");


			if(typeof(lP) != "undefined")
			{
				lP = Number(lP.replace("px", ""));
			} else {
				lP = 0;
			}


			var wdt = ($lItem.width()*$itens.length)+(lP*($itens.length-1));
			$ul.css("width", wdt+"px");

			var totalPages = Math.ceil(wdt / $mask.width());

			for(var i = 1; i<=totalPages; i++)
			{
				$pagers.append($.fn.Mediabox4.options.pagerItem);
			}
			var $pagerItens = $($.fn.Mediabox4.options.pagerTgt, $pagers);
			$pagerItens.click(function(e){
				if(e.preventDefault){e.preventDefault();}

				$pagerItens.removeClass($.fn.Mediabox4.options.pagerClass);
				$(this).addClass($.fn.Mediabox4.options.pagerClass);

				var i = $pagerItens.index($(this));

				pos = ($mask.width() * i)*(-1);
				if(pos <= maxX)
				{
					pos = maxX;
				}

				$.fn.Mediabox4.goSlid(pos, $ul, $this, maxX);
				return false;
			})
			$pagerItens[0].click();
			var maxX = ((wdt+30)-$mask.width())*(-1);
			if($btnNext)
			{
				$btnNext.click(function (){
					var pos = $ul.position();
					pos = pos.left;

					pos = pos - ($mask.width()+lP);
					if(pos <= maxX)
					{
						pos = maxX;
					}

					$.fn.Mediabox4.goSlid(pos, $ul, $this, maxX);

					return false;
				})
			}
			if($btnPrev)
			{
				$btnPrev.click(function (){
					var pos = $ul.position();
					pos = pos.left;

					pos = pos + ($mask.width()+lP);
					if(pos >= lP)
					{
						pos = 0;
					}

					$.fn.Mediabox4.goSlid(pos, $ul, $this, maxX);

					return false;
				})
				$btnPrev.click();
			}


		})
	}
}
Mediabox4(jQuery);
function Mediabox($)
{
	$.fn.Mediabox = function (options)
	{
		var defaults = {
			mediaShow: ".mediaShow",
			mediaList: ".mediaList",
			btnPrev: ".btnPrev",
			btnNext: ".btnNext",
			mask: ".mask",
		}
		$.fn.Mediabox.options = $.extend(defaults, options);
		$.fn.Mediabox.AdjustTimer = function ($timer, pos, $list)
		{
			var posSel = $("li.selected", $list).position();
			posSel = posSel.left;
			var m = (posSel == 0)? 0 : 10;
			posSel = pos + posSel + m;

			return posSel;
		}
		$.fn.Mediabox.AdjustSlider = function(pos, $timer, $list, $mediaList, maxX){

			var posSel = $.fn.Mediabox.AdjustTimer($timer, pos, $list);

			$timer.animate({left: posSel+"px"}, 500);
			$list.animate({left: pos+"px"}, 500);

			if(pos == 0){
				$mediaList.addClass("btnPrevHide");
			} else {
				$mediaList.removeClass("btnPrevHide");
			}
			if(pos == maxX){
				$mediaList.addClass("btnNextHide");
			} else {
				$mediaList.removeClass("btnNextHide");
			}


		}
		return this.each(function (){

			var $this = $(this), $mediaShow = $($.fn.Mediabox.options.mediaShow, $this), $mediaList = $($.fn.Mediabox.options.mediaList, $this), $btnPrev = $($.fn.Mediabox.options.btnPrev, $this), $btnNext = $($.fn.Mediabox.options.btnNext, $this), $mask = $($.fn.Mediabox.options.mask, $mediaList), $list = $("ul", $mask), $timer = $("<span class=\"timer\">&nbsp;</span>"), $showUl = $("ul", $mediaShow), intervalo;


			// List Slider
			var $itensLi = $("li", $list), $liLast = $("li:last", $list), $firstLi = $("li:first", $list), $links = $("li a", $list);

			var margin = $liLast.css("margin-left");
			margin = margin.replace("px", "");
			margin = Number(margin);

			var Wdt = ($itensLi.width() * $itensLi.length) + (margin * ($itensLi.length-1));
			$list.css("width", Wdt+"px");

			var maxX = (Wdt - $mask.width()) * (-1);

			$mask.append($timer);
			$firstLi.addClass("selected");

			$btnNext.click(function (){
				var pos = $list.position();
				pos = (pos.left - $mask.width());
				if(pos < maxX)
				{
					pos = maxX;
				}
				$.fn.Mediabox.AdjustSlider(pos, $timer, $list, $mediaList, maxX);


				return false;
			})
			$btnPrev.click(function (){
				var pos = $list.position();
				pos = (pos.left + $mask.width());
				if(pos > 0)
				{
					pos = 0;
				}

				$.fn.Mediabox.AdjustSlider(pos, $timer, $list, $mediaList, maxX);
				return false;
			})
			// MediaShow
			var $itens = $("li", $showUl);
			$("li:first", $showUl).clone().appendTo($showUl);

			var wdtShow = ($itens.width()*($itens.length+1));
			$showUl.css("width", wdtShow+"px");

			// Links
			$links.each(function (){
				$(this).click(function(){
					$(this).parents("ul").children(".selected").removeClass("selected");
					$(this).parent().addClass("selected");
					$timer.stop().css("width", "0px");

					var pos = $list.position();
					pos = pos.left;

					var ePos = $(this).parent().position();
					ePos = ePos.left;
					var vStart = (pos);

					//console.log((vStart+($mask.width()-7))+" "+ePos);
					if((vStart+($mask.width()-6)) <= ePos)
					{
						$btnNext.click();
					} else if((vStart+($mask.width()-6)) > ePos && ePos == 0) {
						$.fn.Mediabox.AdjustSlider(0, $timer, $list, $mediaList, maxX);
					}

					var tPos = $.fn.Mediabox.AdjustTimer($timer, pos, $list);
					$timer.css("left", tPos+"px");
					var tWidth = $(this).parent().width();
					$timer.animate({"width": tWidth+"px"}, 5000, function (){
						$next = $("li.selected", $list).next("li");
						if($next[0]){
							$next = $next.children("a").click();
						} else {
							var pos = ($itens.width()*$links.length)*(-1);
							$showUl.animate({left: pos+"px"}, 500, function (){
								$showUl.css("left", "0px");
								$("li:first a", $list).click();
							});

						}

					});

					var i = $links.index($(this));
					var pos = ($itens.width()*i)*(-1);
					$showUl.animate({left: pos+"px"}, 500);

					return false;
				})
			});
			$("li:first a", $list).click();

		})
	}
}
Mediabox(jQuery);

function Slider($)
{
	$.fn.Slider  = function (options)
	{
		var defaults = {
			mask: ".mask",
			list: "ul",
			btnPrev: null,
			btnNext: null,
			pagers: ".nav-corta-pra-mim ul",
			pagerItem: "<li><span class=\"\"></span></li>",
			pagerClass: "cycle-pager-active",
			pagerTgt: "span",
		}
		$.fn.Slider.goSlid = function (pos, $ul, $this, maxX){
			$ul.animate({"left": pos}, 500);
			if(pos == maxX)
			{
				$this.addClass("BtnNextHide");
			} else {
				$this.removeClass("BtnNextHide");
			}
			if(pos == 0)
			{
				$this.addClass("BtnPrevHide");
			} else {
				$this.removeClass("BtnPrevHide");
			}
		}
		$.fn.Slider.options = $.extend(defaults, options);
		return this.each(function (){
			var $this = $(this), $mask = $($.fn.Slider.options.mask, $this), $ul = $($.fn.Slider.options.list, $mask), $pagers = $($.fn.Slider.options.pagers, $this);
			$pagers.html("");

			if($.fn.Slider.options.btnPrev != null)
			{
				var $btnPrev = $($.fn.Slider.options.btnPrev, $this)
			}
			if($.fn.Slider.options.btnNext)
			{
				var $btnNext = $($.fn.Slider.options.btnNext, $this)
			}

			var $itens = $("li", $ul), $fItem = $("li:first", $ul), $lItem = $("li:last", $ul), lP = $lItem.css("margin-left");


			if(typeof(lP) != "undefined")
			{
				lP = Number(lP.replace("px", ""));
			} else {
				lP = 0;
			}


			var wdt = ($lItem.width()*$itens.length)+(lP*($itens.length-1));
			$ul.css("width", wdt+"px");

			var totalPages = Math.ceil(wdt / $mask.width());

			for(var i = 1; i<=totalPages; i++)
			{
				$pagers.append($.fn.Slider.options.pagerItem);
			}
			var $pagerItens = $($.fn.Slider.options.pagerTgt, $pagers);
			$pagerItens.click(function(e){
				if(e.preventDefault){e.preventDefault();}

				$pagerItens.removeClass($.fn.Slider.options.pagerClass);
				$(this).addClass($.fn.Slider.options.pagerClass);

				var i = $pagerItens.index($(this));

				pos = ($mask.width() * i)*(-1);
				if(pos <= maxX)
				{
					pos = maxX;
				}

				$.fn.Slider.goSlid(pos, $ul, $this, maxX);
				return false;
			})
			$pagerItens[0].click();
			var maxX = ((wdt+30)-$mask.width())*(-1);
			if($btnNext)
			{
				$btnNext.click(function (){
					var pos = $ul.position();
					pos = pos.left;

					pos = pos - ($mask.width()+lP);
					if(pos <= maxX)
					{
						pos = maxX;
					}

					$.fn.Slider.goSlid(pos, $ul, $this, maxX);

					return false;
				})
			}
			if($btnPrev)
			{
				$btnPrev.click(function (){
					var pos = $ul.position();
					pos = pos.left;

					pos = pos + ($mask.width()+lP);
					if(pos >= lP)
					{
						pos = 0;
					}

					$.fn.Slider.goSlid(pos, $ul, $this, maxX);

					return false;
				})
				$btnPrev.click();
			}


		})
	}
}
Slider(jQuery)

function loadTiny(c){var b,e,a=[],d=window;c.fn.tinymce=function(j){var p=this,g,k,h,m,i,l="",n="";if(!p.length){return p}if(!j){return tinyMCE.get(p[0].id)}p.css("visibility","hidden");function o(){var r=[],q=0;if(f){f();f=null}p.each(function(t,u){var s,w=u.id,v=j.oninit;if(!w){u.id=w=tinymce.DOM.uniqueId()}s=new tinymce.Editor(w,j);r.push(s);s.onInit.add(function(){var x,y=v;p.css("visibility","");if(v){if(++q==r.length){if(tinymce.is(y,"string")){x=(y.indexOf(".")===-1)?null:tinymce.resolve(y.replace(/\.\w+$/,""));y=tinymce.resolve(y)}y.apply(x||tinymce,r)}}})});c.each(r,function(t,s){s.render()})}if(!d.tinymce&&!e&&(g=j.script_url)){e=1;h=g.substring(0,g.lastIndexOf("/"));if(/_(src|dev)\.js/g.test(g)){n="_src"}m=g.lastIndexOf("?");if(m!=-1){l=g.substring(m+1)}d.tinyMCEPreInit=d.tinyMCEPreInit||{base:h,suffix:n,query:l};if(g.indexOf("gzip")!=-1){i=j.language||"en";g=g+(/\?/.test(g)?"&":"?")+"js=true&core=true&suffix="+escape(n)+"&themes="+escape(j.theme)+"&plugins="+escape(j.plugins)+"&languages="+i;if(!d.tinyMCE_GZ){tinyMCE_GZ={start:function(){tinymce.suffix=n;function q(r){tinymce.ScriptLoader.markDone(tinyMCE.baseURI.toAbsolute(r))}q("langs/"+i+".js");q("themes/"+j.theme+"/editor_template"+n+".js");q("themes/"+j.theme+"/langs/"+i+".js");c.each(j.plugins.split(","),function(s,r){if(r){q("plugins/"+r+"/editor_plugin"+n+".js");q("plugins/"+r+"/langs/"+i+".js")}})},end:function(){}}}}c.ajax({type:"GET",url:g,dataType:"script",cache:true,success:function(){tinymce.dom.Event.domLoaded=1;e=2;if(j.script_loaded){j.script_loaded()}o();c.each(a,function(q,r){r()})}})}else{if(e===1){a.push(o)}else{o()}}return p};c.extend(c.expr[":"],{tinymce:function(g){return !!(g.id&&"tinyMCE" in window&&tinyMCE.get(g.id))}});function f(){function i(l){if(l==="remove"){this.each(function(n,o){var m=h(o);if(m){m.remove()}})}this.find("span.mceEditor,div.mceEditor").each(function(n,o){var m=tinyMCE.get(o.id.replace(/_parent$/,""));if(m){m.remove()}})}function k(n){var m=this,l;if(n!==b){i.call(m);m.each(function(p,q){var o;if(o=tinyMCE.get(q.id)){o.setContent(n)}})}else{if(m.length>0){if(l=tinyMCE.get(m[0].id)){return l.getContent()}}}}function h(m){var l=null;(m)&&(m.id)&&(d.tinymce)&&(l=tinyMCE.get(m.id));return l}function g(l){return !!((l)&&(l.length)&&(d.tinymce)&&(l.is(":tinymce")))}var j={};c.each(["text","html","val"],function(n,l){var o=j[l]=c.fn[l],m=(l==="text");c.fn[l]=function(s){var p=this;if(!g(p)){return o.apply(p,arguments)}if(s!==b){k.call(p.filter(":tinymce"),s);o.apply(p.not(":tinymce"),arguments);return p}else{var r="";var q=arguments;(m?p:p.eq(0)).each(function(u,v){var t=h(v);r+=t?(m?t.getContent().replace(/<(?:"[^"]*"|'[^']*'|[^'">])*>/g,""):t.getContent({save:true})):o.apply(c(v),q)});return r}}});c.each(["append","prepend"],function(n,m){var o=j[m]=c.fn[m],l=(m==="prepend");c.fn[m]=function(q){var p=this;if(!g(p)){return o.apply(p,arguments)}if(q!==b){p.filter(":tinymce").each(function(s,t){var r=h(t);r&&r.setContent(l?q+r.getContent():r.getContent()+q)});o.apply(p.not(":tinymce"),arguments);return p}}});c.each(["remove","replaceWith","replaceAll","empty"],function(m,l){var n=j[l]=c.fn[l];c.fn[l]=function(){i.call(this,l);return n.apply(this,arguments)}});j.attr=c.fn.attr;c.fn.attr=function(o,q){var m=this,n=arguments;if((!o)||(o!=="value")||(!g(m))){if(q!==b){return j.attr.apply(m,n)}else{return j.attr.apply(m,n)}}if(q!==b){k.call(m.filter(":tinymce"),q);j.attr.apply(m.not(":tinymce"),n);return m}else{var p=m[0],l=h(p);return l?l.getContent({save:true}):j.attr.apply(c(p),n)}}}}
loadTiny(jQuery);


$(document).ready(function(){

	$(".slider").Slider();
	$("#banner-principal").Mediabox({
			mediaShow: ".mediaShow",
			mediaList: ".mediaList",
			btnPrev: ".btnPrev",
			btnNext: ".btnNext",
			mask: ".mask",
		});
	if($(".banner-interna")[0])
	{
		$(".banner-interna").Mediabox3({
				mask: ".maskbanner",
				btnPrev: ".prev",
				btnNext: ".next",
				list: ".lista-banner",
				listItem: '.banner-item'
		})
	}
	if($(".banner-entrevista")[0])
	{
		$(".banner-entrevista").Mediabox2({
				mask: ".maskent",
				btnPrev: ".btnPrevent",
				btnNext: ".btnNextent",
				list: ".lista-entrevista",
				listItem: '.box-entrevista'
		})
	}
/*	if($(".pintar-desenhos")[0])
	{
		$(".pintar-desenhos").Mediabox4({
				mask: ".maskdes",
				btnPrev: ".btnPrevdes",
				btnNext: ".btnNextdes",
				list: ".lista-desenhos",
				listItem: '.desenho-item'
		})
	}*/
	$('textarea.tinymce').tinymce({
		language : "pt",
		// Location of TinyMCE script
		script_url : '/marcelo-rezende/web/js/tiny_mce/tiny_mce.js',
		document_base_url: "/",
		relative_urls: false,
		theme : "advanced",
		skin : "wp_theme",
		plugins : "autolink,lists,advlink,contextmenu,fullscreen,advlist,media,paste,pagebreak",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,
	})


	$("a.hideShowDiv").click(function(e){
		if(e.preventDefault){e.preventDefault();}

		var t = $(this).attr('href');
		var $target = $(t);
		var $parent = $target.parent();

		$parent.children("div").hide();
		$target.show();

		return false;
	})
	$("a.hideShowDiv:first").click();

	var pag = document.location;

	var reg1 = new RegExp("(\/(noticia|foto)\/)");
	if(!reg1.exec(pag))
	{
		var lista = $("#menu a");
		lista.each(function(){

			var ref = String($(this).attr("href"));
			var reg = new RegExp(ref.replace("/", "\/"));
			if(reg.exec(pag)){
				lista.removeClass("hover");
				$(this).addClass("hover");
			}

		});
	} else {
		var cat = $('body').attr('class');
		var lista = $("#menu a");
		lista.each(function(){
			var text = Slugfy(String($(this).html()));
			if(text == "cidade-alerta-extras"){
				text = "cidade-alerta";
			}

			if(cat == text)
			{
				lista.removeClass("hover");
				$(this).addClass("hover");
			}

		});
	}


	$('li.twitter-mini a').each(function (){
		$(this).click(function(){
			var title = $('title').html();
			var url  = "https://twitter.com/intent/tweet?via=cidadealerta&url="+encodeURI(document.location)+"?s=t&text="+encodeURI(title);
			window.open(url, "", "width=300,heigth=150,scrollbars=no,status=no,toolbar=no");
			return false;
		})
	});
	$('li.google-mini a').each(function  (){$(this).click(function(){
		var url  = "https://plus.google.com/share?url="+encodeURI(document.location);

		window.open(url, "", "width=300,heigth=150,scrollbars=no,status=no,toolbar=no");
		return false;

		})
	});
	$('li.facebook-mini a').each(function (){
		$(this).click(function(){
			var title = $('title').html();
			var url  = "http://www.facebook.com/sharer/sharer.php?s=100&p%5Btitle%5D="+encodeURI(title)+"&p%5Burl%5D="+encodeURI(document.location);
			window.open(url, "", "width=300,heigth=150,scrollbars=no,status=no,toolbar=no");
			return false;
		})
	});
	$('.redes-box-forum a').each(function (){
		$(this).click(function(){
			var title = $('title').html();
			var url  = "http://www.facebook.com/sharer/sharer.php?s=100&p%5Btitle%5D="+encodeURI(title)+"&p%5Burl%5D="+encodeURI(document.location);
			window.open(url, "", "width=300,heigth=150,scrollbars=no,status=no,toolbar=no");
			return false;
		})
	});



	// Like / Unlike




	$(".avaliacao-topico a, .posicionamento-coment-forum a").each(function(){
		$(this).click(function (e){
			if(e.preventDefault){e.preventDefault();}
			var url = $(this).attr('href');
			var $this = $(this);
			var target = $this.attr("data-target");

			var cookie =  $(this).attr('rel');

			if(!CookieCreate.read(cookie)){
					$.getJSON(url, function (data){
							if(data.status == "SUCCESS")
							{
								var not = (data.nota);
								$(target).html(not);
								CookieCreate.create(cookie, 1, 1);
							}
					});
			}
			return false;
		});
	});
	// Like / Unlike comment






});
