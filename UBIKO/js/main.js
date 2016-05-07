/**
* Main Beahviour
*/

$(function () {

    var initDraggableGrid = function () {

        console.info("Init Draggable Grid");

        // Definimos carrusel.
        $('.infiniteCarousel').infiniteCarousel({
            itemsPerMove : 1,
            duration : 500,
            vertical : true
        });


        // Definir Drag and Drop
        $(".droppable").droppable({
            accept : ".arrastrable",
            greedy: true,
            drop: function( event, ui ) {
                snapToMiddle(ui.draggable,$(this));
                $(this).append(ui.draggable);
                console.log(ui.draggable);
                ui.draggable.attr("style", "")
            }
            
        });
        
        $(".item-wrapper .arrastrable").mousedown(function(){
            var $item =  $(this);
            var $wrapper = $item.parent();
            var $clon = $(this).clone();
            $clon.addClass("clon");
            $clon.css({
                position : "absolute",
                top: $item.position().top,
                left: $item.position().left,
            });
            $clon.draggable({
                revert: "invalid",
                opacity:0.6,
                create: function(){$(this).data('position',$(this).position())}
            }).appendTo($wrapper);

            $clon.trigger("drag");

        });

        function snapToMiddle(dragger, target){
            var topMove = target.position().top - dragger.data('position').top + (target.outerHeight(true) - dragger.outerHeight(true)) / 2;
            var leftMove= target.position().left - dragger.data('position').left + (target.outerWidth(true) - dragger.outerWidth(true)) / 2;
            dragger.animate({top:topMove,left:leftMove},{duration:200,easing:'linear'});
        }
        

    }


    var managePages = function () {

        console.info("Init Manage Pages");

        $("#admision").click(function(event) {
            $("#contenedor").load('adm.html');
            $("#linkestilo").attr("href", "./css/estiloAd.css")
        });     
        $("#seguimiento").click(function(event) {
            $("#contenedor").load('seguimiento.html', initDraggableGrid);
            $("#linkestilo").attr("href", "./css/estiloSe.css")
        });
        $("#box").click(function(event) {
            $("#contenedor").load('adm.html');
            $("#linkestilo").attr("href", "./css/estiloBox.css")
        });
        $("#estadisticas").click(function(event) {
            $("#contenedor").load('adm.html');
            $("#linkestilo").attr("href", "./css/estiloEst.css")
        });     
    }





    var init = function () {
        managePages();
        //initDraggableGrid();
    }

    init();

});