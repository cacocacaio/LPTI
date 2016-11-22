<?php

	 // PEGANDO OS DADOS DO FORMULÁRIO
	 $id = $_GET['id'];
	 $tipo = $_POST['tipo'];
	 $nome = $_POST['nome'];
	 $descricao = $_POST['descricao'];
	 $membro = $_POST['membro'];
	 $frequencia = $_POST['frequencia'];
	 $data = $_POST['data'];
     $usuario = $_POST['usuario']

if(empty($id))
	{
		$data = array("nome" => "$nome", "descricao" => "$descricao", "membro" => "$membro", "data" => "$data", "frequencia" => "$frequencia", "tipo" => "$tipo", "usuario" => "$usuario");
	} else {
		$data = array("id" => "$id", "nome" => "$nome", "descricao" => "$descricao", "membro" => "$membro", "data" => "$data", "frequencia" => "$frequencia", "tipo" => "$tipo", "usuario" => "$usuario");
};

$data_string = json_encode($data);

$ch = curl_init('http://localhost:8080/restmongo/rest/evento/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result = curl_exec($ch);

if ($result === false) {
	print "<script> alert('ERRO!'); window.history.go(-1); </SCRIPT>\n";
} else {
	print "<script> alert('Registro inserido com sucesso.'); window.history.go(-1); </SCRIPT>\n";
};
	
curl_close($ch);
?>
