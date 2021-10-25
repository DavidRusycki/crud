
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Estrutura da tabela Produto

CREATE TABLE `produto` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `valor` decimal(6) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Índices para tabela `cidades`

ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo` (`codigo`);

-- AUTO_INCREMENT de tabela `cidades`

ALTER TABLE `produto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Inserção de valores iniciais para testes.

INSERT INTO `produto` (`nome`, `valor`, `marca`, `quantidade`) VALUES
('Maça', 1.40, 'Frutas Dois irmãos', 4000),
('Pera', 2.39, 'Frutas Dois irmãos', 1800);
