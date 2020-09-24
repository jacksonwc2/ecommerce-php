<?php

//Adquirir conexão com banco
require_once '../conecta.php';

//sql remover itens do pedido
$id_pedido = isset($_GET['id']) ? (int) $_GET['id'] : null;
$sql = "DELETE FROM tb_pedidoitem WHERE cd_pedido = :id_pedido";
$qryData = $PDO->prepare($sql);
$qryData->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

//remover pedido
if ($qryData->execute()) {
	echo 'coisa2<br>';
	$sql2 = "DELETE FROM tb_pedido WHERE id_pedido = :id_pedido";
	$qryData2 = $PDO->prepare($sql2);
	$qryData2->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

	header('Location: pedidosForm.php');
} else {
    var_dump($qryData->errorInfo());
}
