<?php

	 // PEGANDO OS DADOS DO FORMULÁRIO
	 $nome = $_POST['nomeProduto'];

	//PEGANDO O NOME DOS PRODUTOS PARA LISTAGEM
	$url = "http://localhost:8080/restmongo/rest/produto/listarTudo";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$prodt = json_decode($data);

	foreach($prodt as $lista) {
			$prodtNome = isset($lista->nome);
		if ($nome == $prodtNome) {
			print "<script> alert('ERRO! Produto já existente.'); window.history.go(-1);</SCRIPT>\n";
			exit;
		}
	};		

if(empty($id))
	{
		$data = array("quantidade" => "0", "nome" => "$nome");
	} else {
		$data = array("id" => "$id", "quantidade" => "$quantidade", "nome" => "$nome");
};

$data_string = json_encode($data);

$ch = curl_init('http://localhost:8080/restmongo/rest/produto/');
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
