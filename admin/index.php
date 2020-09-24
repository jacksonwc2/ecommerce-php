<?php

//conexão com banco
require_once '../conecta.php';

//sql adquirir produtos
$countSql = "SELECT COUNT(*) AS total FROM tb_produto ORDER BY id_produto ASC";
$dataSql = "SELECT * FROM tb_produto ORDER BY id_produto ASC";
$qryCount = $PDO->prepare($countSql);
$qryCount->execute();
$total = $qryCount->fetchColumn();
$qryData = $PDO->prepare($dataSql);
$qryData->execute();
include 'header.php'
?>
<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Produtos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-primary" href="produtoForm.php"><i class="fa fa-plus"></i> Adicionar</a>
			<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th width="2%">#</th>
			<th>Produto</th>
			<th width="10%">Valor</th>
			<th width="10%">Imagem</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($total > 0) { ?>
			<?php while ($produto = $qryData->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td><?= $produto['id_produto']; ?></td>
					<td><?= $produto['tx_descricao']; ?></td>
					<td>R$<?= $produto['vl_valor']; ?></td>
					<?php if (empty($produto['bl_imagem'])) { ?>
						<td><i class="fa fa-times"></td>
					<?php } else { ?>
						<td><?= '<img class="imgProduto" src="data:image/jpeg;base64,' . base64_encode($produto['bl_imagem']) . '"/>' ?></td>
					<?php } ?>
					<td class="actions text-right">
						<a href="produtoForm.php?id_produto=<?= $produto['id_produto'] ?>&op=2" class="btn btn-sm btn-warning">
							<i class="fa fa-pencil"></i> Editar
						</a>
						<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodal" data-id="<?= $produto['id_produto']; ?>">
							<i class="fa fa-trash"></i> Excluir
						</button>

					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="6">Nenhum produto cadastrado.</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include 'footer.php'
?>