<?php 
	
	echo "Lista de Alunos";
	//echo $alunos;
	//echo $alunos[1]->MATRICULA;
	
	$this->table->set_heading('QUANT','MATRICULA', 'NOME', 'ENDERECO', 'BAIRRO', 'MUNICIPIO', 'LAT', 'LNG');
	$i = 0;
	foreach ($alunos as $linha) {
		$this->table->add_row(array($i, $linha->MATRICULA, $linha->NOME, $linha->ENDERECO, $linha->BAIRRO, $linha->MUNICIPIO, $linha->LAT, $linha->LNG));
		$i++;
	}

	
	
	

	echo $this->table->generate();


 ?>