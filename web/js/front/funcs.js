$(document).ready(function(){
  $(".mediaRotate").each(function (){
      var $this = $(this), $links = $("a", $this), $lis = $("li", $this);
      var targetId = $this.attr("data-target");
      var $target = $(targetId);

      $links.each(function (){
        $(this).click(function (e){
          if(e.preventDefault) { e.preventDefault(); }
          var img = $(this).attr("data-image");
          var $link = $(this);
          var $parent = $(this).parent();
          $lis.removeClass("active");
          $parent.addClass("active");
          
          $target.animate({
            opacity: 0
          }, 500, function(){
            $target.css({"background-image": "url("+img+")"});
            $target.animate({
              opacity: 1
            }, 500, function (){
              $lis.removeClass("active");
              $parent.addClass("active");
            });
          })
          return false;
        })
      })



  })
})
