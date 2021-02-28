<!--  Receitas -->
<section id="insideContent">
    <div class="alignContent">
        <div class="releaseSearch">
            <form action="<?php echo($this->site->PDT_URL); ?>a-piracanjuba/representantes#insideContent" method="get">
                <input name="releaseSearch" type="text" placeholder="Buscar em Representante" />
                <button type="submit"></button>
                <label for="ufs" title="Estado: " class="lblSel">
                    <select id="uf" class="selectchange " name="uf">
                      <?php $this->values = array("area" => (!empty($this->state))?$this->state->nome:"Brasil"); ?>
                        <option value="">{Estado}: </option>
                        <?php foreach($this->ufs as $key => $label) { ?>
                        <option <?php $this->formValues($this->values, "area", "option", $label); ?> value="<?php echo($key); ?>"><?php echo(($label)); ?></option>
                        <?php } ?>
                    </select>
                </label>
            </form>
        </div>
    </div>
    <div class="greyBgcolor">
        <div class="alignContent">
            <div class="cityList">
                <h3><?php echo((!empty($this->state))?$this->state->nome:"Brasil"); ?></h3>
                <ul>
                  <?php if(!empty($this->releases[0])){ ?>
                  <?php foreach($this->releases as $release){
                    $st = $release->getEstado();
                    $state = "";
                    if(!empty($st)){
                      $state = $st->sigla;
                    }
                     ?>
                    <li>
                        <p><b><?php echo($release->getCNTTIT()); ?> - <?php echo($state); ?></b></p>
                        <p><?php echo("<span class=\"rep-prop\">{Cidade}:</span>" . $release->getCNTRDT()); ?></p>
                        <a href="" class="arrow-right openClose"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        <div class="fullText">
                          <p>
							<?php $rep = $release->getCNTOLH(); if(!empty($rep)){ ?>
                            <?php echo("<span class=\"rep-prop\">{Representante}:</span>" .$rep); ?><br />
							<?php } ?>
                            <?php echo("<span class=\"rep-prop\">{E-mail}:</span>" . $release->getCNTRES()); ?><br />
                            <?php echo("<span class=\"rep-prop\">{Endereco}:</span>" .$release->getCNTEMB()); ?><br />
                          </p>
                          <?php echo(html_entity_decode($release->getCNTTXT())); ?>
                        </div>
                    </li>
                  <?php } ?>
                  <?php } else { ?>
                    <p>{Nothing Found}</p>
                  <?php } ?>
                </ul>
            </div>
            <div class="map">
                <figure id="mapData"></figure>
            </div>
            <script>
              function SVGMap(url, $element){
                var mapData;
                var mapUrl;
                var $this = this;
                var $el = $element;
                var states = {
                  active: {
                    stroke: "#FFF",
                    back: "#885a14"
                  },
                  normal: {
                    stroke: "#fff",
                    back: "#da9021"
                  }
                }

                var load;

                var events = {};
                var obj;



                this.setUrl = function (url){
                  mapUrl = url;
                }
                this.loadMap = function (){
                  load = new Promise(function (ful, rej){
                    $.ajax({
                        url: url,
                        dataType: "html",
                        success: function (data){
                          mapData = data;
                          return ful(true);
                        },
                        error: function (err){
                          return rej(err);
                        }
                      }
                    )
                  })
                  return load;
                }
                this.renderMap = function (){

                  if(mapData){
                    $element.html(mapData);
                    $this.callObservers("MAP_RENDERED");
                  } else {
                    $this.loadMap().then(function (){

                      $this.renderMap($element);
                    });
                  }

                }
                this.getElement = function(selector){
                  return $(selector, $el)
                }
                this.paintAreas = function (){
                  var st = states;
                  load.then(function (){
                    $this.getElement("path").each(function (){
                      var $area = $(this);
                      $this.changeAreaColor($area, st.normal);
                    })
                  })
                }
                this.selectArea = function (area){
                    var st = states;
                    load.then(function (){
                      $this.getElement("path").each(function (){
                        var $area = $(this);
                        $this.changeAreaColor($area, st.normal);
                      })
                      var $area = (typeof(area) != "string")? area : $this.getElement(area);
                      $area.each(function(){
                        var $ar = $(this);
                        $this.changeAreaColor($ar, st.active);
                      });
                    })

                }
                this.changeAreaColor = function ($area, state){

                  return load.then(function (){
                    $area.attr("style", "fill:"+state.back+";stroke:"+state.stroke+"")
                  })
                }
                this.setEvents = function (area, event, fn){
                  return area[event](fn);
                }

                this.changeDefaultsColors = function (colors){
                  states = colors;
                  $this.callObservers("COLORS_CHANGED", null);
                }

                this.addObserver = function (eventName, cb){
                  if(!events[eventName]){
                    events[eventName] = [];
                  }
                  events[eventName].push(cb);
                }
                this.removeObserver = function (eventName, cb){
                  if(events[eventName]){
                    events[eventName].filter(function (evt){
                      return evt != cb;
                    })
                  }
                }
                this.callObservers = function (evt, context){
                  if(events[evt]){
                    events[evt].map(function (fn){
                      fn(context);
                    })
                  }
                }

                this.initEvents = function (){
                  this.addObserver("MAP_RENDERED", function(){
                    this.paintAreas();
                    $this.getElement("path").each(function(){
                      $(this).css({cursor: "pointer"})
                      $(this).click(function (){
                        $this.callObservers("AREA_SELECTED", $(this));
                      })
                    })
                  })
                  this.addObserver("AREA_SELECTED", function ($area){
                    $this.callObservers("AREA_NAME_SELECTED", $area.attr("id"));
                    $this.selectArea($area);
                  })
                  this.addObserver("COLORS_CHANGED", function (){
                    $this.paintAreas();

                  })
                }
                this.initEvents();

                this.loadMap().then(function (){
                  this.renderMap();
                });

                obj = {
                        renderMap: renderMap,
                        setUrl: setUrl,
                        loadMap: loadMap,
                        addObserver: addObserver,
                        removeObserver: removeObserver,
                        changeDefaultsColors: changeDefaultsColors,
                        selectArea: selectArea
                }
                return obj;


              }
              $(document).ready(function (){
                var svg = SVGMap("/web/images/mapa.svg", $("#mapData"));
                <?php if(!empty($_GET['uf'])){?>
                svg.addObserver("MAP_RENDERED", function (){
                  svg.selectArea("#<?php echo($_GET['uf']); ?>");
                });
                <?php } ?>
                svg.addObserver("AREA_NAME_SELECTED", function(name){
                  $("#uf").val(name).parents("form").submit();

                })
                //svg.selectArea("#DF")
                //svg.renderMap();
              })

            </script>
            <?php
            if(!empty($this->img[0])){
              $dtq = $this->img[0];
              $fto = $dtq->getDTQFTO();
                if($fto){
                  $file = $fto->getFile();
                }
                if(!empty($file)){ ?>
                    <div class="image" style="background-image: url('<?php echo($file->getPath2()); ?>');"></div>
                <?php }
               } ?>
        </div>
    </div>
</section>
<script>
$(document).ready(function (){
  $("#uf").on("change.rep", function(e){
    $(this).parents("form").submit();
  })
})

</script>
<style>
.representantive .image {
  width: 46%;
}
@media (max-width: 768px) {
  .representantive .image {
    display: none;
  }
}
</style>
