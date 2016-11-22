<?php

//PEGANDO O NOME DOS MEMBROS PARA LISTAGEM
$url = 'http://localhost:8080/restmongo/rest/produto/listarTudo';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$array = json_decode($data);
$produto = array_reverse($array);

?>


					<div id="conteudo">
						
						<div class="col-md-4" id="formulario">
							
							<div class="row">
								
								<div class="col-md-12">
									
									<h1 class="text-center">INSERIR PRODUTO</h1>
									<br>
								</div>
							</div>
							
							<div class="row">
								
								<div class="col-md-12">
									
									<form method="post" action="addProduto.php" name="realizarDoacao" class="form-horizontal text-left" role="form" onSubmit="return verificaDoacao()">
										
										<div class="form-group">
											
											<div class="col-sm-2">
												
												<label for="inputEmail3" class="control-label">Nome</label>
											</div>
											
											<div class="col-sm-10">
												
												<input name="nomeProduto" type="text" class="form-control input-lg" id="inputPassword3" placeholder="Qual o nome do produto que deseja criar?">
											</div>
										</div>
										
										<div class="row">
											
											<div class="col-md-6 text-center">
												
												<button type="submit" class="btn btn-lg btn-success" href="telaPrincipal.php">Confirma</button>
											</div>
											
											<div class="col-md-6 text-center">
												
												<a class="btn btn-danger btn-lg" href="telaPrincipal.php">Cancela</a>
											</div>
										</div>
									</form>
			
				<div class="row">
				  <div class="col-md-12">
					<h1 class="text-center">PRODUTOS</h1>
<br>
				  </div>
				</div>
				<table class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <th class="info">Produto</th>
					  <th class="info">Quantidade</th>
					  <th class="info">Excluir</th>
					  <th class="info">Editar</th>
					</tr>
				  </thead>
				  <tbody>
<?php foreach($produto as $lista){ ?>
											<tr>
													<td><?php echo $lista->nome ?></td>
													<td><?php echo $lista->quantidade ?></td>
													<td>
															<a href="delete.php?id=<?php echo "produto/deletar/".$lista->id ?>" onclick="return confirm('Deseja realmente excluir esse registro?') ;"> Excluir</a>
</td>
<td>
															<a href="editarEstoque.php?id=<?php echo $lista->id ?>"> Editar</a>
													</td>
											</tr>
									<?php }; ?>
				  </tbody>
				</table>
			  </div>
			</div>
        </div>
      </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
