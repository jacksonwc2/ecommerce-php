<?php

//conexão com banco
require_once '../conecta.php';

//sql para adquirir os produtos do pedido
$dataSql = "SELECT tb_pedidoitem.*, tb_produto.*
FROM tb_pedidoitem
INNER JOIN tb_produto ON cd_produto = id_produto
WHERE tb_pedidoitem.cd_pedido = " . $_GET['id'] . "
ORDER BY id_pedidoitem ASC";
$queryPedidoItem = $PDO->prepare($dataSql);
$queryPedidoItem->execute();

include 'header.php'
?>
<!-- Tabela com produtos do pedido -->
<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Itens do Pedido #<?= $_GET['id'] ?></h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-default" href="pedidosForm.php"><i class="fa fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($pedidoItem = $queryPedidoItem->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <?php if (empty($pedidoItem['bl_imagem'])) { ?>
                    <td><i class="fa fa-times"></td>
                <?php } else { ?>
                    <td><?= '<img class="imgProduto" src="data:image/jpeg;base64,' . base64_encode($pedidoItem['bl_imagem']) . '"/>' ?></td>
                <?php } ?>
                <td><?= $pedidoItem['tx_descricao']; ?></td>
                <td><?= $pedidoItem['nr_quantidade']; ?></td>
                <td><?= $pedidoItem['vl_valor']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<!-- Tabela com produtos do pedido -->
<?php
include 'footer.php'
?>