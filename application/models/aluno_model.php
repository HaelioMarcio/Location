<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends CI_Model {

	public function consultar_por_coluna($coluna, $busca){
		$this->db->select('*');
		$this->db->from('matricula');
		$this->db->like($coluna, $busca);
		return $this->db->get();
	}

	public function consultar_todos(){
		return $this->db->get('matricula');
	}

	public function add_latlng($id, $lat, $lng){
		
		$this->db->query('UPDATE MATRICULA set lat = '.$lat.', lng = '.$lng.' WHERE matricula = '.$id);
	}

	public function add_novo($nome, $cpf, $endereco, $bairro, $cidade, $estado, $lat, $lng){
		$this->db->query("INSERT INTO MATRICULA(NOME, CPF, ENDERECO, BAIRRO, MUNICIPIO, ESTADO, LAT, LNG) values('".$nome."', '".$cpf."','".$endereco."','".$bairro."','".$cidade."', '".$estado."', '".$lat."', '".$lng."')");
	}
}
