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
    <meta name="description" content="Compresión de imagenes astrofisicas">
    <meta name="author" content="Mizael Martinez">
	<meta name="keywords" content="compression, JPEG-2000, JPEG-LS">

    <title>Compresión de Imagenes Astrofísicas</title>

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
    <script src="<?php echo base_url('js/fileinput.min.js');?>"></script>
    <script src="<?php echo base_url('js/fileinput_locale_es.js');?>"></script>
 	<script src="<?php echo base_url('js/script.js');?>"></script>

 	<link rel="icon" href="<?php echo base_url('img/icon.png');?>">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <style type="text/css">
    #modal_generico_body{text-align: center;}
    </style>
    
  </head>

  <body>
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
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="modal_generico_ver">Ver Comparación Detallado</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_generico_aceptar">Aceptar</button>
                        </div>
                      </div>
                    </div>
                </div>
    <!-- Fin modal generico -->
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

	<!--Inicio Compresión  -->
	<div id="contenedor">
		<h1>Compresión de Imagenes Astrofísicas</h1>
		<br/><br/>
		<p>Elije una imagen para comprimir, los formatos soportados son: </p>
		<ul>
			<li>PNG</li>
			<li>GIF</li>
			<li>JPG</li>
			<li>JPEG</li>
			<li>JPEG-2000</li>
			<li>JPEG-LS</li>
			<li>BMP</li>
		</ul>
		<a name="estado"></a> 
		<?php
		#1->formato incorrecto
		#2->carga completa
		if($this->session->userdata("id_pendientes"))
		{
			#echo var_dump($this->session->userdata("id_pendientes"));
			#echo var_dump($this->session->userdata("estado"));
			switch($this->session->userdata("estado"))
			{
				case 1:
		?>
					<div id="error">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Error: </strong>
							<?php 
								echo $this->session->userdata('mensaje');
							?>
						</div>
					</div>
		<?php
					break;
				case 2:
		?>
					<script type="text/javascript">
						$(document).ready(function(e){
							var objeto=new Notificacion();
							objeto.setUrl("<?php echo base_url('index.php/Controlador/');?>/");
							objeto.eventos_();
							objeto.iniciarNotificacion(<?php echo $this->session->userdata("id_pendientes");?>);
						});
					</script>

					<!-- Inicio Exito -->
						<div id="exito">
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Procesando </strong> Su imagen esta siendo procesada, espere un momento
							</div>
							<p></p>
							<img src="<?php echo base_url('img/cargar.gif');?>" class='img-responsive imagen' />
						</div>
					<!-- Inicio Exito -->
		<?php
					break;
			}
		}
		?>
					<!-- Inicio Cargar archivos al servidor -->
				 		<div id="cargar_imagen">
				 				<?php echo form_open_multipart('Controlador/cargarImagen');?>
				 					<input type="file" name="userfile" id="imagen" required class="file-loading" />
				 					<!--<input type="submit" value="Subir" class='btn subir btn-primary'/>-->
				 				</form>
				 		</div>
			 		<!-- Inicio Cargar archivos al servidor -->

	</div>
	<!--Fin Compresión  -->

	
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
	<script type="text/javascript">
		    $("#imagen").fileinput({
		    	language: "es",
		        browseLabel: 'Seleccionar Imágen',
		        allowedFileExtensions: ["jpg","jpeg", "png", "gif","jp2","bmp","jls"]
		    });
	</script>
  </body>
</html>
