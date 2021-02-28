function pagerDoido(err, data, $element, $target){
  if(err){ return ; }
  var href = $element.attr("href");
  if(/page=([0-9]+)/i.exec(href)){
    var index = parseInt(/page=([0-9]+)/i.exec(href)[1]);
    href = href.replace(/page=([0-9]+)/i, "page="+(index+1));
  } else {
    href += (/\?/i.exec(href))?"&page=1":"?page=1";
  }

  $target.append(data);

  $element.attr("href", href);

}
(function ($){

  $.fn.submitFriend = function (opts){
    var options = $.extend({
      action: "/sendFriend",
      method: "post"
    }, opts);
    return $(this).each(function (){
      $(this).click(function (e){
        if(e.preventDefault){ e.preventDefault(); }
        $.fn.submitFriend.render(options);
      })
    })
  }
  $.fn.submitFriend.render = function (options){
    var html = '<div class="overlay"></div>';
    html += '<div id="lightSend" class="lightBox">';
    html += '<div class="box2">';
    html += '<div class="boxclose"><a href="" class="close">X</a></div>';
    html += '<h2 class="txtCenter">Envie para um amigo</h2>';
    html += '<div id="SendFriendLight" class="nutritionTable">';
    html += '<form data-target="#SendFriendLight" class="ajaxed" action="'+options.action+'" method="'+options.method+'">';
    html += '<input type="text" name="name" placeholder="Seu nome: ">';
    html += '<input type="email" name="email" placeholder="Seu e-mail: ">';
    html += '<input type="text" name="name_to" placeholder="Nome do seu amigo: ">';
    html += '<input type="email" name="email_to" placeholder="E-mail do seu amigo: ">';
    html += '<input type="hidden" name="url" value="'+document.location+'">';
    html += '<textarea name="message" placeholder="Deixe sua mensagem: "></textarea>';
    html += '<input type="submit" value="Enviar">';
    html += '</form>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $("body").append(html);
    var $overlay = $(".overlay");
    var $lightSend = $("#lightSend");
    var $btClose = $(".close", $lightSend);


    var scroll = $(window).scrollTop();

    $lightSend.css({top: scroll+"px"});
    $btClose.click(function (e){
        if(e.preventDefault) { e.preventDefault(); }

        $lightSend.animate({opacity: 0}, 500, function (){
          $overlay.animate({opacity: 0}, 500, function (){
            $overlay.remove();
            $lightSend.remove();
          });
        })
    })

  }
})(jQuery);

(function ($){
  $.fn.subMenu = function (opts){
    var options = $.extend({
      formatter: $.fn.subMenu.renderHtml,
      btCloseClass: "close",
      btCloseFormat: $.fn.subMenu.btClose,
      menuClass: $.fn.subMenu.menuClass,
    }, opts);

    return $(this).each(function (){
      $(this).click(function (e){
        if(e.preventDefault){ e.preventDefault();}
        var data = $(this).next(".submenu")[0].outerHTML;
        var txtLink = $(this).attr("class");
        var html = $.fn.subMenu.renderHtml(options, data, txtLink);

        if($("#submenu")[0]){
          $("#submenu").remove();
        }
        $("body").append(html);
        var $submenu = $("#submenu");

        $(this)[0].jSubMenuOpts = options;

        $.fn.subMenu.addEvents(options);


        $submenu.css({"top": $.fn.subMenu.position()+"px"});

        return false;
      })
    })

  }
  $.fn.subMenu.position = function (){
    var $activeMenu = $("#primary-menu").hasClass("active")?$("#primary-menu"):$("#primary-menu-roll");
    var pos = ($(window).scrollTop() <= $("#primary-menu").height() || $(window).width() >= 670)?($(window).scrollTop()+$activeMenu.height()):($(window).scrollTop()+($("#primary-menu-roll").height()));
    pos = ($(window).width() <= 670 && pos < 70)?($(window).scrollTop()+($("#primary-menu-roll").height())):pos;
    return pos;
  }
  $.fn.subMenu.scrollTop = function (opts){

    if($(document).scrollTop() < $("#submenu").offset().top && $(window).width() > 670){
      var pos = $.fn.subMenu.position();
      $("#submenu").css({"top": pos+"px"})
    }
  }
  $.fn.subMenu.addEvents = function (opts){
    $("#submenu ."+opts.btCloseClass).off("click.submenu").on("click.submenu", function (e){
        if(e.preventDefault) { e.preventDefault(); }
        $("#submenu").remove();
        $(window).off("scroll.submenu");
        return false;
    })
    $(window).on("scroll.submenu", function (e){if($(window).width() > 670){$.fn.subMenu.scrollTop(opts)}});
  }
  $.fn.subMenu.menuClass = function (){
    return "sub-a-piracanjuba";
  }
  $.fn.subMenu.btClose = function(){
    return '<a href="" class="close">X</a>';
  }
  $.fn.subMenu.renderHtml = function (opts, data, cls){

    var html = '<div id="submenu" class="sub-'+cls+'">';
    html += opts.btCloseFormat();
    html += '<div class="alignContent">';
    // Content
    html += data;
    html += '</div>';
    html += '</div>';
    return html;
  }
})(jQuery);
(function ($){

  $.fn.AjaxedLight = function (opts){
    var options = $.extend({
      collectionTitleFn: function ($item, $colection){
          return "1955";
      },
      collectionClassFn: function ($item, $colection){
        return "dateBox d1955"
      },
      containerClassFn: function ($item, $colection){
        return "description"
      },
      collectionAttsFn: function ($item, $collection){
        return "";
      },
      titleHtmlFn: function (title, $currentItem, $colection){
        return '<h3>'+title+'</h3>';
      },
      closeBtnHtmlFn: function ($item, $colection){
        return '<a href="#" class="close"><i class="fa fa-times" aria-hidden="true"></i></a>';
      },

    }, opts);
    var $collection = $(this);
    return this.each(function (){
      var $this = $(this), href = $(this).attr("href");
      //console.log($this);
      $this.click(function (e){
        if( e.preventDefault) { e.preventDefault(); }
        $.fn.AjaxedLight.render(options, $collection, $(this))
        return false;
      })




    })
  }
  $.fn.AjaxedLight.centerData = function ($light){
    $light.css({
      "top": ($(window).scrollTop())+"px"
    });

  }
  $.fn.AjaxedLight.render = function (opts, collection, $currentItem){
    var index = collection.index($currentItem);

    if(index-1 >= 0){
      var $prevItem = collection.eq(index-1);
    }
    if(index+1 < collection.length){
      var $nextItem = collection.eq(index+1);
    }
    var html = "";
    if($(".overlay").length < 1){
      html += '<div class="overlay"></div>';
    }
    if(!$(".lightBox")[0]){
      html += '<div class="lightBox">';
      html += '<div '+opts.collectionAttsFn($currentItem, collection)+'  class="LightBoxContainer alignContent '+opts.collectionClassFn($currentItem, collection)+'">';
      html += opts.closeBtnHtmlFn($currentItem, collection);

      var btnPrevClass = ($prevItem)?"":"hidden";
      html += '<a href="" class="prev '+btnPrevClass+'"></a>';


      html += opts.titleHtmlFn(opts.collectionTitleFn($currentItem, collection), $currentItem, collection);
      html += '<div class="'+opts.containerClassFn($currentItem, collection)+'">';
      html += '<div class="preloader"><i class="fa fa-spinner"></i></div>'
      html += '</div>';

      var btnNextClass = ($nextItem)?"":"hidden";
      html += '<a href="" class="next '+btnNextClass+'"></a>';

      html += '</div>';
      html += '</div>';
      $("body").append(html);
    }
    var $light = $(".lightBox"),
    $overlay = $(".overlay"),
    $description = $(".description", $light),
    $close = $(".close", $light),
    $next = $(".next", $light),
    $prev = $(".prev", $light),
    $preloader = $(".preloader", $light);



    if(!$preloader[0]){
      var html = '<div class="preloader"><i class="fa fa-spinner"></i></div>';
      $preloader = $(".preloader", $light);
    }

    if($prevItem){
        $prev.removeClass("hidden");
    } else {
        $prev.addClass("hidden");
    }
    if($nextItem){
      $next.removeClass("hidden");
    } else {
        $next.addClass("hidden");
    }


    $.fn.AjaxedLight.centerData($light);

    $next.off("click.lightbox").on("click.lightbox", function (e){
      if(e.preventDefault) e.preventDefault(0)

      $nextItem.click();

      console.log("RODOU");

      return false;
    })
    $prev.off("click.lightbox").on("click.lightbox", function (e){
      if(e.preventDefault) e.preventDefault(0)

      $prevItem.click();

      return false;
    })


    $close.off("click.lightbox").on("click.lightbox", function(e){
      if(e.preventDefault) e.preventDefault(0)

      $light.remove();
      $overlay.remove();

      return false;
    })
    $.get({
      url: $currentItem.attr("href"),
    }).then(function (res){
      $description.html(res);
    }).fail(function (res){
      $description.html(Translator().translate("<p>ERROR_LOADING</p>"));
    })




  }
})(jQuery);
// Slider
(function($){
  $.fn.Slider = function (opts){
    var defaults = {
      prev: "a.prev",
      next: "a.next",
      mask: ".mask",
      list: "ul.item",
      itens: "li",
      images: "li img",
      hasPager: false,
      pagerTarget: ".recipePager .alignContent",
      pagerItem: "a",
      pagerCls: "active",
      pagerHtml: "<a href=\"#\"></a>",
      pagerItemFn: null
    };
    var options = $.extend(defaults, opts);

    return $(this).each(function (){
      var $this = $(this), $prev = $(options.prev, $this), $next = $(options.next, $this), $mask = $(options.mask, $this), $list = $(options.list, $this), $itens = $(options.itens, $this), $images = $(options.images, $this);

      if(options.hasPager){
        var $pager = $(options.pagerTarget, $this);
        var html = "";

        $itens.each(function (index, $item){
          if(options.pagerItemFn){
            $item = $(this);
            html += options.pagerItemFn($this, $item, index);
          } else {
            html += options.pagerHtml;
          }

        })
        //for(var i =0; i<$itens.length; i++){
        //  html += options.pagerHtml;
        //}

        $pager.html(html);

        var $pagerItens = $(options.pagerItem, $pager);

        $pagerItens.click(function (e){
          e.preventDefault();

          var index = $pagerItens.index($(this));

          var pos = ($mask.width() * (-1)) * index;
          $list.css({left: pos+"px"});

          $pagerItens.removeClass(options.pagerCls);
          $(this).addClass(options.pagerCls);

          return false;
        })
        $pagerItens.eq(0).click();

        $(window).resize(function (){calculateDimensions();


        })
      }


      var liDimensions, ulWidth, maxScroll, maskHeight = 0;
      function calculateDimensions(){
        liDimensions = $itens.outerWidth(true);
        ulWidth = $itens.length * liDimensions;
        maxScroll = ($mask.width() - ulWidth);


        $itens.each(function (){
          maskHeight = ($(this).outerHeight(true) > maskHeight)?$(this).outerHeight(true):maskHeight;
        })

        $list.css({"width": ulWidth+"px", "position": "absolute", "top": 0});
        $mask.css({"height": maskHeight+"px"});
      }
      function prevItem(){
        var currentPos = $list.position().left;
        var nextPos = currentPos + $mask.width();

        nextPos = (nextPos > 0)?0:nextPos;

        $list.css({left: nextPos+"px"});
      }
      function nextItem(){
        var currentPos = $list.position().left;
        var nextPos = currentPos - $mask.width();

        nextPos = (nextPos < maxScroll)?maxScroll:nextPos;

        $list.css({left: nextPos+"px"});
      }


      calculateDimensions();
      //

      /*
      $list.on("swipeleft", function(e){
        e.preventDefault();
        nextItem();
        return false;
      }).on("swiperight", function (e){
        e.preventDefault();
        prevItem();
        return false;
      })
      */

      $prev.click(function (e){
        e.preventDefault();

        prevItem();

        return false;
      })
      $next.click(function (e){
        e.preventDefault();

        nextItem();

        return false;
      })



    })
  }
})(jQuery);

// Tabs
(function($){
    $.fn.Tabs = function (opts){
      var defaults = {
        buttons: "nav a",
        tabs: ".tab",
        cls: ".active",
        onchange: null
      };
      var options = $.extend(defaults, opts);
      var $collection = $(this);
      return $(this).each(function (){
        var $this = $(this), $tabs = $(options.tabs, $this), $buttons = $(options.buttons, $this);

        var cls = options.cls.replace(".", "");
        // Buttons Events
        $buttons.click(function (e){

          e.preventDefault();

          $buttons.filter(options.cls).removeClass(cls);
          $(this).addClass(cls)


          var target = $(this).attr("href");

          $tabs.removeClass(cls);
          $(target, $this).addClass(cls);
          if(options.onchange){
            options.onchange($(this), $collection);
          }

          return false;
        })

        $buttons.eq(0).click();
      })
    }
})(jQuery);
// Accordion
(function ($){
  $.fn.Accordion = function (opts){
    var defaults = {
      closeClass: "close",
      target: "li > a",
      items: "li",
      closeOthers: true
    }
    var options = $.extend(defaults, opts);

    return $(this).each(function (){
      var $this = $(this), $links = $(options.target, $this), $items = $(options.items, $this);

      $links.click(function (e){

          e.preventDefault();
          if(options.closeOthers){ $items.addClass(options.closeClass); }

          $(this).parent().toggleClass(options.closeClass);

          return false;
      })
      $links.eq(0).click();
    })
  }
})(jQuery)

function Translator(){
  this.translates = {
    'PT': {
      "LOADING": "Carregando",
      "ERROR_LOADING": "Erro ao carregar"
    },
    'EN': {
      "LOADING": "Loading",
      "ERROR_LOADING": "Unable to load content"
    },
    'ES': {
      "LOADING": "Carregando",
      "ERROR_LOADING": "Error loading content"
    }
  };

  this.getCurrentLanguage = function (){
    var path = window.location.toString();
    if(/\/(en)\//i.exec(path)){
      return "EN";
    }
    if(/\/(es)\//i.exec(path)){
      return "ES";
    }
    return "PT";
  }
  this.translate = function(txt){
    var dictionary = this.translates[this.getCurrentLanguage()];

    for(var i in dictionary){
        var val = dictionary[i];
        txt = txt.replace(new RegExp(i, "ig"), val);
    }
    return txt;
  }
  return this;
}

$(document).ready(function(){
  if (!("ontouchstart" in document.documentElement)) {
    $("body").addClass("no-touch");
  }
  $("body").on("click", "a.disabled", function (e){
    if(e.preventDefault){e.preventDefault()}
  })

  $(".slider").Slider();
  $(".sliderPager:not(.timeline)").Slider({hasPager: true});
  $(".sliderPager.timeline").Slider({
    pagerTarget: ".pager",
    hasPager: true,
    pagerCls: "hover",
    pagerItemFn: function ($scope, $currentItem, index){
      var name = $(".boxOne h1 a", $currentItem).html();
      if(!name){
        name = $(".boxOne h1", $currentItem).html();
      }
      var html = '<a href="#" class="'+($currentItem.attr("class"))+' hover">'+name+'</a>'
      return html;
    }
  });



  $(".the-piracanjuba .tabs").Tabs({
    onchange: function (item, collection){
      var cls = "";
      switch(item.attr("href")){
        case "#tab1":
          cls = "missao"
        break;
        case "#tab2":
          cls = "visao"
        break;
        case "#tab3":
          cls = "valores"
        break;
      }
      collection.parent().attr("class", "boxMvv "+cls);
    }
  });
  $(".showImage.tabs").Tabs({
    cls: ".hover",
    onchange: function (item, collection){

    }
  });

  $(".accordion").Accordion();


  $("body").on("click", "a.ajaxed[data-target]", function (e){
    console.log("RODOU31");
    e.preventDefault();

    var $this = $(this);
    var target = $(this).attr("data-target");
    var href = $(this).attr("href");
    var $target = $(target);

    var callback = $(this).attr("data-posFunc");
    var call = null;
    if(typeof(window[callback]) == 'function'){
      call = window[callback];
    }


    //$target.html(Translator().translate("<p>LOADING</p>"));
    $.ajax({
      url: href+((/\?/i.exec(href))?"&ajaxed=true":"?ajaxed=true"),
      success: function (data){

        if(call){
          call(null, data, $this , $target);
        }else{
          $target.html(data);
        }
      },
      error: function (date){
        if(call){
          call(date, null, $this, $target);
        }else{
          $target.html(Translator().translate("<p>ERROR_LOADING</p>"));
        }
      }
    })

    return false;
  })
  $("body").on("submit", "form.ajaxed[data-target]", function (e){
    e.preventDefault();

    var target = $(this).attr("data-target");
    var action = $(this).attr("action");
    var method = $(this).attr("method").toUpperCase();
    var $target = $(target);
    $target.html(Translator().translate("<p>LOADING</p>"));
    var data = $(this).serialize();
    $.ajax({
      url: action+"?ajaxed=true",
      data: data,
      dataType: "html",
      method: method,
      success: function (data){
        $target.html(data);
      },
      error: function (date){
        $target.html(Translator().translate("<p>ERROR_LOADING</p>"));
      }
    })

    return false;
  })


  $(window).scroll(function () {

    if ($(this).scrollTop() > 150 || $("body").width() <= 768) {
        $('header#heading #primary-menu').removeClass("active");
        $('header#heading #primary-menu-roll').addClass("active");

    } else {
      $('header#heading #primary-menu').addClass("active");
      $('header#heading #primary-menu-roll').removeClass("active");
    }
  })
  $(window).scroll();

  $("li.mobileMenu a:not(#brandName)").click(function (e){
      if(e.preventDefault) { e.preventDefault(); }
      console.log("RODOU");
      $(this).parents("ul").toggleClass("open");

      return false;
  })
  $('header#heading #primary-menu-roll a:not(#brandName, .disabled)').off("click.mobile").on("click.mobile", function (e){
    if(!$(this).hasClass("responsiveToggle") && $(this).parents("ul").hasClass("open") && $(this).parents("li").hasClass("submenu")){
        $(this).parents("ul").toggleClass("open");
        if(e.preventDefault) { e.preventDefault(); }
        return false;
    }

  })







  // AjaxedLight
  $(".timeline.sliderPager li").each(function (){
    var $title = $(".boxOne h1", $(this)).text()
    var color = $(".boxOne h1", $(this)).parent().css("background-color")

    var cls = $(this).attr("class");

    $(".ajaxedLightbox", $(this)).AjaxedLight({
      collectionTitleFn: function ($item, $colection){
        return $title;
      },
      collectionAttsFn: function ($item, $collection){
        return 'style="background-color: '+color+'"';
      },
      collectionClassFn: function ($item, $colection){
        $()
        return "dateBox "+cls
      }
    })
  })

  // Info
  $(".infoNutri").AjaxedLight({
    collectionTitleFn: function ($item, $colection){
      return "Informa&ccedil;&otilde;es Nutricionais";
    },
    collectionClassFn: function ($item, $colection){
      return "box"
    },
    closeBtnHtmlFn: function ($item, $colection){
      return '<div class="boxclose"><a href="" class="close">X</a></div>';
    },
    titleHtmlFn: function (title, $currentItem, $colection){
      return '<h2 class="txtCenter">'+title+'</h2>';
    }
  })

  // submenu

  $(window).resize(function (){
    if ($(this).scrollTop() > 150 || $("body").width() <= 768) {
        $('header#heading #primary-menu').removeClass("active");
        $('header#heading #primary-menu-roll').addClass("active");

    } else {
      $('header#heading #primary-menu').addClass("active");
      $('header#heading #primary-menu-roll').removeClass("active");
    }


    $(".cyclePager").each(function (){
      var target = $(this).attr("data-target");
      var $this = $(this);
      var id = $(this).attr("id");
      $(target).cycle("destroy").cycle({
                fx:'fade',
                activePagerClass: "active",
                speed:500,
                timeout:5000,
                width: 'fit',
                height: 'fit',
                containerResize: 0,
                fit: 1,
                pager: $this,
                timeoutFn: function(currElement, nextElement, opts, isForward) {
                  var time = $(currElement).attr('data-duration');
                  if(!time){
                    time = 5000;
                  }
                  return parseInt(time, 10);
                }
      });
    })
  })
  $(window).resize();


  $("#primary-menu li.submenu, #primary-menu-roll li.submenu").each(function (){
    $(this).children("a").subMenu();
  })
  if($(".skroll-content")[0]){

    var s = skrollr.init({
      smoothScrolling: true,
      forceHeight: false,
      render: function (data){
        if(data.curTop >= 150){
          $('header#heading #primary-menu').removeClass("active");
          $('header#heading #primary-menu-roll').addClass("active");
          $("#insideHeader").hide();
        } else {
          $("#insideHeader").show();
        }
      }
    })

    $(".skroll-content .skrollrCont a, .skroll-content a.skrollrCont").each(function (){
      $(this).off("click.skorl").on("click.skorl", function (e){
          if(e.preventDefault){ e.preventDefault(); }

          var target = $(this).attr("href");
          if($(target)[0]){

            var top = $(target).offset().top;
            s.animateTo(top);
          }

          return false;
      })
    })
  }

  $("body").on("change", ".lblSel select", function (e){
      var val = $(this).val();

      if($("option[value='"+val+"']")[0]){
        var opt = $("option[value='"+val+"']", $(this)).html();
        $(this).parent("label").attr("title", opt).toggleClass("updateBeforeTitle");
      }
  })
  $("body").on("change", ".lblSel input", function (e){
      var val = $(this).val();
      console.log(val);
      //if($("option[value='"+val+"']")[0]){
        //var opt = $("option[value='"+val+"']", $(this)).html();
        $(this).parent("label").attr("title", val).toggleClass("updateBeforeTitle");
      //}
  })

  $(".lblSel select").change();
  $("input[name='cpf']").mask('000.000.000-00', {reverse: true});
  $("input[name='cellphone']").mask('(00) 00000-0000');
  $("input[name='phone']").mask('(00) 0000-0000');
  $("input[name='zipcode']").mask('00000-000');
  $("input[name='birth']").mask('00/00/0000');
  $("input[name='data_fabricacao']").mask('00/00/0000');
  $("input[name='data_validade']").mask('00/00/0000');



  if(document.location.hash){
    $('a[href="'+document.location.hash+'"]').click();
  }

  $(".openClose").click(function (e){
      if(e.preventDefault){e.preventDefault();}
      $(this).parents("li").toggleClass("open");
      return false;
  });
  //  open close
  $(".buttonMore").click(function(){
      var par = $(this).parent(".releaseMore");
      par.toggleClass("close");

      return false;
  });

  $(".bar li>a").off("click").click(function (){
    if($(this).hasClass("active")){
      return $(this).toggleClass("active");
    }
    $(this).parents("ul").find("a.active").removeClass("active");
    $(this).toggleClass("active");

    return false;
  })
  /*
  $(".share, .pt, .es, .en, .search").off("click").click(function(){
      if($(this).hasClass("active")){
        return $(this).toggleClass("active");
      }
      $(this).parents("ul").find("a.active").removeClass("active");
      $(this).toggleClass("active");

      return false;
  });
  */
  $(".subSelect").change(function (){
			$(this).parents("form").submit();
	})

	$(window).resize(function(){
	var isMobile = $(window).width() < 1030;
	$(".imageChanger[data-mobile]").each(function (){
		var mobileSrc = $(this).attr("data-mobile");
		var desktopSrc = $(this).attr("data-desktop");
	
		var value = (isMobile)?mobileSrc:desktopSrc+"?1";
	
		$(this).css("background-image", "url('"+value+"')");
	})
	})
	$(window).resize();
  //<!--  LightBox -->

  $(".emailto").submitFriend();

  $(".save").click(function (){
    var href = $(this).attr("href");
    window.open(href);
    return false;
  })
  $(".submenu table tr").each(function (){
    if($("td", $(this)).length < 1){
      $(this).remove();
    }
  })
})
