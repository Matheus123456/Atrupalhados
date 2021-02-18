// Funções da dashboard //
var start_mes = 0;
function ranking_mes (){
    var funcao = 'ranking_mes';
    var limite = start_mes + 5;

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=start_mes; i<limite; i++){
                var id = dados[i].id;
                var nome = dados[i].nome;
                var foto = dados[i].foto;
                var email = dados[i].email_user;
                var qtd = dados[i].qtd;
                var posicao = i+1;

                $('#table_rank_mes').append('\
                    <tr>\
                        <td class="border-top-0 px-2 py-4">\
                            <div class="d-flex no-block align-items-center">\
                                <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45" /></div>\
                                <div class="">\
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'</h5>\
                                    <span class="text-muted font-14">'+email+'</span>\
                                </div>\
                            </div>\
                        </td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+posicao+'º lugar</td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+qtd+'</td>\
                    </tr>\
                ');
                start_mes++;
            }
        }
    });
}

var start_ano = 0;
function ranking_ano (){
    var funcao = 'ranking_ano';
    var limite = start_ano + 5;

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=start_ano; i<limite; i++){
                var id = dados[i].id;
                var nome = dados[i].nome;
                var foto = dados[i].foto;
                var email = dados[i].email_user;
                var qtd = dados[i].qtd;
                var posicao = i+1;

                $('#table_rank_ano').append('\
                    <tr>\
                        <td class="border-top-0 px-2 py-4">\
                            <div class="d-flex no-block align-items-center">\
                                <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45" /></div>\
                                <div class="">\
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'</h5>\
                                    <span class="text-muted font-14">'+email+'</span>\
                                </div>\
                            </div>\
                        </td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+posicao+'º lugar</td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+qtd+'</td>\
                    </tr>\
                ');
                start_ano++;
            }
        }
    });
}

var start_total = 0;
function ranking_total (){
    var funcao = 'ranking_total';
    var limite = start_total + 5;

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=start_total; i<limite; i++){
                var id = dados[i].id;
                var nome = dados[i].nome;
                var foto = dados[i].foto;
                var email = dados[i].email_user;
                var qtd = dados[i].qtd;
                var posicao = i+1;

                $('#table_rank_total').append('\
                    <tr>\
                        <td class="border-top-0 px-2 py-4">\
                            <div class="d-flex no-block align-items-center">\
                                <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45" /></div>\
                                <div class="">\
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'</h5>\
                                    <span class="text-muted font-14">'+email+'</span>\
                                </div>\
                            </div>\
                        </td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+posicao+'º lugar</td>\
                        <td class="border-top-0 text-muted px-2 py-4 font-14" style="text-align: center;">'+qtd+'</td>\
                    </tr>\
                ');
                start_total++;
            }
        }
    });
}

var limite_list_pessoas = 0;
function listar_todos_usuarios (){
    var funcao = 'listar_usuarios_dashboard';
    var limite = limite_list_pessoas + 5;
    //$('#part_modal').empty();
    
    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=limite_list_pessoas; i<limite; i++){
                var foto = dados[i].foto;
                var nome = dados[i].nome;
                var email = dados[i].email;
                var contato = dados[i].celular;

                $('#usuarios_dashboard').append('\
                <tr>\
                    <td class="border-top-0 px-2 py-4">\
                        <div class="d-flex no-block align-items-center">\
                            <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45"></div>\
                            <div class="">\
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'</h5>\
                                <span class="text-muted font-14">'+email+'</span>\
                            </div>\
                        </div>\
                    </td>\
                    <td class="border-top-0 text-muted px-2 py-4 font-14">'+contato+'</td>\
                    <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">'+contar_participacoes(email)+'</td>\
                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K</td>\
                </tr>');
                limite_list_pessoas++; 
            } 
        }
    });
}


function contar_participacoes (email){
    var funcao = 'contar_participacoes';
    var qtd_participacoes;

    $.ajax({
        type:'post',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: {'funcao': funcao, 'email': email},
        error: function() {
            //swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result)
        {
            
        }
    });
}

// -------------------------- //

function listar_eventos (){
    var funcao = 'listar_eventos';
    $('#eventos-row').empty();

    $.ajax({
    type:'post',
    dataType: 'json',
    url: 'functions.php',
    async: true,
    data: {'funcao': funcao},
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

            if(email_usuario == criador_evento || tipo_conta == 'adminmaster'){
                var criador_admin = 'inline';
            } else {
                var criador_admin = 'none';
            }
            
            verificar_presenca(id, i, qtd_pessoas, data);
            //setInterval('verificar_presenca_tempo('+id+', '+i+', '+qtd_pessoas+')', 1000);

            $('#eventos-row').append('<div class="col-lg-4 col-md-6">\
                <div class="card">\
                    <div class="card-body">\
                        <div class="btn-group" style="width: 100%;">\
                            <div style="width: 100%;">\
                                <h4 class="card-title" style="float: left;">'+local+'</h4>\
                                <i style="float: right; padding-right: 10px; padding-left: 10px; display: '+criador_admin+'" class="fas fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>\
                                <div class="dropdown-menu">\
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#editar-evento" onclick="puxar_dados_evento('+id+', \'' +local+ '\', \''+ano+'\', \''+mes+'\', \''+dia+'\', \''+horario+'\', \''+endereco+'\', '+qtd_pessoas+')">Editar Evento</a>\
                                    <div class="dropdown-divider"></div>\
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="cancelar_evento('+id+')">Cancelar Evento</a>\
                                </div>\
                            </div>\
                        </div>\
                        \
                        <p class="card-text">'+endereco+'</p>\
                        <p class="card-text" style="line-height: 0.3;">'+dia+'/'+mes+'/'+ano+'  às  '+horario+'</p>\
                        <a id="button_acao'+i+'"></a>\
                        <a href="#"><button type="button" class="btn btn-primary btn-vermais" data-toggle="modal" data-target="#info-evento" onclick="puxar_dados_evento_info('+id+', \'' +local+ '\', \''+ano+'\', \''+mes+'\', \''+dia+'\', \''+horario+'\', \''+endereco+'\', '+qtd_pessoas+', \''+criador_evento+'\')">Ver mais</button></a>\
                    </div>\
                </div>\
            </div>');
            }
        }
    });
}

function verificar_presenca(id, i, limite_pessoas, data){
    var funcao = 'verificar_presenca';
    $('#button_acao'+i).empty();

    $.ajax({
        type:'post',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: {'funcao': funcao, 'id': id},
        error: function() {
            //swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result)
        {
            var email = result[0].email_user;
            
            if(email === undefined){
                var qtd_pessoas = result[0].qtd;
                //alert(qtd_pessoas+' - '+limite_pessoas);
                
                if(qtd_pessoas == limite_pessoas){
                    $('#button_acao'+i).append('<button type="button" class="btn btn-danger btn-confirmar" disabled>Esgotato</button>');
                } else {
                    $('#button_acao'+i).append('<button type="button" class="btn btn-success btn-confirmar" onclick="confirmar_presenca('+id+', '+i+', '+limite_pessoas+', \'' +data+ '\');"> Confirmar Presença</button>');
                }
            } else {
                var qtd_pessoas = result[0].qtd_pessoas;
                $('#button_acao'+i).append('<button type="button" class="btn btn-danger btn-confirmar" onclick="cancelar_presenca('+id+', '+i+', '+limite_pessoas+', \'' +data+ '\');;"> Cancelar Presença</button>');
            }
        }
    });
}

function confirmar_presenca(id, i, limite_pessoas, data){
    var funcao = 'confirmar_presenca';

    $.ajax({
        type:'post',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: {'funcao': funcao, 'id': id, 'limite_pessoas': limite_pessoas, 'data': data},
        beforeSend: function(){
            $("#button_acao"+i).html('<button type="button" class="btn btn-success btn-confirmar"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Confirmando...</button>');
        },
        error: function() {
            //swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result)
        {
            if($.trim(result) == '1'){
                $('#button_acao'+i).empty();
                $('#button_acao'+i).append('<button type="button" class="btn btn-danger btn-confirmar" onclick="cancelar_presenca('+id+', '+i+', '+limite_pessoas+', \'' +data+ '\');"> Cancelar Presença</button>');
            } else if($.trim(result) == 'limite_atingido'){
                $('#button_acao'+i).empty();
                $('#button_acao'+i).append('<button type="button" class="btn btn-danger btn-confirmar" disabled>Esgotato</button>');
                swal("Ops!", "O limite de participantes foi atingido!", "error");
            }
        }
    });
}

function cancelar_presenca(id, i, limite_pessoas, data){
    var funcao = 'cancelar_presenca';

    $.ajax({
        type:'post',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: {'funcao': funcao, 'id': id},
        beforeSend: function(){
            $("#button_acao"+i).html('<button type="button" class="btn btn-danger btn-confirmar"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cancelando...</button>');
        },
        error: function() {
            //swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result)
        {
            if($.trim(result) == '1'){
                $('#button_acao'+i).empty();
                $('#button_acao'+i).append('<button type="button" class="btn btn-success btn-confirmar" onclick="confirmar_presenca('+id+', '+i+', '+limite_pessoas+', \'' +data+ '\');"> Confirmar Presença</button>');
            }
        }
    });
}

function puxar_dados_evento_info(id, local, ano, mes, dia, horario, endereco, qtd_pessoas, criador_evento){
    $('.local_info').html(local);
    $('.data_info').html(dia+'/'+mes+'/'+ano+' às '+horario);
    $('.endereco_info').html(endereco);
    $('.limite_info').html(qtd_pessoas);

    listar_participantes(id, criador_evento);
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
                                <div style="width: 100%; text-align: right;">\
                                    <i style="padding-right: 10px; padding-left: 10px; display: '+cancelar_presenca_eu+'" class="fas fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>\
                                    <div class="dropdown-menu">\
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="cancelar_presenca_admin('+id+', \'' +email+ '\', \'' +criador_evento+ '\')">Cancelar Presença</a>\
                                    </div>\
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


// Funções de administrador // 

function editar_evento (){
    var dados = $('#editar_evento').serialize();

    $.ajax({
      type: 'POST',
      url: 'functions.php',
      async: true,
      dataType: 'json',
      data: dados,
      beforeSend: function()
      {
         $("#button_editar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Editando...');
      },
      error: function() {
        swal("Error!", "Verifique sua conexão!", "error");
      },
      success: function(result) {
        $("#button_editar").html('Editar');
        if($.trim(result) == "local_vazio"){
            swal("Ops!", "Local inválido ", "warning");
        } else if($.trim(result) == "data_evento_vazio"){
            swal("Ops!", "Data inválida", "warning");
        } else if($.trim(result) == "data_menor"){
            swal("Ops!", "A data do evento não pode ser antes do dia de hoje!", "warning");
        } else if($.trim(result) == "endereco_vazio"){
            swal("Ops!", "Endereco inválido", "warning");
        } else if($.trim(result) == "limite_vazio"){
            swal("Ops!", "Limite de participantes inválido", "warning");
        } else if($.trim(result) == "qtd_invalida"){
            swal("Ops!", "Limite menor que a quantidade de usuários já confirmados!", "warning");
        } else {
            $('#editar_evento').each (function(){
              this.reset();
            });
            $('#editar-evento').modal('hide');
            swal("Perfeito!", "O evento foi editado com sucesso!", "success");
            listar_eventos();
        }
      }
  });
}

function cancelar_evento(id){
    var funcao = 'cancelar_evento';

    swal({
        title: "Atenção!",
        text: "Você tem certeza que deseja cancelar esse evento?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'id': id, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){
                        swal("Pronto!", "O evento foi cancelado com sucesso!", "success");
                        listar_eventos();
                    }
                }
            });
        } 
    });
}

function cadastrar_evento (){
    var dados = $('#cadastrar_evento').serialize();
  
    $.ajax({
        type: 'POST',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: dados,
        beforeSend: function()
        {
           $("#button_cadastrar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cadastrando...');
        },
        error: function() {
          swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result) {
          $("#button_cadastrar").html('Cadastrar');
          if($.trim(result) == "local_vazio"){
              swal("Ops!", "Local inválido ", "warning");
          } else if($.trim(result) == "data_evento_vazio"){
              swal("Ops!", "Data inválida", "warning");
          } else if($.trim(result) == "endereco_vazio"){
              swal("Ops!", "Endereco inválido", "warning");
          } else if($.trim(result) == "limite_vazio"){
              swal("Ops!", "Limite de participantes inválido", "warning");
          } else {
              $('#cadastrar_evento').each (function(){
                this.reset();
              });
              $('#signup-modal').modal('hide');
              swal("Perfeito!", "O evento foi cadastrado com sucesso!", "success");
              listar_eventos();
          }
        }
    });
} 

function puxar_dados_evento(id, local, ano, mes, dia, horario, endereco, qtd_pessoas){
    $('#id_evento_editar').val(id);
    $('#local_editar').val(local);
    $('#data_editar').val(ano+'-'+mes+'-'+dia+'T'+horario);
    $('#endereco_editar').val(endereco);
    $('#limite_editar').val(qtd_pessoas);
    
}

function cancelar_presenca_admin(id, email, criador_evento){
    var funcao = 'cancelar_presenca_admin';

    swal({
        title: "Atenção!",
        text: "Você tem certeza que deseja excluir esse usuário do evento?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'id': id, 'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){
                        swal("Pronto!", "O usuário foi removido com sucesso!", "success");
                        listar_participantes(id, criador_evento);
                    }
                }
            });
        } 
    });
}

function tornar_admin(email){
    var funcao = 'tornar_admin';

    swal({
        title: "Atenção!",
        text: "Você tem certeza que deseja tornar esse usuário admin?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){                     
                        swal({
                            title: "Perfeito!",
                            text: "O usuário agora é um administrador!",
                            icon: "success",
                            buttons: true,
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                              location.reload();
                            } else {
                              location.reload();
                            }
                          });
                    }
                }
            });
        } 
    });
}

function cancelar_admin(email){
    var funcao = 'cancelar_admin';

    swal({
        title: "Atenção!",
        text: "Esse usuário não será mais um administrador!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){                     
                        swal({
                            title: "Perfeito!",
                            text: "O usuário não é mais um administrador!",
                            icon: "success",
                            buttons: true,
                        })
                          .then((willDelete) => {
                            if (willDelete) {
                              location.reload();
                            } else {
                              location.reload();
                            }
                        });
                    }
                }
            });
        } 
    });
}

function excluir_usuário(email){
    var funcao = 'excluir_usuário';

    swal({
        title: "Atenção!",
        text: "Após apagado, os dados desse usuário não poderão mais ser recuperados!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){                     
                        swal({
                            title: "Perfeito!",
                            text: "O usuário foi excluído com sucesso!",
                            icon: "success",
                            buttons: true,
                        })
                          .then((willDelete) => {
                            if (willDelete) {
                              location.reload();
                            } else {
                              location.reload();
                            }
                        });
                    }
                }
            });
        } 
    });
}

function cancelar_acesso(email){
    var funcao = 'cancelar_acesso';

    swal({
        title: "Atenção!",
        text: "Deseja cancelar acesso a esse usuário?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){                     
                        swal({
                            title: "Perfeito!",
                            text: "Acesso cancelado com sucesso!",
                            icon: "success",
                            buttons: true,
                        })
                          .then((willDelete) => {
                            if (willDelete) {
                              location.reload();
                            } else {
                              location.reload();
                            }
                        });
                    }
                }
            });
        } 
    });
}

function conceder_acesso(email){
    var funcao = 'conceder_acesso';

    swal({
        title: "Atenção!",
        text: "Deseja conceder acesso a esse usuário?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: 'functions.php',
                async: true,
                dataType: 'json',
                data: {'email': email, 'funcao': funcao},
                error: function() {
                    swal("Error!", "Verifique sua conexão!", "error");
                },
                success: function(result){
                    if($.trim(result) == '1'){                     
                        swal({
                            title: "Perfeito!",
                            text: "Acesso concedido com sucesso!",
                            icon: "success",
                            buttons: true,
                        })
                          .then((willDelete) => {
                            if (willDelete) {
                              location.reload();
                            } else {
                              location.reload();
                            }
                        });
                    }
                }
            });
        } 
    });
}



// Funções do usuário //

function alterar_senha (){
    var dados = $('#form_alterar_senha').serialize();
  
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: dados,
        beforeSend: function(){
            $("#btn_altera_senha").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        },
        error: function() {
            swal("Error!", "Verifique sua conexão!", "error");
        },
        success: function(result) {
            $("#btn_altera_senha").html('Alterar Senha');
    
            if($.trim(result) == "campos_vazios"){
            swal("Ops!", "Você não pode deixar nenhum campo vazio!", "warning");
            } else if($.trim(result) == "caracter_invalido"){
            swal("Ops!", "Sua senha deve ter entre 8 e 16 caracteres!", "warning");
            } else if($.trim(result) == "senhas_diferentes"){
            swal("Ops!", "As senhas não condizem!", "warning");
            } else if($.trim(result) == "senha_incorreta"){
            swal("Ops!", "Senha atual incorreta!", "warning");
            } else {
                swal("Perfeito!", "Senha alterada com sucesso!", "success")
                .then((value) => {
                    location.reload();
                });
            }
        }
    });
}

function alterar_usuario (){
    var dados = $('#alterar_dados').serialize();

    $.ajax({
        type: 'POST',
        url: 'functions.php',
        async: true,
        dataType: 'json',
        data: dados,
        beforeSend: function()
        {
            $("#button_atualizar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        },
        error: function() {
            swal("Error!", "Verifique sua conexão!", "error");
            $("#button_atualizar").html('Atualizar Perfil');
        },
        success: function(result) {
            $("#button_atualizar").html('Atualizar Perfil');

            if($.trim(result) == "campos_vazios"){
                swal("Ops!", "Campos Vazios!", "warning");
            } else if($.trim(result) == "alterado") {
                swal("Perfeito!", "As informações do usuário foram editadas com sucesso!", "success");
                $('#nome_title').html($('#nome_val').val());
                $('#celular_title').html($('#celular_val').val());
                
            }
        }
    });
}

function listar_ultimo_eventos (){
    var funcao = 'listar_ultimos_eventos';
    $('#ultimos_eventos_table').empty();

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao},
        success: function(dados){
            for(var i=0; i<dados.length; i++){
                var qtd_pessoas = dados[i].Qtd_pessoas;
                var criador_evento = dados[i].criador_evento;
                var data = dados[i].date;
                var endereco = dados[i].endereco;
                var id = dados[i].id;
                var local = dados[i].nome_local;

                /*if(email_usuario == criador_evento || tipo_conta == 'adminmaster'){
                    var criador_admin = 'inline';
                } else {
                    var criador_admin = 'none';
                }*/

                $('#ultimos_eventos_table').append('\
                <tr>\
                    <td class="border-top-0 px-2 py-4">\
                        <div class="d-flex no-block align-items-center">\
                            <div class="">\
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">'+local+'</h5>\
                            </div>\
                        </div>\
                    </td>\
                    <td class="border-top-0 text-muted px-2 py-4 font-14">'+endereco+'</td>\
                    <td class="border-top-0 px-2 py-4">\
                        <div class="popover-icon" id="particicipantes'+id+'">\
                        '+participantes_ultimos_eventos(id, i, '3', criador_evento)+'\
                        </div>\
                    </td>\
                    <td class="border-top-0 text-center px-2 py-4">'+data+'</td>\
                </tr>');
            }
        }
    });
}

function participantes_ultimos_eventos (id, i, limite, criador_evento){
    var funcao = 'participantes_ultimos_eventos';

    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao, 'id': id, 'limite': limite},
        success: function(dados){
            for(var i=0; i<dados.length; i++){
                var foto = dados[i].foto;
                var nome_json = dados[i].nome;

                var res = nome_json.split(" ");
                var nome = res[0];
                var sobrenome = res[1];
                var array_nome = nome.split("");
                var array_sobrenome = sobrenome.split("");
                var sigla_nome = array_nome[0]+''+array_sobrenome[0];

                const months = ["bg-info", "bg-danger", "bg-success", "bg-warning", "bg-purple", "bg-warning"];

                const random = Math.floor(Math.random() * months.length);
                
                if(i>0){
                    var margin = '-11px';
                }

                if(foto == 'default.png'){
                    $('#particicipantes'+id).append('<a class="btn '+months[random]+' rounded-circle btn-circle font-12 popover-item" style="color: white; width: 55px; height: 55px; line-height: 32px;" href="javascript:void(0)">'+sigla_nome+'</a>');
                } else {
                    $('#particicipantes'+id).append('<a class="" style="margin-left: '+margin+'"><img src="assets/images/fotos/'+foto+'" class="rounded-circle" alt="image" width="55px" height="55px;"></a>');
                }
            }
            if(dados.length > 2){
                $('#particicipantes'+id).append('<button type="button" data-toggle="modal" data-target="#participantes_modal" onclick="listar_todos_participantes('+id+', \'' +criador_evento+ '\')" class="btn btn-secondary btn-circle-lg" style="background-color: #868d92;\
                border-color: #868d92; width: 55px; height: 55px; line-height: 32px; margin-left: -11px;"><i class="fas fa-ellipsis-h"></i></button>');
            }  
        }
    });
    return '';
}

function listar_todos_participantes (id, criador_evento){
    var funcao = 'participantes_ultimos_eventos';
    $('#part_modal').empty();
    
    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'functions.php',
        async: true,
        data: {'funcao': funcao, 'id': id, 'limite': '1000'},
        success: function(dados){
            for(var i=0; i<dados.length; i++){
                var foto = dados[i].foto;
                var nome = dados[i].nome;
                var email = dados[i].email;

                if(email_usuario == email){
                    var voce = 'inline';
                } else {
                    var voce = 'none';
                }

                if(criador_evento == email){
                    var criador = 'inline';
                } else {
                    var criador = 'none';
                }

                $('#part_modal').append('\
                <tr>\
                    <td class="border-top-0 px-2 py-4" style="padding-bottom: 0rem!important;">\
                        <div class="d-flex no-block align-items-center">\
                            <div class="mr-3"><img src="assets/images/fotos/'+foto+'" alt="user" class="rounded-circle" width="45" height="45"></div>\
                            <div class="">\
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">'+nome+'<p style="display:'+voce+'"> (Você)</p></h5>\
                                <span class="text-muted font-14">'+email+'</span><br>\
                                <span class="text-muted font-14" style="display: '+criador+'">Criador do Evento</span>\
                            </div>\
                        </div>\
                    </td>\
                </tr>'); 
            } 
        }
    });
}


