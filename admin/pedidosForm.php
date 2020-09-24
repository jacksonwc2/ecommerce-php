<?php
//conexão com banco
require_once '../conecta.php';

//sql para adquirir os pedidos
$countSql = "SELECT COUNT(*) FROM tb_pedido ORDER BY id_pedido ASC";
$dataSql = "SELECT tx_nome, tx_endereco, id_pedido, nr_telefone, sum(nr_quantidade * vl_valor) AS total
FROM tb_pedido
INNER JOIN tb_pessoa ON tb_pedido.cd_pessoa = tb_pessoa.id_pessoa
INNER JOIN tb_pedidoitem ON cd_pedido = id_pedido
INNER JOIN tb_produto ON cd_produto = id_produto
GROUP BY tx_nome, tx_endereco, id_pedido, nr_telefone
ORDER BY id_pedido ASC";
$qryCount = $PDO->prepare($countSql);
$qryCount->execute();
$total = $qryCount->fetchColumn();
$qryData = $PDO->prepare($dataSql);
$qryData->execute();
include 'header.php'
?>
<!-- Tabela com pedidos -->
<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Pedidos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-default" href="pedidosForm.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th width="15%">Nro Pedido</th>
			<th>Cliente</th>
			<th>Telefone</th>
			<th>Endereco</th>
			<th>Valor total</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($total > 0) { ?>
			<?php while ($pedido = $qryData->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td><?= $pedido['id_pedido']; ?></td>
					<td><?= $pedido['tx_nome']; ?></td>
					<td><?= $pedido['nr_telefone']; ?></td>
					<td><?= $pedido['tx_endereco']; ?></td>
					<td>R$ <?= $pedido['total']; ?></td>

					<td class="actions text-right">
						<a class="btn btn-sm btn-primary" href="detalhe.php?id=<?php echo $pedido['id_pedido'] ?>">
							<i class="fa fa-plus"></i> Visualizar
						</a>

						<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodal" data-pedido=1 data-id="<?= $pedido['id_pedido']; ?>">
							<i class="fa fa-trash"></i> Excluir
						</a>
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
<!-- Tabela com pedidos -->
<?php
include 'footer.php'
?>