<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Denúncias</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../plugins/pace/pace.min.css">

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    
<script language="JavaScript">
	
	function validarBotao(botao){
		
		 document.form_cat.operacao.value = botao;
		 document.form_cat.submit();
	}


	
  $(document).ready(function(){

    $("#descricao").click(function(){

      $("#sucesso").toggleClass('form-group');
    })
    
    $("#descricao").blur(function(){
     if($(this).val() == "") {

            
        $("#sucesso").removeClass('form-group has-success');
        $("#sucesso").addClass('form-group has-error');
        $("#icone").removeClass('fa fa-check');
        $("#icone").addClass('fa fa-times-circle-o');
             
      }

      else {
    
        $("#sucesso").removeClass('form-group has-error');
        $("#sucesso").addClass('form-group has-success');
        $("#icone").removeClass('fa fa-times-circle-o');  
        $("#icone").addClass('fa fa-check');  
      }

    });
})


  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#output').css({ 'display':'block' });
  };

</script>
    
    
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div>

<form action="../controller/controller_categorias.php" method="post" name="form_cat" id="form_cat" enctype="multipart/form-data">
    
    <input name="operacao" type="hidden" id="operacao" value="nula">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categorias
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastrar Categoria</h3>
        </div>
        <div class="box-body">

       	  <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-6">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i></label>
      	  		<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" />
       	 	</div>
       	  </div>
          
            <br>
            <br>
            <br>
            <br>

           <div class="form-group">
            <div class="col-xs-6">
                  <label for="exampleInputFile">Adicionar Imagem</label>
                  <input type="file" id="exampleInputFile" name="arquivo" title ="Escolher Arquivo" accept="image/*" onchange="loadFile(event)">
                    
                      <img id="output" src="#" alt="" class="margin" style="display:none; max-width: 160px; max-height: 160px; border: none;"/>
                   
            </div>
           </div>

          <br />
          <div class="row">

          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="salvar" onClick="validarBotao('salvar')">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" name="cancelar" onClick="validarBotao('cancelar')">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

	</form>

          </div>

          </div>
            <div class="ajax-content">
            </div>
        </div>
        <!-- /.box-body -->
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>
</body>
</html>
