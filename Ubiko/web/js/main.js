/**
* Main Beahviour
*/

$(function () {

    var initDraggableGrid = function () {

        console.info("Init Draggable Grid");

        // Definición del carrusel.
        $('.infiniteCarousel').infiniteCarousel({
            itemsPerMove : 1,
            duration : 500,
            vertical : true
        });

        //Definicion del carrusel para BOX
        $('.infiniteCarouselBox').infiniteCarouselBox({
            itemsPerMove : 1,
            duration : 500,
            vertical : true
        });


        // Definicion Drag and Drop
        $(".droppable").droppable({
            accept : ".arrastrable",
            greedy: true,
            over: function () {
                $(this).addClass("encima");
            },
            out: function () {
                $(this).removeClass("encima");
            },
            drop: function( event, ui ) {
                //snapToMiddle(ui.draggable,$(this));
                var $draggable = ui.draggable;
                var id = $draggable.attr("id");
                var $helper = $(ui.helper);
                $helper.attr("id", id);
                $(this).append($helper);
                $draggable.attr("style", "");
                var id = $(this).attr('id');
                document.getElementById(id-1).style.display="inline-block";
                var idPadre = $(this).children().attr('id');
                switch(idPadre){
                    case "BOX":
                    window.location.href = 'index.php?ctl=insertarBOX';
                    break;
                    case "ECO":
                    window.location.href = 'index.php?ctl=insertarECO';
                    break;
                    case "TAC":
                    window.location.href = 'index.php?ctl=insertarTAC';
                    break;
                    case "RX":
                    window.location.href = 'index.php?ctl=insertarRX';
                    break;
                    case "TR":
                    window.location.href = 'index.php?ctl=insertarTR';
                    break;
                    case "SALAA":
                    window.location.href = 'index.php?ctl=insertarSalaA';
                    break;
                    case "SALAB":
                    window.location.href = 'index.php?ctl=insertarSalaB';
                    break;
                    case "SALATRA":
                    window.location.href = 'index.php?ctl=insertarSalaTra';
                    break;
                    case "SALAOBS":
                    window.location.href = 'index.php?ctl=insertarOBS';
                    break;
                    case "QUI":
                    window.location.href = 'index.php?ctl=insertarQUI';
                    break;
                    case "ING":
                    window.location.href = 'index.php?ctl=insertarING';
                    break;
                    case "EXITUS":
                    window.location.href = 'index.php?ctl=insertarExitus';
                    break;
                    case "ALTA":
                    window.location.href = 'index.php?ctl=insertarAlta';
                    break;

                }
            }
        });

        $(".item-wrapper .arrastrable").draggable({
            helper: "clone",
            revert: "invalid",
            start: function( ) {
                $(".droppable").addClass("sombreado");
            },
            end: function () {
                $(".droppable").removeClass("sombreado");
            }
        });





/*
         $(".draggable").bind('dragstart', function (event) {
document.getElementByClassName("cuadradoLista").style.background= "#F00";
});
        

        $(".item-wrapper .arrastrable").mousedown(function(){
            var $item =  $(this);
            var $wrapper = $item.parent();

            

            
            var $clon = $(this).clone();
            $clon.addClass("clon");
            $clon.draggable({
                helper: "clone",
                revert: "invalid",
                opacity:0.6,
                create: function(){$(this).data('position',$(this).position())}
            }).appendTo($wrapper);
            $clon.css({
                position : "absolute",
                top: $item.position().top,
                left: $item.position().left,
            });
            
            
            $clon.trigger("drag");
        */

    }
    

    function snapToMiddle(dragger, target){
        var topMove = target.position().top - dragger.data('position').top + (target.outerHeight(true) - dragger.outerHeight(true)) / 2;
        var leftMove= target.position().left - dragger.data('position').left + (target.outerWidth(true) - dragger.outerWidth(true)) / 2;
        dragger.animate({top:topMove,left:leftMove},{duration:200,easing:'linear'});
    }

    /*var cambioColor = function(){
        $('#admision').click(function(){
            var $item = $(this);
            var $seg = $('#seguimiento');
            var $box = $('#box');
            var $est = $('#estadisticas');
            $item.css("background-color","#339999");
            //$seg.css("background-color","#4c4c4c");
            //$box.css("background-color","#4c4c4c");
            //$est.css("background-color","#4c4c4c");
        });
        $('#seguimiento').click(function(){
            var $item = $(this);
            var $ad = $('#admision');
            var $box = $('#box');
            var $est = $('#estadisticas');
            $item.css("background-color","#339999")
            //$ad.css("background-color","#4c4c4c")
            //$box.css("background-color","#4c4c4c")
            //$est.css("background-color","#4c4c4c")
        });
        $('#box').click(function(){
            var $item = $(this);
            var $seg = $('#seguimiento');
            var $ad = $('#admision');
            var $est = $('#estadisticas');
            $item.css("background-color","#339999")
            //$seg.css("background-color","#4c4c4c")
            //$ad.css("background-color","#4c4c4c")
            //$est.css("background-color","#4c4c4c")
        });
        $('#estadisticas').click(function(){
            var $item = $(this);
            var $seg = $('#seguimiento');
            var $box = $('#box');
            var $ad = $('#admision');
            $item.css("background-color","#339999")
            //$seg.css("background-color","#4c4c4c")
            //$box.css("background-color","#4c4c4c")
           //$ad.css("background-color","#4c4c4c")
        });
    }*/

    var init = function () {
        initDraggableGrid();
    }

    init();

});