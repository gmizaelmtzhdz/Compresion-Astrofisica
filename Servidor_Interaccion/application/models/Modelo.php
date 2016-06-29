<?php 
class Modelo extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function obtener_reg($tabla,$condicion,$nreg,$nini)
	{
		if($nreg!=null && $nini!=null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion,$nreg,$nini);
		}elseif($nreg!=null && $nini!=null && $condicion==null){
				$query = $this->db->get($tabla,$nreg,$nini);
		
		}elseif($nreg==null && $nini==null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion);
		}else{
			$query = $this->db->get($tabla);
		}
		return $query->result();
	}
	function obtener_reg_distinct($tabla,$condicion,$nreg,$nini,$campo)
	{
		$this->db->distinct($campo);
		if($nreg!=null && $nini!=null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion,$nreg,$nini);
		}elseif($nreg!=null && $nini!=null && $condicion==null){
				$query = $this->db->get($tabla,$nreg,$nini);
		
		}elseif($nreg==null && $nini==null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion);
		}else{
			$query = $this->db->get($tabla);
		}
		return $query->result();
	}
	function obtener_regs($tabla,$condicion,$nreg,$nini,$distinct)
	{
		if($nreg!=null && $nini!=null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion,$nreg,$nini);
		}elseif($nreg!=null && $nini!=null && $condicion==null){
				$query = $this->db->get($tabla,$nreg,$nini);
		
		}elseif($nreg==null && $nini==null && $condicion!=null){
			$query = $this->db->get_where($tabla,$condicion);
		}else{
			
			$this->db->group_by($distinct);
			$this->db->distinct();
			$query = $this->db->get($tabla);
		}
		return $query->result();
	}
	function numregs($tabla){
		$query=$this->db->count_all_results($tabla);
		return $query;
	}
	
	function cuantoshay($tabla,$condicion){
		$this->db->where($condicion);
		$this->db->from($tabla);
		$r=$this->db->count_all_results();
		return $r;
	}
	
	function agregar_reg($tabla,$datos)
	{
		$this->db->insert($tabla, $datos);
	} 
	
	function editar_reg($tabla,$datos,$campo,$valorCampo)
	{
		$this->db->where($campo,$valorCampo);
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}
	
	function editar_horaSalida($tabla,$datos,$campo,$valor)
	{
		/*
		$this->db->where($campo,$valor);
		$this->db->where("horasalida","");
		$this->db->where("estado","enproceso");
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
		*/
		$this->db->where($campo,$valor);
		$this->db->where("estatus","En transito");
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}
	function editar_Incidentes($tabla,$datos,$campo,$valor)
	{
		$this->db->where($campo,$valor);
		$this->db->where("estado","enproceso");
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}
	function editar_Coordenadas($tabla,$datos,$campo,$valor)
	{
		/*
		$this->db->where($campo,$valor);
		$this->db->where("estado","enproceso");
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
		*/
		$this->db->where($campo,$valor);
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}	
	function finalizarFleteIndividual($tabla,$datos,$campo,$valor)
	{
		/*
		$this->db->where($campo,$valor);
		$this->db->where("estado","enproceso");
		$this->db->where("id",$id_pedido);
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
		*/
		$this->db->where($campo,$valor);
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}
	function finalizarRecorrido($tabla,$datos,$campo,$valor)
	{
		$this->db->where("estatus","En transito");
		$this->db->where($campo,$valor);
		$this->db->update($tabla,$datos);
		return $this->db->affected_rows();
	}
	function eliminar_registro($tabla,$datos)
	{
		$this->db->delete($tabla,$datos); 
		return $this->db->affected_rows();
	}
	function obtener_reg_unidades($id_negocio)
	{ 
		return $this->db->query("SELECT tipo_unidad.tipo,capacidad,estatus,unidad.descripcion,estatus FROM unidad,tipo_unidad WHERE unidad.id_tipo=tipo_unidad.id_tipo_unidad AND tipo_unidad.id_usuario=".$id_negocio." AND unidad.id_usuario=".$id_negocio)->result();
	}
}
?>