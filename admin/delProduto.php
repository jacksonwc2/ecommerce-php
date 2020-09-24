<?php

//conexão com banco
require_once '../conecta.php';
$id_produto = isset($_GET['id']) ? (int) $_GET['id'] : null;

//sql deletar produto
$sql = "DELETE FROM tb_produto WHERE id_produto = :id_produto";
$qryData = $PDO->prepare($sql);
$qryData->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);

if ($qryData->execute()) {
    header('Location: index.php');
} else {
	?>
		<script>
			alert('Produto não pode ser removivo pois já existem pedidos com o mesmo!');
			location.assign('index.php');
		</script>
	<?php
}
