<?php

	 // PEGANDO OS DADOS DO FORMULÁRIO
	 $tipo = $_POST['tipo'];
	 $produto = $_POST['produto'];
	 $assistido = $_POST['assistido'];
	 $doador = $_POST['doador'];
	 $quantidade = $_POST['quantidade'];
	 $dataCadastro = $_POST['data'];
     $usuario = $_POST['usuario'];

	//PEGANDO O NOME DOS PRODUTOS PARA LISTAGEM
	$url = "http://localhost:8080/restmongo/rest/produto/procurarNome/$produto";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$prodt = json_decode($data);

if (($tipo == 1) && ($quantidade > $prodt[0]->quantidade)) {
	print "<script> alert('ERRO! Quantidade indisponível.'); window.history.go(-1); </SCRIPT>\n";
	exit;
} else if ($tipo == 2) {
	$idnt = $prodt[0]->id;
	$qtd = $prodt[0]->quantidade + $quantidade;
	$date = array("id" => "$idnt", "nome" => "$produto", "quantidade" => "$qtd");
	$date_string = json_encode($date);
	$ch = curl_init('http://localhost:8080/restmongo/rest/produto/');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $date_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($date_string))
	);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$result = curl_exec($ch);	
	curl_close($ch);
} else {
	$idnt = $prodt[0]->id;
	$qtd = $prodt[0]->quantidade - $quantidade;
	$date = array("id" => "$idnt", "nome" => "$produto", "quantidade" => "$qtd");
	$date_string = json_encode($date);
	$ch = curl_init('http://localhost:8080/restmongo/rest/produto/');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $date_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($date_string))
	);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$result = curl_exec($ch);	
	curl_close($ch);
};


if(empty($id))
	{
		$data = array("produto" => "$produto", "assistido" => "$assistido", "doador" => "$doador", "data" => "$dataCadastro", "quantidade" => "$quantidade", "tipo" => "$tipo", "usuario" => "$usuario");
	} else {
		$data = array("id" => "$id", "produto" => "$produto", "assistido" => "$assistido", "doador" => "$doador", "data" => "$dataCadastro", "quantidade" => "$quantidade", "tipo" => "$tipo", "usuario" => "$usuario");
};

$data_string = json_encode($data);

$ch = curl_init('http://localhost:8080/restmongo/rest/estoque/');
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
	print "<script> alert('Registro inserido com sucesso.'); window.history.go(-1);</SCRIPT>\n";
};
	
curl_close($ch);
?>
