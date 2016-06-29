<?php
/*
  
  Created on: 2016
  Author: Mizael Martinez

*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("Modelo");
		$this->load->helper('url');
		$this->load->library('Grocery_CRUD');
		$this->load->model('grocery_crud_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('date'); 
		$this->load->helper("email");
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->output->cache(0);
	}
	public function index()
	{
		$this->Inicio();
		#$this->Historial();
	}
	public function cargarVista($vista,$output=null)
	{
		$this->load->view($vista,$output);
	}
	public function Inicio()
	{
		$this->cargarVista("Inicio",null);
	}
	public function obtenerInformacionJPEG_2000($id_pendientes,$tamano)
	{
		$resultado=array();
		$fila=$this->Modelo->obtener_reg("compresion",array("id_pendientes"=>$id_pendientes,"algoritmo"=>"jpeg-2000"),null,null);
		if(count($fila)>0)			
		{
			$id_imagen=$fila[0]->id_imagen;
			$fila_imagen=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$id_imagen),null,null);
			if(count($fila_imagen)>0)
			{
				$id_estadisticas=$fila_imagen[0]->id_estadisticas;
				$fila_estadisticas=$this->Modelo->obtener_reg("estadisticas",array("id_estadisticas"=>$id_estadisticas),null,null);
				if(count($fila_estadisticas)>0)
				{
					$arreglo=array();
					$arreglo["id_compresion"]=$fila[0]->id_compresion;
					$arreglo["id_imagen"]=$id_imagen;
					$arreglo["id_estadisticas"]=$id_estadisticas;
					$arreglo["algoritmo"]=$fila[0]->algoritmo;
					$arreglo["tiempo"]=$fila[0]->tiempo;
					$arreglo["compresion_principal"]=$fila[0]->compresion_principal;
					$arreglo["url"]=base_url("assets/uploads/files/".$fila_imagen[0]->url);
					$arreglo["url_"]="/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/".$fila_imagen[0]->url;
					$arreglo["tamano"]=$fila_imagen[0]->tamano;

					$arreglo["minimo"]=$fila_estadisticas[0]->minimo;
					$arreglo["maximo"]=$fila_estadisticas[0]->maximo;
					$arreglo["promedio"]=$fila_estadisticas[0]->promedio;
					$arreglo["varianza"]=$fila_estadisticas[0]->varianza;
					$arreglo["rms"]=$fila_estadisticas[0]->rms;
					$arreglo["desviacion"]=$fila_estadisticas[0]->desviacion;

					$arreglo["porcentaje_compresion"]=100-floatval((intval($fila_imagen[0]->tamano)*100)/$tamano);

					$resultado=$arreglo;
				}
			}
		}
		return $resultado;
	}
	public function obtenerInformacionJPEG_LS($id_pendientes,$tamano)
	{
		$resultado=array();
		$fila=$this->Modelo->obtener_reg("compresion",array("id_pendientes"=>$id_pendientes,"algoritmo"=>"jpeg-ls"),null,null);
		if(count($fila)>0)			
		{
			$id_imagen=$fila[0]->id_imagen;
			$fila_imagen=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$id_imagen),null,null);
			if(count($fila_imagen)>0)
			{
				$id_estadisticas=$fila_imagen[0]->id_estadisticas;
				$fila_estadisticas=$this->Modelo->obtener_reg("estadisticas",array("id_estadisticas"=>$id_estadisticas),null,null);
				if(count($fila_estadisticas)>0)
				{
					$arreglo=array();
					$arreglo["id_compresion"]=$fila[0]->id_compresion;
					$arreglo["id_imagen"]=$id_imagen;
					$arreglo["id_estadisticas"]=$id_estadisticas;
					$arreglo["algoritmo"]=$fila[0]->algoritmo;
					$arreglo["tiempo"]=$fila[0]->tiempo;
					$arreglo["compresion_principal"]=$fila[0]->compresion_principal;
					$arreglo["url"]=base_url("assets/uploads/files/".$fila_imagen[0]->url);
					$arreglo["url_"]="/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/".$fila_imagen[0]->url;
					$arreglo["tamano"]=$fila_imagen[0]->tamano;

					$arreglo["minimo"]=$fila_estadisticas[0]->minimo;
					$arreglo["maximo"]=$fila_estadisticas[0]->maximo;
					$arreglo["promedio"]=$fila_estadisticas[0]->promedio;
					$arreglo["varianza"]=$fila_estadisticas[0]->varianza;
					$arreglo["rms"]=$fila_estadisticas[0]->rms;
					$arreglo["desviacion"]=$fila_estadisticas[0]->desviacion;

					$arreglo["porcentaje_compresion"]=100-floatval((intval($fila_imagen[0]->tamano)*100)/$tamano);
					$resultado=$arreglo;
				}
			}
		}
		return $resultado;
	}
	public function obtenerInformacionRLPE($id_pendientes,$tamano)
	{
		$resultado=array();
		$fila=$this->Modelo->obtener_reg("compresion",array("id_pendientes"=>$id_pendientes,"algoritmo"=>"rlpe"),null,null);
		if(count($fila)>0)			
		{
			$id_imagen=$fila[0]->id_imagen;
			$fila_imagen=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$id_imagen),null,null);
			if(count($fila_imagen)>0)
			{
				$id_estadisticas=$fila_imagen[0]->id_estadisticas;
				$fila_estadisticas=$this->Modelo->obtener_reg("estadisticas",array("id_estadisticas"=>$id_estadisticas),null,null);
				if(count($fila_estadisticas)>0)
				{
					$arreglo=array();
					$arreglo["id_compresion"]=$fila[0]->id_compresion;
					$arreglo["id_imagen"]=$id_imagen;
					$arreglo["id_estadisticas"]=$id_estadisticas;
					$arreglo["algoritmo"]=$fila[0]->algoritmo;
					$arreglo["tiempo"]=$fila[0]->tiempo;
					$arreglo["compresion_principal"]=$fila[0]->compresion_principal;
					$arreglo["url"]=base_url("assets/uploads/files/".$fila_imagen[0]->url);
					$arreglo["url_"]="/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/".$fila_imagen[0]->url;
					$arreglo["tamano"]=$fila_imagen[0]->tamano;

					$arreglo["minimo"]=$fila_estadisticas[0]->minimo;
					$arreglo["maximo"]=$fila_estadisticas[0]->maximo;
					$arreglo["promedio"]=$fila_estadisticas[0]->promedio;
					$arreglo["varianza"]=$fila_estadisticas[0]->varianza;
					$arreglo["rms"]=$fila_estadisticas[0]->rms;
					$arreglo["desviacion"]=$fila_estadisticas[0]->desviacion;

					$arreglo["porcentaje_compresion"]=100-floatval((intval($fila_imagen[0]->tamano)*100)/$tamano);
					$resultado=$arreglo;
				}
			}
		}
		return $resultado;
	}
	public function antesCompresion($id_pendientes)
	{
		$resultado=array();
		$fila=$this->Modelo->obtener_reg("proceso",array("id_pendientes"=>$id_pendientes),null,null);
		if(count($fila)>0)			
		{
			$id_estadisticas=$fila[0]->id_estadisticas;
			$fila_estadisticas=$this->Modelo->obtener_reg("estadisticas",array("id_estadisticas"=>$id_estadisticas),null,null);
			if(count($fila_estadisticas)>0)
			{
				$arreglo=array();
				$arreglo["id_proceso"]=$fila[0]->id_proceso;
				$arreglo["url"]=base_url("assets/uploads/files/".$fila[0]->url);
				$arreglo["url_"]="/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/".$fila[0]->url;
				$arreglo["tamano"]=$fila[0]->tamano;
				
				$arreglo["minimo"]=$fila_estadisticas[0]->minimo;
				$arreglo["maximo"]=$fila_estadisticas[0]->maximo;
				$arreglo["promedio"]=$fila_estadisticas[0]->promedio;
				$arreglo["varianza"]=$fila_estadisticas[0]->varianza;
				$arreglo["rms"]=$fila_estadisticas[0]->rms;
				$arreglo["desviacion"]=$fila_estadisticas[0]->desviacion;
				$resultado=$arreglo;
			}
		}
		return $resultado;
	}
	public function comparacion()
	{
		$resultado["resultado"]=false;
		$resultado["comparacion"]=array();
		$resultado["antes_compresion"]=array();
		$resultado["principal"]="";
		$resultado["tamano_original"]="";
		if($this->input->get("id_compresion"))
		{
			$resultado["resultado"]=true;
			$fila=$this->Modelo->obtener_reg("compresion",array("id_compresion"=>$this->input->get("id_compresion")),null,null);
			if(count($fila)>0)			
			{
				$id_pendientes=$fila[0]->id_pendientes;
				$pendientes=$this->Modelo->obtener_reg("pendientes",array("id_pendientes"=>$id_pendientes),null,null);
				if(count($pendientes)>0)
				{
					$id_imagen=$pendientes[0]->id_imagen;
					$imagen=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$id_imagen),null,null);
					if(count($imagen)>0)
					{
						$tamano=$imagen[0]->tamano;
						$resultado["principal"]=$fila[0]->algoritmo;
						$resultado["tamano_original"]=$tamano+" Bytes";
						$resultado["antes_compresion"]=$this->antesCompresion($id_pendientes);
						$resultado["comparacion"]["jpeg_2000"]=$this->obtenerInformacionJPEG_2000($id_pendientes,$tamano);
						$resultado["comparacion"]["jpeg_ls"]=$this->obtenerInformacionJPEG_LS($id_pendientes,$tamano);
						$resultado["comparacion"]["rlpe"]=$this->obtenerInformacionRLPE($id_pendientes,$tamano);
					}
				}
			}
		}
		echo json_encode($resultado);
	}
	public function Historial($id=-1)
	{
		#$this->obtenerInformacionJPEG_2000($id,300000);
		$output=null;
		try{
			$crud = new Grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('vista_historial');
			$crud->set_primary_key('id_compresion');
			$crud->columns('fecha_hora','algoritmo','url');
			$crud->display_as('fecha_hora','Fecha');
			$crud->display_as('url','Imagen');
			$crud->set_field_upload('url','assets/uploads/files');
			$crud->unset_fields("id_compresion","hora_unix");

			$crud->unset_export();
			$crud->unset_print();

			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();

			$crud->add_action('Comparación', '', 'Controlador/Historial','ui-icon-plus');

			$crud->callback_column('menu_title',array($this,'_callback_webpage_url'));

			$output = $crud->render();

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		$output->id_compresion=$id;
		$this->cargarVista("Historial",$output);
	}
	public function _callback_webpage_url($value, $row)
	{
	  return "<a href='".$row->id."'>$value</a>";
	}
	public function cargarImagen()
	{
		$parametro=-1;
		$sesion_creada = array('sesion'  => time(),
								'estado'=>"-1",
								'id_pendientes' => "-1",
								'mensaje'=>""
								);
		try
		{
			$config['upload_path'] = './assets/uploads/files/';
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$sesion_creada["mensaje"]="Hubo un error verifica que la imagen cumple con los formatos definidos anteriormente: ".$this->upload->display_errors();
				$sesion_creada["estado"]=1;
				$parametro=1;	
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				echo var_dump($data);
				$nombre=$data["upload_data"]["full_path"];
				$nombre=explode("/",$nombre);
				$nombre=$nombre[count($nombre)-1];
				$tamano=floatval($data["upload_data"]["file_size"])*1024;
				$this->Modelo->agregar_reg("imagen",array("id_estadisticas"=>0,"url"=>$nombre,"tamano"=>$tamano));
				$id_imagen=$this->db->insert_id();
				echo "id_imagen: ".$id_imagen;
				$unix=time();
				$fecha=date("Y-m-d H:i:s",$unix);  
				$this->Modelo->agregar_reg("pendientes",array("id_imagen"=>$id_imagen,"hora_unix"=>$unix,"fecha_hora"=>$fecha,"estatus"=>"abierto"));
				$id_pendientes=$this->db->insert_id();
				$sesion_creada["id_pendientes"]=$id_pendientes;
				$sesion_creada["mensaje"]="";
				$sesion_creada["estado"]=2;
				$parametro=2;
			}
		}catch(Exception $e){
			$parametro=3;
		}
		$this->session->set_userdata($sesion_creada);
		redirect(site_url('#estado'));
	}
	public function notificaciones()
	{
		$resultado["resultado"]=false;
		$resultado["listo"]=false;
		$resultado["url_imagen"]="";
		$resultado["nombre_imagen"]="";
		$resultado["tamano"]="";

		if($this->input->get("id_pendientes"))
		{
			$resultado["resultado"]=true;		
			$pendientes=$this->Modelo->obtener_reg("pendientes",array("id_pendientes"=>$this->input->get("id_pendientes"),"estatus"=>"cerrado"),null,null);
			#echo var_dump($pendientes);
			if(count($pendientes)>0)
			{
				$compresion=$this->Modelo->obtener_reg("compresion",array("id_pendientes"=>$pendientes[0]->id_pendientes,"compresion_principal"=>"principal"),null,null);
				if(count($compresion)>0)
				{
					$imagen=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$compresion[0]->id_imagen),null,null);
					if(count($imagen)>0)
					{
						$id_imagen_original=$pendientes[0]->id_imagen;
						$imagen_original=$this->Modelo->obtener_reg("imagen",array("id_imagen"=>$id_imagen_original),null,null);
						if(count($imagen_original)>0)
						{
							$resultado["listo"]=true;
							$resultado["id_compresion"]=$compresion[0]->id_compresion;
							$nombre=base_url("assets/uploads/files/".$imagen[0]->url);
							$resultado["url_imagen"]=$nombre;
							$resultado["nombre_imagen"]=$nombre;
							$resultado["tamano"]=$imagen[0]->tamano;

							$nombre_original=base_url("assets/uploads/files/".$imagen_original[0]->url);
							$resultado["url_imagen_original"]=$nombre_original;
							$resultado["nombre_imagen_original"]=$nombre_original;
							$resultado["tamano_original"]=$imagen_original[0]->tamano;
						}
					}
				}
			}
		}
		echo "callbacknotificaciones(".json_encode($resultado).")";
	}
}

?>