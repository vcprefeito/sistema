<?php

require_once('../model/model_categorias.php');


?>

 <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
        </script>

<div>

<form method="post" action="controller/controller_denuncias.php">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Consultar denúncia</h3>
        </div>
        <div class="box-body">
          
          <br />
       
      <div class="form-group">
            <div class="col-xs-2">
                <label>Date:</label>
               <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" id='datetimepicker4'/>
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
                <select class="form-control select2" name="combobox" style="width: 100%;">
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
       	 	 <div class="col-xs-6">
                 <label>Descrição</label>
      	  		<textarea class="form-control" rows="3" placeholder=""></textarea>
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
          		<button type="submit" class="btn btn-default btn-lrg" name="btn-salvar">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

            </div>
            </div>
          </div>
      
      
        </div>
	</form>

          </div>

       

