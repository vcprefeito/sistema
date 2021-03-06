<?php

require_once('../model/model_categorias.php');

require_once("../session.php");
  
require_once("../class.user.php");
$auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<script>
    
      $(function(){
        tabela = $('#tabelaDenuncias').DataTable({
          "ajax": {
            "url": 'controller/controller_denuncias.php',
            "data": {operacao: "Denuncias"},
            "type": "POST"
          },
          "language": {
            "url": "plugins/datatables/pt-br.json"
          },
          "columns": [
             {
              "data": null,
              "width": "5%",
              "targets": -1,
              "defaultContent": `
                <a class="btn btn-success" id="editarlink"><em class="fa fa-pencil"></em></a>
              `
            },  
            {"data": "id_den", 
             "width": "1%"},
              {"data": "data_den", 
             "width": "10%"},
            {"data": "rua_den", 
             "width": "30%"}, 
           
               {"data": "cidade_den", 
             "width": "20%"},
              
              {"data": "desc_categoria", 
             "width": "20%"},
              
              {"data": "status_den", 
             "width": "40%"}
              
          ]
        })
        
         $("#tabelaDenuncias tbody").on('click', 'a#editarlink', function(){
             data = tabela.row( $(this).parents('TR') ).data();
            validarExclusao(data.id_den);
         });

      });
    
    function validarExclusao(id){	
        bootbox.confirm({
            title: "Alterar Status",
            message: "Você deseja alterar o status da denúncia " + id + "?",
            buttons: {
            cancel: {
                    label: '<i class="fa fa-times"></i> Cancelar'
                },
            confirm: {
                    label: '<i class="fa fa-check"></i> Confirmar'
                }
            },
            
            callback: function (result) {
              
                if(result == true){
                    $.ajax({
                      type: "POST",
                      url: 'controller/controller_denuncias.php',
                      dataType: 'json',    
                      data: {operacao : "alterarDenuncias", denuncia : id},

                    });
                    changePage('view/denuncias.php');
                }
                
                else return
             }
        });
    }
    
    
    
function validarBotao(botao){
		
		 document.form_den.operacao.value = botao;
		 document.form_den.submit();
	}    
    
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="O seu navegador não suporta Geolocalização.";}
  }
function showPosition(position)
  {
  x.innerHTML= position.coords.latitude + "/" + position.coords.longitude; 
  }
    
    //CONFIGURAÇÕES CALENDÁRIO
        $(".dropdown-menu li a").click(function(){
            var selText = $(this).text();
            $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });
        
        $(function(){
          
        $.fn.datepicker.dates['pt'] = {
            days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
            daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            clear: "Limpar",
            format: "dd/mm/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
          
          $('#datetimepicker4').datepicker({
            language: 'pt'
          });
            
        });
    //FIM CONFIG CALENDARIO
    
</script>

<div>

<form method="post" name="form_den" id="form_den" action="controller/controller_denuncias.php">
  <!-- Content Wrapper. Contains page content -->
     <input name="operacao" type="hidden" id="operacao" value="nula">
  <div class="content">
    <!-- Content Header (Page header) -->

      <!-- Default box -->
      <?php if(($userRow['user_tipo'] == 'g')){ ?>
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Denúncia</h3>
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="">
                  <i class="fa fa-minus"></i></button>
        </div>
          </div>
          
        <div class="box-body">
          
          <br />
       
      <div class="form-group">
            <div class="col-xs-2">
                <label>Date:</label>
               <div class='input-group date' id='datetimepicker1'>
                    <input type='date' date-provider="date" class="form-control" id='datetimepicker4' name="data"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
                <!-- /.input group -->
              </div>

       	  	<br />
			<br />
               <br />
            
       	  <div class="form-group">
       	  	<div class="col-xs-4"> 
      	  		  <label>Categoria</label>
                <select class="form-control select2" name="categoria" style="width: 100%;">
                  <option selected="selected"></option>
                
                <?php 
                    
                    $categoria = new Categoria();

                    $resultado = $categoria->listar();
                    
                    foreach($resultado as $registro) {  ?>

                    <option value="<?php echo $registro['id_categoria']?>"><?php echo $registro['desc_categoria']?></option>
                                                      
         <?php     }  ?>   
                    
                </select>
       	 	</div>
       	  </div>
            
             <br />
       	  <br />
            <br />
            
              <div class="form-group">
       	 	 <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label">Endereço</label>
                 <input type="text" class="form-control input-md" name="endereco" id="endereco" placeholder="" value="" />               
       	 	</div>
                   <div class="col-xs-1">
              <label class="" for="inputSuccess" id="label">Número</label>
                 <input type="text" class="form-control input-md" name="numero" id="numero" placeholder="" value="" />               
       	 	</div>
                       <div class="col-xs-2">
              <label class="" for="inputSuccess" id="label">Cidade</label>
                 <input type="text" class="form-control input-md" name="cidade" id="cidade" placeholder="" value="" />               
       	 	</div>
                  
       	  </div>
            
  
       	  <br />
       	  <br />
            <br />

       	  <div class="form-group">
       	 	 <div class="col-xs-6">
                 <label>Descrição</label>
      	  		<textarea class="form-control" rows="3" placeholder="" id="demo" value="teste"></textarea>
       	 	</div>
       	  </div>

          <br />        
          <br />
          <br /> 
            <br />
            
          <div class="row">
          <!--<div class="col-xs-12 text-center">
          <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Salvar
          </button>
          </div>-->
          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="btn-salvar" onclick="validarBotao('salvar')">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar" onclick="validarBotao('cancelar')">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

            </div>
            </div>
          </div>
      <?php } ?>
      
     
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Denúncias Realizadas
                <small>&nbsp;</small>
              </h3>
            </div>

            <div class="box-body pad">
              
            <table id="tabelaDenuncias" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th><p align="center"><em class="fa fa-cog" style=" width : 10px"></em></p></th>    
                    <th>Código</th>
                    <th>Data</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Categoria</th>
                    <th>Status</th>
                </tr>
              </thead>
            </table>
            </div>
          </div>
      
      
        </div>
	</form>

</div>