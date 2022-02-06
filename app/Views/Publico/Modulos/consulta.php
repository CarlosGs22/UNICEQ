<?php

$caraCubo = array("cara1.png", "cara1.png", "cara2.png", "cara3.png", "cara4.png", "cara5.png", "cara6.png");
function progreso($progreso)
{
  $color = "";
  if ($progreso != null) {
    if ($progreso <= 11) {
      $color = "fondo6.png";
    } else if ($progreso > 11 && $progreso <= 31) {
      $color = "fondo5.png";
    } else if ($progreso > 31 && $progreso <= 51) {
      $color = "fondo4.png";
    } else if ($progreso > 51 && $progreso <= 71) {
      $color = "fondo2.png";
    } else if ($progreso > 71 && $progreso <= 91) {
      $color = "fondo3.png";
    } else if ($progreso > 91) {
      $color = "fondo1.png";
    }
  } else {
    $color = "fondo6.png";
  }

  return $color;
}


$totalCaras=0;
foreach ($listas as $lista => $value) {
  $totalCaras += 1;;
}

?>
<div class="row" style="width:75%;">
  <div class="col-md-12">
    <?php
    if ($totalCaras !== 6) { ?>
      <div class="row" style="margin: 5%;" id="panelCarasTotales">

        <?php foreach ($listas as $lista => $value) {
          $words = explode(" ", $value->area);
          $promedio = ($value->metas_cum / $value->metas_por) * 100;

          $acronym = "";
          foreach ($words as $w) {
            $acronym .= $w[0];
          }
          ?>

          <div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 15px; cursor:pointer;">

            <div class="card side caraCubo" id="<?php echo $value->idarea; ?>" style="background-image: url('<?php echo base_url("public/Publico/img/" . progreso($promedio) . "") ?>'); background-repeat: no-repeat;background-size: cover;background-position: center;">
              <img src="<?php echo base_url("public/Publico/img/" . $caraCubo[$value->idarea] . "") ?>" style="margin-top:12px; filter: invert(10%) sepia(0%) saturate(0%) hue-rotate(152deg) brightness(1000%) contrast(103%);">
            </div>
          </div>
        <?php } ?>

      </div>
    <?php } ?>

    <?php if ($totalCaras == 6) { ?>
      <div id="wrapper">
        <div class="viewport">
          <div class="cube">
            <?php

            foreach ($listas as $lista => $value) {
              $words = explode(" ", $value->area);
              $promedio = ($value->metas_cum / $value->metas_por) * 100;

              $acronym = "";
              foreach ($words as $w) {
                $acronym .= $w[0];
              }
              ?>
              <div class="side caraCubo" id="<?php echo $value->idarea; ?>" style=" background-image: url('<?php echo base_url("public/Publico/img/" . progreso($promedio) . "") ?>');">
                <div class="cube-image">
                  <img src="<?php echo base_url("public/Publico/img/" . $caraCubo[$value->idarea] . "") ?>" style="width:60%; margin-top:12px; filter: invert(10%) sepia(0%) saturate(0%) hue-rotate(152deg) brightness(1000%) contrast(103%);">
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="panelGen" id="panelGen">
      <div class="row justify-content-center" id="carasListas">
        <div class="panellistaCubo">
          <div class="col-md-4 subpanelLista text-center" style="align-self: center;">
            <img src="" class="img-fluid" id="imagenSubpanel">
          </div>

          <div class="col-md-4 subpanelLista text-center" style="align-self: center;">
            <h3>Detalle indicador</h3>
          </div>

          <div class="col-md-4 subpanelLista text-center" style="align-self: center;">
            <img src="<?php echo base_url("public/Publico/img/subImagenDetalle1.png") ?>" class="img-fluid" id="imgDetaIndi">
          </div>
        </div>
      </div>

      <div class="row justify-content-center">


      </div>

      <div class="row justify-content-center" id="carasDetalleListas">

      </div>
    </div>
  </div>
</div>

<div class="row" id="panelBotones">
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 justify-content-center align-self-center">
    <div class="botonesMenu margenRow">
      <button type="button" class="btn btn-circle btn-xl" id="btnCubopanel"><img src="<?php echo base_url("public/Publico/img/cuboPng.png") ?>" class="img-fluid" alt="Indicadores generales"></button>
      <button type="button" class="btn btn-circle btn-xl" id="btnCuboLupa" data-toggle="modal" data-target="#modalBuscar"><img src="<?php echo base_url("public/Publico/img/iconoLupa.png") ?>" class="img-fluid" alt="Buscar"></button>
      <button type="button" class="btn btn-circle btn-xl" id="btnIndiEstra" ><img src="<?php echo base_url("public/Publico/img/indiEstra.png") ?>" class="img-fluid" alt="Indicadores estratégicos"></button>
    </div>
  </div>

  <!--<div class="col-12 col-sm-12 col-md-6 col-lg-6">
  <div class="panelLogoConsulta margenRow">
  <img src="<?php echo base_url("public/Publico/img/logo_ch.png") ?>" class="img-fluid" id="imgPanelConsulta">
</div>
</div>-->
</div>

</div>

<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar indicador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-12">
            <div class="form-group">
              <label>Nombre: *</label>
              <input type="text" class="form-control" id="txtBuscar" placeholder="Ingresa código o nombre">
              <label>Ejemplo: "DS01 ó Servicio social"</label>
              <input type="hidden" id="txtIdIndicador">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group text-center">
              <label></label>
              <button id="btnBuscarIndicador" class="btn btn-primary">Buscar</button>
            </div>
          </div>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php


?>


<script>
var subfondos = [
  "subFondo1.png",
  "subFondo1.png",
  "subFondo2.png",
  "subFondo3.png",
  "subFondo4.png",
  "subFondo5.png",
  "subFondo6.png"
];





$(function() {

  $("#btnIndiEstra").click(function() {
    if($("#panelCarasTotales").is(":visible")){
      $("#panelCarasTotales").animate({
        opacity: 0
      }, 500, function() {
        $(this).hide();
      });
    }else{
      $("#wrapper").animate({
        opacity: 0
      }, 500, function() {
        $(this).hide();
      });
    }

    $("#imagenSubpanel").attr("src","");
    $("#imgDetaIndi").attr("src","<?php echo base_url("public/Publico/img/detaImgEstrategic.png") ?>");


    $(".panelGen").delay(800).fadeIn(500);
    $("#btnCubopanel").show();
    $("#btnCuboLupa").show();


    $.ajax({
      type: "GET",
      url: "<?= base_url() ?>/consultaDetalle",
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(data) {
        $("#carasDetalleListas > div").remove();
        for (var i = 0; i < data.length; i++) {
          var codigoIndicador = data[i].codigo;
          var indicador = data[i].indicador;
          var idIndicador = data[i].idindicador;
          var planeado = data[i].planeado;
          var realizado = data[i].realind;
          $color = "";

          var progreso = null;
          if (realizado > planeado) {
            progreso = 100;
          } else {
            if (realizado > 0 && planeado > 0) {
              progreso = (realizado / planeado) * 100;
            } else {
              progreso = 0;
            }
          }

          if (progreso != null) {
            if (progreso < 11) {
              color = "fondo6.png";
            } else if (progreso > 10 && progreso < 31) {
              color = "fondo5.png";
            } else if (progreso > 30 && progreso < 51) {
              color = "fondo4.png";
            } else if (progreso > 50 && progreso < 71) {
              color = "fondo2.png";
            } else if (progreso > 70 && progreso < 91) {
              color = "fondo3.png";
            } else if (progreso > 90) {
              color = "fondo1.png";
            }
          } else {
            color = "fondo6.png";
          }

          var base = "<?php echo base_url("public/Publico/img/") ?>" + "/" + color;
          $("#carasDetalleListas").append(
            '<div class="panellistaCubo listaDetalleCubo" id="' +
            idIndicador +
            '"> <div class ="col-md-3 subpanelLista text-center"><p class="textoDeta">Estado</p><div class = "iconoLista" style="background-image: url(' + "'" + base + "'" + ');"> </div> </div> <div class="col-md-2 subpanelLista2 text-left" style="padding:10px;"><p class="textoDeta">Código</p> ' +
            codigoIndicador +
            ' </div> <div class="col-md-7 subpanelLista" style="padding:10px;"><p class="textoDeta">Indicador</p><p> ' + indicador +
            '</p></div></div> '
          );
        }
      },
      error: function(request, status, error) {
        alert(request.responseText + " " + error);
      }
    });
  });



  $(".caraCubo").click(function() {

    $("#imgDetaIndi").attr("src","<?php echo base_url("public/Publico/img/subImagenDetalle1.png") ?>");

    $(this).closest("#panelCarasTotales").animate({
      opacity: 0
    }, 500, function() {
      $(this).hide(); // applies display: none; to the element .panel
    });

    $(this).closest("#wrapper").animate({
      opacity: 0
    }, 500, function() {
      $(this).hide(); // applies display: none; to the element .panel
    });

    $(".panelGen").delay(800).fadeIn(500);
    $(".panelGen").attr("id", "panelGen" + $(this).attr("id"));


    $("#txtIdIndicador").val($(this).attr("id"));
    $("#btnCuboLupa").show();
    $("#btnCubopanel").show();

    var idCara;
    idCara = "<?php echo base_url("public/Publico/img/") . "/" ?>" + subfondos[$(this).attr("id")];
    $("#imagenSubpanel").attr("src", idCara);

    $.ajax({
      type: "GET",
      url: "<?= base_url() ?>/consultaDetalle",
      data: {
        idarea: $(this).attr("id")
      },
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(data) {
        $("#carasDetalleListas > div").remove();
        for (var i = 0; i < data.length; i++) {
          var codigoIndicador = data[i].codigo;
          var indicador = data[i].indicador;
          var idIndicador = data[i].idindicador;
          var planeado = data[i].planeado;
          var realizado = data[i].realind;
          $color = "";

          var progreso = null;
          if (Number(realizado) >= Number(planeado)) {
            progreso = 100;
          } else {
            /*if (realizado > 0 && planeado > 0) {
              progreso = (realizado / planeado) * 100;
            } else {
              progreso = 0;
            }*/

            progreso = 0;
          }

          if (progreso != null) {
            if (progreso < 11) {
              color = "fondo6.png";
            } else if (progreso > 10 && progreso < 31) {
              color = "fondo5.png";
            } else if (progreso > 30 && progreso < 51) {
              color = "fondo4.png";
            } else if (progreso > 50 && progreso < 71) {
              color = "fondo2.png";
            } else if (progreso > 70 && progreso < 91) {
              color = "fondo3.png";
            } else if (progreso > 90) {
              color = "fondo1.png";
            }
          } else {
            color = "fondo6.png";
          }

          var base = "<?php echo base_url("public/Publico/img/") ?>" + "/" + color;
          $("#carasDetalleListas").append(
            '<div class="panellistaCubo listaDetalleCubo" id="' +
            idIndicador +
            '"> <div class ="col-md-3 subpanelLista text-center"><p class="textoDeta">Estado</p><div class = "iconoLista" style="background-image: url(' + "'" + base + "'" + ');"> </div> </div> <div class="col-md-2 subpanelLista2 text-left" style="padding:10px;"><p class="textoDeta">Código</p> ' +
            codigoIndicador +
            ' </div> <div class="col-md-7 subpanelLista" style="padding:10px;"><p class="textoDeta">Indicador</p><p> ' + indicador +
            '</p></div></div> '
          );
        }
      },
      error: function(request, status, error) {
        alert(request.responseText + " " + error);
      }
    });
  });


  $("#btnCubopanel").click(function() {

    $(".panelGen").delay(300).fadeOut(500);
    var caraT = <?php echo $totalCaras; ?>;

    if (caraT === 6) {
      $("#wrapper").css("opacity", "1");
      $("#wrapper").delay(800).fadeIn(500);
    } else {
      $("#panelCarasTotales").css("opacity", "1");
      $("#panelCarasTotales").delay(800).fadeIn(500);
    }

    $("#btnCuboLupa").hide();
    $(this).hide();
  });

  $(document).delegate(".listaDetalleCubo", "click", function(e) {
    window.location.href = 'detalleIndicador/' + $(this).attr("id");
  });

  $("panelGenBorder").each(function(e) {
    if ($(this).hasClass("active")) {
      $(this).css("border", "2px solid #fff");
    }
  });

  $("#btnBuscarIndicador").click(function() {
    $.ajax({
      type: "GET",
      url: "<?= base_url() ?>/consultaDetalle",
      data: {
        idarea: $("#txtIdIndicador").val(),
        nombre: $("#txtBuscar").val()
      },
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(data) {
        if (!$.trim(data)) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No hay resultados',
          })
        } else {
          $("#modalBuscar").modal('hide');
          $("#carasDetalleListas > div").remove();

          for (var i = 0; i < data.length; i++) {
            var idIndicador = data[i].idindicador;
            var codigoIndicador = data[i].codigo;
            var indicador = data[i].indicador;
            var planeado = data[i].planeado;
            var realizado = data[i].realind;


            var color = "";

            var progreso = null;
            if (realizado > planeado) {
              progreso = 100;
            } else {
              if (realizado > 0 && planeado > 0) {
                progreso = (realizado / planeado) * 100;
              } else {
                progreso = 0;
              }
            }


            $color = "";
            if (progreso != null) {
              if (progreso < 11) {
                color = "fondo6.png";
              } else if (progreso > 10 && progreso < 31) {
                color = "fondo5.png";
              } else if (progreso > 30 && progreso < 51) {
                color = "fondo4.png";
              } else if (progreso > 50 && progreso < 71) {
                color = "fondo2.png";
              } else if (progreso > 70 && progreso < 91) {
                color = "fondo3.png";
              } else if (progreso > 90) {
                color = "fondo1.png";
              }
            } else {
              color = "fondo6.png";
            }

            var base = "<?php echo base_url("public/Publico/img/") ?>" + "/" + color;

            $("#carasDetalleListas").append(
              '<div class="panellistaCubo listaDetalleCubo" id="' +
              idIndicador +
              '"><div class ="col-md-3 subpanelLista text-center"><div class="iconoLista" style="background-image: url(' + "'" + base + "'" + ');"> </div> </div> <div class="col-md-2 subpanelLista2 text-left"> ' +
              codigoIndicador +
              ' </div> <div class="col-md-7 subpanelLista"><p> ' + indicador +
              '</p></div></div> '
            );
          }
        }
      },
      error: function(request, status, error) {
        alert(request.responseText + " " + error);
      }
    });
  });








});
</script>



<script type="text/javascript">
var events = new Events();
events.add = function(obj) {
  obj.events = {};
}
events.implement = function(fn) {
  fn.prototype = Object.create(Events.prototype);
}

function Events() {
  this.events = {};
}
Events.prototype.on = function(name, fn) {
  var events = this.events[name];
  if (events == undefined) {
    this.events[name] = [fn];
    this.emit('event:on', fn);
  } else {
    if (events.indexOf(fn) == -1) {
      events.push(fn);
      this.emit('event:on', fn);
    }
  }
  return this;
}
Events.prototype.once = function(name, fn) {
  var events = this.events[name];
  fn.once = true;
  if (!events) {
    this.events[name] = [fn];
    this.emit('event:once', fn);
  } else {
    if (events.indexOf(fn) == -1) {
      events.push(fn);
      this.emit('event:once', fn);
    }
  }
  return this;
}
Events.prototype.emit = function(name, args) {
  var events = this.events[name];
  if (events) {
    var i = events.length;
    while (i--) {
      if (events[i]) {
        events[i].call(this, args);
        if (events[i].once) {
          delete events[i];
        }
      }
    }
  }
  return this;
}
Events.prototype.unbind = function(name, fn) {
  if (name) {
    var events = this.events[name];
    if (events) {
      if (fn) {
        var i = events.indexOf(fn);
        if (i != -1) {
          delete events[i];
        }
      } else {
        delete this.events[name];
      }
    }
  } else {
    delete this.events;
    this.events = {};
  }
  return this;
}

var userPrefix;

var prefix = (function() {
  var styles = window.getComputedStyle(document.documentElement, ''),
  pre = (Array.prototype.slice
    .call(styles)
    .join('')
    .match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o'])
  )[1],
  dom = ('WebKit|Moz|MS|O').match(new RegExp('(' + pre + ')', 'i'))[1];
  userPrefix = {
    dom: dom,
    lowercase: pre,
    css: '-' + pre + '-',
    js: pre[0].toUpperCase() + pre.substr(1)
  };
})();

function bindEvent(element, type, handler) {
  if (element.addEventListener) {
    element.addEventListener(type, handler, false);
  } else {
    element.attachEvent('on' + type, handler);
  }
}

function Viewport(data) {
  events.add(this);

  var self = this;

  this.element = data.element;
  this.fps = data.fps;
  this.sensivity = data.sensivity;
  this.sensivityFade = data.sensivityFade;
  this.touchSensivity = data.touchSensivity;
  this.speed = data.speed;

  this.lastX = 0;
  this.lastY = 0;
  this.mouseX = 0;
  this.mouseY = 0;
  this.distanceX = 0;
  this.distanceY = 0;
  this.positionX = 1122;
  this.positionY = 136;
  this.torqueX = 0;
  this.torqueY = 0;

  this.down = false;
  this.upsideDown = false;

  this.previousPositionX = 0;
  this.previousPositionY = 0;

  this.currentSide = 0;
  this.calculatedSide = 0;


  bindEvent(document, 'mousedown', function() {
    self.down = true;
  });

  bindEvent(document, 'mouseup', function() {
    self.down = false;
  });

  bindEvent(document, 'keyup', function() {
    self.down = false;
  });

  bindEvent(document, 'mousemove', function(e) {
    self.mouseX = e.pageX;
    self.mouseY = e.pageY;
  });

  bindEvent(document, 'touchstart', function(e) {

    self.down = true;
    e.touches ? e = e.touches[0] : null;
    self.mouseX = e.pageX / self.touchSensivity;
    self.mouseY = e.pageY / self.touchSensivity;
    self.lastX = self.mouseX;
    self.lastY = self.mouseY;
  });

  bindEvent(document, 'touchmove', function(e) {
    if (e.preventDefault) {
      e.preventDefault();
    }

    if (e.touches.length == 1) {

      e.touches ? e = e.touches[0] : null;

      self.mouseX = e.pageX / self.touchSensivity;
      self.mouseY = e.pageY / self.touchSensivity;

    }
  });

  bindEvent(document, 'touchend', function(e) {
    self.down = false;
  });

  setInterval(this.animate.bind(this), this.fps);

}
events.implement(Viewport);
Viewport.prototype.animate = function() {

  this.distanceX = (this.mouseX - this.lastX);
  this.distanceY = (this.mouseY - this.lastY);

  this.lastX = this.mouseX;
  this.lastY = this.mouseY;

  if (this.down) {
    this.torqueX = this.torqueX * this.sensivityFade + (this.distanceX * this.speed - this.torqueX) * this
    .sensivity;
    this.torqueY = this.torqueY * this.sensivityFade + (this.distanceY * this.speed - this.torqueY) * this
    .sensivity;
  }

  if (Math.abs(this.torqueX) > 1.0 || Math.abs(this.torqueY) > 1.0) {
    if (!this.down) {
      this.torqueX *= this.sensivityFade;
      this.torqueY *= this.sensivityFade;
    }

    this.positionY -= this.torqueY;

    if (this.positionY > 360) {
      this.positionY -= 360;
    } else if (this.positionY < 0) {
      this.positionY += 360;
    }

    if (this.positionY > 90 && this.positionY < 270) {
      this.positionX -= this.torqueX;

      if (!this.upsideDown) {
        this.upsideDown = true;
        this.emit('upsideDown', {
          upsideDown: this.upsideDown
        });
      }

    } else {

      this.positionX += this.torqueX;

      if (this.upsideDown) {
        this.upsideDown = false;
        this.emit('upsideDown', {
          upsideDown: this.upsideDown
        });
      }
    }

    if (this.positionX > 360) {
      this.positionX -= 360;
    } else if (this.positionX < 0) {
      this.positionX += 360;
    }

    if (!(this.positionY >= 46 && this.positionY <= 130) && !(this.positionY >= 220 && this.positionY <= 308)) {
      if (this.upsideDown) {
        if (this.positionX >= 42 && this.positionX <= 130) {
          this.calculatedSide = 3;
        } else if (this.positionX >= 131 && this.positionX <= 223) {
          this.calculatedSide = 2;
        } else if (this.positionX >= 224 && this.positionX <= 314) {
          this.calculatedSide = 5;
        } else {
          this.calculatedSide = 4;
        }
      } else {
        if (this.positionX >= 42 && this.positionX <= 130) {
          this.calculatedSide = 5;
        } else if (this.positionX >= 131 && this.positionX <= 223) {
          this.calculatedSide = 4;
        } else if (this.positionX >= 224 && this.positionX <= 314) {
          this.calculatedSide = 3;
        } else {
          this.calculatedSide = 2;
        }
      }
    } else {
      if (this.positionY >= 46 && this.positionY <= 130) {
        this.calculatedSide = 6;
      }

      if (this.positionY >= 220 && this.positionY <= 308) {
        this.calculatedSide = 1;
      }
    }

    if (this.calculatedSide !== this.currentSide) {
      this.currentSide = this.calculatedSide;
      this.emit('sideChange');
    }

  }

  if(this.element != null){
    this.element.style[userPrefix.js + 'Transform'] = 'rotateX(' + this.positionY + 'deg) rotateY(' + this
    .positionX + 'deg)';
  }



  if (this.positionY != this.previousPositionY || this.positionX != this.previousPositionX) {
    this.previousPositionY = this.positionY;
    this.previousPositionX = this.positionX;

    this.emit('rotate');

  }

}
var viewport = new Viewport({
  element: document.getElementsByClassName('cube')[0],
  fps: 20,
  sensivity: .1,
  sensivityFade: .93,
  speed: 2,
  touchSensivity: 1.5
});

function Cube(data) {

  if(document.getElementsByClassName('side') != undefined){
    var self = this;
    this.element = data.element;
    this.sides = this.element.getElementsByClassName('side');

    this.viewport = data.viewport;
    this.viewport.on('rotate', function() {
      self.rotateSides();
    });
    this.viewport.on('upsideDown', function(obj) {
      self.upsideDown(obj);
    });
    this.viewport.on('sideChange', function() {
      self.sideChange();
    });
  }
}
Cube.prototype.rotateSides = function() {
  var viewport = this.viewport;
  if (viewport.positionY > 90 && viewport.positionY < 270) {
    this.sides[0].getElementsByClassName('cube-image')[0].style[userPrefix.js + 'Transform'] = 'rotate(' + (
      viewport.positionX + viewport.torqueX) + 'deg)';
      this.sides[5].getElementsByClassName('cube-image')[0].style[userPrefix.js + 'Transform'] = 'rotate(' + -(
        viewport.positionX + 180 + viewport.torqueX) + 'deg)';
      } else {
        this.sides[0].getElementsByClassName('cube-image')[0].style[userPrefix.js + 'Transform'] = 'rotate(' + (
          viewport.positionX - viewport.torqueX) + 'deg)';
          this.sides[5].getElementsByClassName('cube-image')[0].style[userPrefix.js + 'Transform'] = 'rotate(' + -(
            viewport.positionX + 180 - viewport.torqueX) + 'deg)';
          }
        }
        Cube.prototype.upsideDown = function(obj) {

          var deg = (obj.upsideDown == true) ? '180deg' : '0deg';
          var i = 5;

          while (i > 0 && --i) {
            this.sides[i].getElementsByClassName('cube-image')[0].style[userPrefix.js + 'Transform'] = 'rotate(' + deg +
            ')';
          }

        }
        Cube.prototype.sideChange = function() {

          for (var i = 0; i < this.sides.length; ++i) {
            this.sides[i].getElementsByClassName('cube-image')[0].className = 'cube-image';
          }

          this.sides[this.viewport.currentSide - 1].getElementsByClassName('cube-image')[0].className =
          'cube-image active';

          this.sides[this.viewport.currentSide - 1].getElementsByClassName('caraCubo')[0].className =
          'panelGenBorder';





        }

        new Cube({
          viewport: viewport,
          element: document.getElementsByClassName('cube')[0]
        });
        </script>
