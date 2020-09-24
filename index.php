<?php

//Require conexão com banco
require_once 'conecta.php';

//sql para busca dos produtos
$valorPesquisa = !empty($_GET) ? $_GET['pesquisa'] : null;
$filtro = (!empty($valorPesquisa) ? " WHERE TX_DESCRICAO LIKE '%" . $valorPesquisa . "%'" : "");
$dataSql = "SELECT * FROM tb_produto" . $filtro . " ORDER BY tx_descricao ASC";
$qryData = $PDO->prepare($dataSql);
$qryData->execute();

//Require header
include 'header.php'
?>

<!-- HEADER -->
<div>
	<div class="row" style="padding-bottom: 20px">
		<div class="col-sm-10" style="padding: 0;">
			<p><b>Bem Vindo!</b> Confira nosso catalago de Protudos e faça seu pedido!<br>Entregamos seu Pedido no Endereço cadastrado ;)</p>
		</div>
		<div class="col-sm-2 text-right" style="padding: 0;">
			<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</div>
<!-- HEADER -->

<!-- TOOLBAR PESQUISA -->
<div class="row">
	<div class="col-sm-12" style="background: #e4e4e4;padding: 10px; margin-bottom: 20px;">
		<form method="GET" class="form-inline">
			<div class="form-group col-md-6" style="padding: 0;">
				<input type="text" class="form-control" value="<?php echo !empty($valorPesquisa) ? $valorPesquisa : null ?>" style="width: 100%" placeholder="Pesquisar..." name="pesquisa">
			</div>
			<div class="form-group col-md-6">
				<button type="submit" class="btn btn-primary" style="margin-right: 3px;">Pesquisar</button>
				<button type="reset" class="btn">Cancelar</button>
			</div>
		</form>
	</div>
</div>
<!-- TOOLBAR PESQUISA -->

<!-- LISTAGEM E SELEÇÃO PRODUTOS -->
<form action="novoPedido.php" method="POST">
	<!-- WHILE PHP PRODUTOS -->
	<?php while ($produto = $qryData->fetch(PDO::FETCH_ASSOC)) { ?>
		<div class="col-md-2" style="    padding: 15px;border: 2px solid #ccc;">
			<?= '<img alt="Sem Imagem..." class="card-img-top" style="width: 100%" src="data:image/jpeg;base64,' . base64_encode($produto['bl_imagem']) . '"/>' ?>
			<div class="card-body">
				<p class="text-center"><?= $produto['tx_descricao']; ?></p>
				<p class="text-center" style="font-weight: bold;font-size: 30px;">R$<?= $produto['vl_valor']; ?></p>
				<input placeholder="Quantidade" class="form-control text-center" type="number" name="nr_quantidade_<?php echo ($produto['id_produto']) ?>" id="nr_quantidade">
			</div>
		</div>
	<?php } ?>
	<!-- WHILE PHP PRODUTOS -->

	<!-- CABEÇALHO PEDIDO -->
	<div class="row">
		<div class="form-group col-md-12" style="margin-top: 60px;">
			<label for="name">Nome do cliente:</label>
			<input type="text" required class="form-control" name="tx_nome">
		</div>

		<div class="form-group col-md-12">
			<label for="name">Telefone:</label>
			<input type="text" required class="form-control" name="nr_telefone">
		</div>

		<div class="form-group col-md-12">
			<label for="name">Endereço:</label>
			<input type="text" required class="form-control" name="tx_endereco">
		</div>

		<div class="col-md-12">
			<button type="submit" class="btn btn-success">Finalizar Pedido</button>
			<a href="index.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
	<!-- CABEÇALHO PEDIDO -->

</form>
<!-- LISTAGEM E SELEÇÃO PRODUTOS -->

<?php

//Require rodapé do site
include 'footer.php'

?>