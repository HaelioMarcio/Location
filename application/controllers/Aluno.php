<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library(array('table'));
		
	}

	public function index()
	{	
		
		$dados = array(
			'title' => 'Todos os alunos',
			);

		$this->load->view('welcome_message', $dados);
	}

	public function consulta_json(){
		
		$this->load->model('aluno_model');
		
		$metodo = $this->input->post('metodo');
		$busca = $this->input->post('busca');

		if($metodo){
			$alunos = $this->aluno_model->consultar_por_coluna($metodo, $busca);
		} else {
			$alunos = $this->aluno_model->consultar_todos();
		}

		$alunos = $alunos->result();

		$this->output->set_content_type('application/json');
		$this->output->set_output("{ \"alunos\":".json_encode($alunos). "}");
		
	}
	public function consultar_por_coluna(){

		$col = $this->input->post('coluna');
		$search = $this->input->post('pesquisa');

		$this->load->model('aluno_model');
		$alunos = $this->aluno_model->consultar_por_coluna($col, $search);
		$alunos = $alunos->result();

		$this->output->set_content_type('application/json');
		$this->output->set_output("{ \"alunos\":".json_encode($alunos). "}");


	}
	public function consultar_aluno(){
		$metodo = $this->input->post();
		$busca = $this->input->post();

		$this->load->model('aluno_model');
	}

	public function add_latlng(){
		
		$id = $this->input->post('id');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');

		$this->load->model('aluno_model');
		$this->aluno_model->add_latlng($id, $lat, $lng);

	}

	public function add_novo(){
		
		$nome = $this->input->post('nome');
		$cpf = $this->input->post('cpf');
		$endereco = $this->input->post('endereco');
		$bairro = $this->input->post('bairro');
		$cidade = $this->input->post('cidade');
		$estado = $this->input->post('estado');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');

		$this->load->model('aluno_model');
		$this->aluno_model->add_novo($nome, $cpf, $endereco, $bairro, $cidade, $estado, $lat, $lng);
		
	}

	public function teste(){

		$this->load->model('aluno_model');
		$dados = array(
			'title' => 'Todos os alunos',
			'alunos' => $this->aluno_model->consultar_todos(),
			);
		$this->load->view('lista_alunos', $dados);
	}



}
