<?php
/*
  
  Created on: 2016
  Author: Mizael Martinez

*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Historial Compresión de Imagenes Astrofísicas</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('css/main.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('css/style.css');?>" rel="stylesheet"/>
	<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/fileinput.min.css');?>" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
 	<script src="<?php echo base_url('js/script.js');?>"></script>

 	<link rel="icon" href="<?php echo base_url('img/icon.png');?>">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <?php 
			if(isset($css_files))
			{
				foreach($css_files as $file): 
		?>
					<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php 
				endforeach;
			}
		?>
		<?php
			if(isset($js_files))
			{
				foreach($js_files as $file): 
		?>
				<script src="<?php echo $file; ?>"></script>
		<?php 
				endforeach; 
			}
		?>
    
  </head>

  <body>
	<!-- Menu -->
	<nav class="menu" id="theMenu">
		<div class="menu-wrap">
			<h1 class="logo"><a href="<?php echo base_url();?>">Compresión</a></h1>
			<i class="fa fa-arrow-right menu-close"></i>
			<a href="<?php echo base_url('');?>">Inicio</a>
			<a href="<?php echo base_url('index.php/Controlador/Historial');?>">Historial</a>
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-envelope"></i></a>
		</div>
		
		<!-- Menu button -->
		<div id="menuToggle"><i class="fa"><img src="<?php echo base_url('img/menu.png');?>"></i></div>
	</nav>
	
	<!-- MAIN IMAGE SECTION -->
	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<h1></h1>
					<h2></h2>
					<div class="spacer"></div>
					<!--<i class="fa fa-angle-down"></i>-->
				</div>
			</div><!-- row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->

	<!--Inicio Historial  -->
	<div id="contenedor">
		<h1>Historial de Compresión</h1>
		<br/><br/><br/>
		<?php 
			if(isset($output))
			{
				echo $output;
			}
		?>
	</div>
	<!--Fin Historial  -->

	
	<!-- CONTACT FOOTER -->
	<div id="cf">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
		        	
				</div><!--col-lg-8-->
				<div class="col-lg-12">
					<p>Teoría de la Información Y Métodos de Codificación</p>
					<p>2016</p>
				</div><!--col-lg-4-->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- Contact Footer -->
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('js/main.js');?>"></script>
	<script src="<?php echo base_url('js/masonry.pkgd.min.js');?>"></script>
	<script src="<?php echo base_url('js/imagesloaded.js');?>"></script>
    <script src="<?php echo base_url('js/classie.js');?>"></script>
	<script src="<?php echo base_url('js/AnimOnScroll.js');?>"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
	<script type="text/javascript">
		var base_url="<?php echo base_url(); ?>";
		var datos=undefined;
		$(document).ready(function(e){
			var id_compresion=<?php echo $id_compresion;?>;
			if(id_compresion>0)
			{
				var peticion=base_url+"index.php/Controlador/comparacion?id_compresion="+id_compresion;
				$.ajax({
					type:"GET",
					async: false,
					cache: false,
	    			dataType: "json",
					url:peticion,
					success: function(data){
						console.log(data);
						datos=data;
						console.log(datos["comparacion"].length);
						if(datos["comparacion"].length===0 || datos["antes_compresion"].length===0)
							return;
						llenarTablas();
						$("#modal_generico").modal("show");
						var cadena="";
						var rlpe="/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/uanl.png";
						if(datos["comparacion"]["rlpe"]["url_"]!=undefined)
							rlpe=datos["comparacion"]["jpeg_ls"]["url_"]+"&url_rlpe="+datos["comparacion"]["rlpe"]["url_"];
						cadena=cadena+"<a target='_blank' href='http://127.0.0.1:8888?url_original="+datos["antes_compresion"]["url_"]+"&url_jpeg_2000="+datos["comparacion"]["jpeg_2000"]["url_"]+"&url_jpeg_ls="+datos["comparacion"]["jpeg_ls"]["url_"]+"&url_rlpe="+rlpe+"' class='btn btn-danger'>Visualizador</a>";
						$("#vidualizador_imagenes").html(cadena);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
	         			
	    			}
				}).always(function() {
	    				
	  			});
				//tabla -> estadisticas
				//tabla -> tamano
				//tabla -> imagenes
			}
		});
		function llenarTablas()
		{
			$("#algoritmo_elegido").html(datos["principal"]);
			$("#tamano_original").html(datos["tamano_original"]);

			$("#tamano_sp").html(datos["antes_compresion"]["tamano"]);
			$("#url_sp").html(generarLink(datos["antes_compresion"]["url"]));

			$("#est_minimo_sp").html(datos["antes_compresion"]["minimo"]);
			$("#est_maximo_sp").html(datos["antes_compresion"]["maximo"]);
			$("#est_promedio_sp").html(datos["antes_compresion"]["promedio"]);
			$("#est_varianza_sp").html(datos["antes_compresion"]["varianza"]);
			$("#est_rms_sp").html(datos["antes_compresion"]["rms"]);
			$("#est_desviacion_sp").html(datos["antes_compresion"]["desviacion"]);

			//console.log(Object.keys(datos["comparacion"]["jpeg_2000"]).length);
			llenarJPEG_2000();
			llenarJPEG_LS();
			llenarRLPE();
		}
		function llenarJPEG_2000()
		{
			if(Object.keys(datos["comparacion"]["jpeg_2000"]).length>0)
			{
				$("#tamano_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["tamano"]);
				$("#url_jpeg_2000").html(generarLink(datos["comparacion"]["jpeg_2000"]["url"]));

				$("#tiempo_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["tiempo"]);

				$("#est_minimo_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["minimo"]);
				$("#est_maximo_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["maximo"]);
				$("#est_promedio_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["promedio"]);
				$("#est_varianza_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["varianza"]);
				$("#est_rms_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["rms"]);
				$("#est_desviacion_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["desviacion"]);

				$("#porcentaje_jpeg_2000").html(datos["comparacion"]["jpeg_2000"]["porcentaje_compresion"]);
			}
		}
		function llenarJPEG_LS()
		{
			if(Object.keys(datos["comparacion"]["jpeg_ls"]).length>0)
			{
				$("#tamano_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["tamano"]);
				$("#url_jpeg_ls").html(generarLink(datos["comparacion"]["jpeg_ls"]["url"]));

				$("#tiempo_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["tiempo"]);

				$("#est_minimo_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["minimo"]);
				$("#est_maximo_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["maximo"]);
				$("#est_promedio_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["promedio"]);
				$("#est_varianza_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["varianza"]);
				$("#est_rms_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["rms"]);
				$("#est_desviacion_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["desviacion"]);

				$("#porcentaje_jpeg_ls").html(datos["comparacion"]["jpeg_ls"]["porcentaje_compresion"]);
			}
		}
		function llenarRLPE()
		{
			if(Object.keys(datos["comparacion"]["rlpe"]).length>0)
			{
				$("#tamano_rlpe").html(datos["comparacion"]["rlpe"]["tamano"]);
				$("#url_rlpe").html(generarLink(datos["comparacion"]["rlpe"]["url"]));

				$("#tiempo_rlpe").html(datos["comparacion"]["rlpe"]["tiempo"]);

				$("#est_minimo_rlpe").html(datos["comparacion"]["rlpe"]["minimo"]);
				$("#est_maximo_rlpe").html(datos["comparacion"]["rlpe"]["maximo"]);
				$("#est_promedio_rlpe").html(datos["comparacion"]["rlpe"]["promedio"]);
				$("#est_varianza_rlpe").html(datos["comparacion"]["rlpe"]["varianza"]);
				$("#est_rms_rlpe").html(datos["comparacion"]["rlpe"]["rms"]);
				$("#est_desviacion_rlpe").html(datos["comparacion"]["rlpe"]["desviacion"]);

				$("#porcentaje_rlpe").html(datos["comparacion"]["rlpe"]["porcentaje_compresion"]);
			}
		}
		function generarLink(url)
		{
			var cadena="<a href='"+url+"' download>Imagen</a>";
			return cadena;
		}
	</script>
	 <!-- Inicio modal generico -->
                <div class="modal fade" id="modal_generico" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">  
                          <button type="button" class="close needsclick" data-dismiss="modal">&times;</button>
                          <h2 class="modal-title" style="color:black;" id="modal_generico_titulo">Comparación</h2>
                        </div>
                        <div class="modal-body">
                          <div id="modal_generico_body">
                          	<p>Algoritmo Elegido por sistema adaptativo: <label id="algoritmo_elegido">-</label></p>
                          	<p>Tamaño Imagen Original (Bytes): <label id="tamano_original">-</label></p>
                          	<br/><br/>
                          	<h4>Comparación Tamaño</h4>
                          	<table class="table ">
								<tr>
									<td class='titulo_table'>Nombre</td>
									<td class='titulo_table'>Sin Procesar</td>
									<td class='titulo_table'>JPEG-2000</td>
									<td class='titulo_table'>JPEG-LS</td>
									<td class='titulo_table'>RLPE</td>
								<tr>
								<tr>
									<td class='titulo_table'>Tamaño (Bytes)</td>
									<td id="tamano_sp">-</td>
									<td id="tamano_jpeg_2000">-</td>
									<td id="tamano_jpeg_ls">-</td>
									<td id="tamano_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>Url</td>
									<td id="url_sp">-</td>
									<td id="url_jpeg_2000">-</td>
									<td id="url_jpeg_ls">-</td>
									<td id="url_rlpe">-</td>
								<tr>

							</table>
							<br/><br/>
							<table class="table ">
								<tr>
									<td>Visualizador de Imagenes: </td>
									<td id="vidualizador_imagenes"></td>
								</tr>
							</table>
							<br/><br/>
                          	<h4>Comparación Tiempo</h4>
                          	<table class="table ">
								<tr>
									<td class='titulo_table'>Nombre</td>
									<td class='titulo_table'>JPEG-2000</td>
									<td class='titulo_table'>JPEG-LS</td>
									<td class='titulo_table'>RLPE</td>
								<tr>
								<tr>
									<td class='titulo_table'>Tiempo (segundos)</td>
									<td id="tiempo_jpeg_2000">-</td>
									<td id="tiempo_jpeg_ls">-</td>
									<td id="tiempo_rlpe">-</td>
								<tr>
							</table>
							<br/><br/>
							<h4>Comparación Estadisticas</h4>
							<table class="table ">
								<tr>
									<td class='titulo_table'>Estadisticas</td>
									<td class='titulo_table'>Sin Procesar</td>
									<td class='titulo_table'>JPEG-2000</td>
									<td class='titulo_table'>JPEG-LS</td>
									<td class='titulo_table'>RLPE</td>
								<tr>
								<tr>
									<td class='titulo_table'>Minimo</td>
									<td id="est_minimo_sp">-</td>
									<td id="est_minimo_jpeg_2000">-</td>
									<td id="est_minimo_jpeg_ls">-</td>
									<td id="est_minimo_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>Máximo</td>
									<td  id="est_maximo_sp">-</td>
									<td  id="est_maximo_jpeg_2000">-</td>
									<td id="est_maximo_jpeg_ls">-</td>
									<td id="est_maximo_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>Promedio</td>
									<td id="est_promedio_sp">-</td>
									<td id="est_promedio_jpeg_2000">-</td>
									<td id="est_promedio_jpeg_ls">-</td>
									<td id="est_promedio_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>Varianza</td>
									<td id="est_varianza_sp">-</td>
									<td id="est_varianza_jpeg_2000">-</td>
									<td id="est_varianza_jpeg_ls">-</td>
									<td id="est_varianza_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>RMS</td>
									<td id="est_rms_sp">-</td>
									<td id="est_rms_jpeg_2000">-</td>
									<td id="est_rms_jpeg_ls">-</td>
									<td id="est_rms_rlpe">-</td>
								<tr>
								<tr>
									<td class='titulo_table'>Desviación</td>
									<td id="est_desviacion_sp">-</td>
									<td id="est_desviacion_jpeg_2000">-</td>
									<td id="est_desviacion_jpeg_ls">-</td>
									<td id="est_desviacion_rlpe">-</td>
								<tr>
							</table>
							<br/><br/>
                          	<h4>Comparación Porcentaje de Compresión</h4>
                          	<table class="table ">
								<tr>
									<td class='titulo_table'>Nombre</td>
									<td class='titulo_table'>JPEG-2000</td>
									<td class='titulo_table'>JPEG-LS</td>
									<td class='titulo_table'>RLPE</td>
								<tr>
								<tr>
									<td class='titulo_table'>Porcentaje (%)</td>
									<td id="porcentaje_jpeg_2000">-</td>
									<td id="porcentaje_jpeg_ls">-</td>
									<td id="porcentaje_rlpe">-</td>
								<tr>
							</table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_generico_aceptar">Aceptar</button>
                        </div>
                      </div>
                    </div>
                </div>
    <!-- Fin modal generico -->

  </body>
</html>
