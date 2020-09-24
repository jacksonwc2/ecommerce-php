--CREATE BANCO DE DADOS
CREATE DATABASE bardoze;

-- CREATE ENTIDADE PESSOA
CREATE TABLE `tb_pessoa` (
  `id_pessoa` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `tx_nome` varchar(64) NOT NULL,
  `nr_telefone` varchar(64) NOT NULL,
  `tx_endereco` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE ENTIDADE PRODUTO
CREATE TABLE `tb_produto` (
  `id_produto` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tx_descricao` varchar(64) NOT NULL,
  `vl_valor` int(11) NOT NULL,
  `bl_imagem` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE ENTIDADE PEDIDO
CREATE TABLE `tb_pedido` (
  `id_pedido` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cd_pessoa` int(11) NOT NULL,
  CONSTRAINT `fk_pedido_pessoa` FOREIGN KEY ( `cd_pessoa` ) REFERENCES `tb_pessoa` (`id_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE ENTIDADE PEDIDOITEM
CREATE TABLE `tb_pedidoitem` (
  `id_pedidoitem` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cd_produto` int(11) NOT NULL,
  `cd_pedido` int(11) NOT NULL,
  `nr_quantidade` int(64) NOT NULL,
  CONSTRAINT `fk_pedidoitem_pedido` FOREIGN KEY (`cd_pedido`) REFERENCES `tb_pedido` (`id_pedido`),
  CONSTRAINT `fk_pedidoitem_produto` FOREIGN KEY (`cd_produto`) REFERENCES `tb_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;