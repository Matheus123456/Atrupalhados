! function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add-new-event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my-event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function(eventObj, date) {
            var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
        },
        CalendarApp.prototype.enableDrag = function() {
            //init events
            $(this.$event).each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            });
        }
    /* Initializing */
    CalendarApp.prototype.init = function() {
            this.enableDrag();
            /*  Initialize the calendar  */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());      

            var defaultEvents = preencher_calendario();

            var $this = this;
            $this.$calendarObj = $this.$calendar.fullCalendar({
                slotDuration: '00:15:00',
                /* If we want to split day time each 15minutes */
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'month',
                handleWindowResize: true,

                header: {
                    left: 'prev, today',
                    center: 'title',
                    right: 'next'
                },
                events: defaultEvents,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                drop: function(date) { $this.onDrop($(this), date); },
                select: function(start, end, allDay) { $this.onSelect(start, end, allDay); },
                eventClick: function(event) { 
                    info_evento_calendar(event.id);
                }

            });
            
        },

        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {

    $.CalendarApp.init()
});

function preencher_calendario (){
    var theBigDay;
    var funcao = 'listar_eventos_calendario';
    var item = [];
    
    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: false,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=0; i<dados.length; i++){
                var qtd_pessoas = dados[i].Qtd_pessoas;
                var criador_evento = dados[i].criador_evento;
                var data = dados[i].date;
                var endereco = dados[i].endereco;
                var id = dados[i].id;
                //var local = dados[i].nome_local;

                var dia = data.substring(8,10);
                var mes = data.substring(5,7);
                var ano = data.substring(0,4);
                var hora = data.substring(11,12);
                var minuto = data.substring(13,14);
                var segundo = data.substring(15,16);
                var horario = data.substring(11,16);

                var theBigDay = new Date(data);

                const months = ["bg-info", "bg-danger", "bg-success", "bg-warning", "bg-purple", "bg-warning"];

                const random = Math.floor(Math.random() * months.length);
                
                
                item[i] = {
                    title: dados[i].nome_local,
                    start: theBigDay,
                    className: months[random],
                    id: id,
                }
            }
            retorno = item;
        }
    });
    return retorno;
}

function info_evento_calendar(id){
    $('#info-evento').modal('show');
    var funcao = 'evento_modal_calendar';

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: false,
        data: {'funcao': funcao, 'id': id},
        success: function(dados){
            for(var i=0; i<dados.length; i++){
                var qtd_pessoas = dados[i].Qtd_pessoas;
                var criador_evento = dados[i].criador_evento;
                var data = dados[i].date;
                var endereco = dados[i].endereco;
                var id = dados[i].id;
                var local = dados[i].nome_local;

                var dia = data.substring(8,10);
                var mes = data.substring(5,7);
                var ano = data.substring(0,4);
                var hora = data.substring(11,12);
                var minuto = data.substring(13,14);
                var segundo = data.substring(15,16);
                var horario = data.substring(11,16);

                $('.local_info').html(local);
                $('.data_info').html(dia+'/'+mes+'/'+ano+' às '+horario);
                $('.endereco_info').html(endereco);
                $('.limite_info').html(qtd_pessoas);

                listar_participantes(id, criador_evento);
                
            }
        }
    });
}

function listar_participantes (id, criador_evento){
    var funcao = 'listar_participantes';
    $('#part_table').empty();
    $('#qtd_part').empty();

	$.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao, 'id': id},
        error: function(){
            
        },
        success: function(dados){
            if(dados == null){   
                $('#qtd_part').html('0');
                $('#part_table').append('\
                    <tr>\
                        <td class="border-top-0 px-2 py-4">\
                            <div class="d-flex no-block align-items-center">\
                                Nenhum participante confirmado!\
                            </div>\
                        </td>\
                    </tr>'); 
            } else {
                for(var i=0; i<dados.length; i++){
                    var foto = dados[i].foto;
                    var nome = dados[i].nome;
                    var email = dados[i].email;

                    if(email_usuario == email){
                        var voce = 'inline';
                    } else {
                        var voce = 'none';
                    }

                    if(email_usuario == email || tipo_conta != 'adminmaster'){
                        var cancelar_presenca_eu = 'none';
                    } else {
                        var cancelar_presenca_eu = 'block';
                    }

                    if(criador_evento == email){
                        var criador = 'inline';
                    } else {
                        var criador = 'none';
                    }

                    $('#part_table').append('\
                    <tr>\
                        <td class="border-top-0 px-2 py-4">\
                            <div class="d-flex no-block align-items-center">\
                                <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45"></div>\
                                <div class="">\
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'<p style="display:'+voce+'"> (Você)</p></h5>\
                                    <span class="text-muted font-14">'+email+'</span><br>\
                                    <span class="text-muted font-14" style="display:'+criador+'">Criador do Evento</span>\
                                </div>\
                            </div>\
                        </td>\
                    </tr>'); 
                }
                $('#qtd_part').html(i);
            }
        }
	});
}