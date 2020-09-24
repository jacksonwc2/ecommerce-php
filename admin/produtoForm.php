<?php 
//conexão com banco
require '../conecta.php';

//sql adquirir produto para edição
$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : null;
$countSql = "SELECT * FROM tb_produto WHERE id_produto=" . $id_produto;
$qryCount = $PDO->prepare($countSql);
$qryCount->execute();
$produto = $qryCount->fetchObject(); 
include 'header.php';
?>
<!-- Edição produto -->
<?= ($id_produto != null) ? '<h2>Editar Produto</h2>' : '<h2>Novo Produto</h2>' ?>
<hr />
<form action="addProduto.php" enctype="multipart/form-data" method="post">
  <?= ($id_produto != null) ? '<input type="hidden" name="id_produto" value="'.$produto->id_produto.'">' : "" ?>
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Descricao:</label>
      <input type="text" class="form-control" name="tx_descricao" value="<?= ($id_produto != null) ? $produto->tx_descricao : "" ?>">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Valor:</label>
      <input type="number" class="form-control" name="vl_valor" value="<?= ($id_produto != null) ? $produto->vl_valor : "" ?>">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Imagem:</label>
      <input type="file" class="form-control-file" name="bl_imagem">
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
<!-- Edição produto -->
<?php
include 'footer.php'
?>