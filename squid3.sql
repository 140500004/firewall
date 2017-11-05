-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 05/11/2017 às 03:16
-- Versão do servidor: 5.5.58-0+deb8u1
-- Versão do PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `squid3`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id_grupo` int(10) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'teste', '2017-11-05 05:01:47', '2017-11-05 05:01:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ips`
--

CREATE TABLE IF NOT EXISTS `ips` (
`id_ip` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `tipo` enum('L','B') NOT NULL DEFAULT 'B',
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_09_17_110824_create_grupos_table', 1),
('2017_09_17_111933_create_usuarios_table', 1),
('2017_09_17_111939_create_ips_table', 1),
('2017_09_17_111944_create_regras_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `regras`
--

CREATE TABLE IF NOT EXISTS `regras` (
`id_regras` int(10) unsigned NOT NULL,
  `id_grupo` int(10) unsigned DEFAULT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `tipo` enum('L','B') NOT NULL DEFAULT 'B',
  `url` varchar(50) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `regras`
--

INSERT INTO `regras` (`id_regras`, `id_grupo`, `id_usuario`, `tipo`, `url`, `descricao`, `created_at`, `updated_at`) VALUES
(4, NULL, NULL, 'B', 'facebook.com', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, NULL, 'L', 'facebook.com', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, NULL, NULL, 'B', 'uol.com.br', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, NULL, 1, 'L', 'uol.com.br', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, NULL, NULL, 'L', 'globo.com', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, NULL, 'L', 'casaaladim.com', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marlon', 'marlon-20-12@hotmail.com', '$2y$10$GTjIXHqoqwy0yhUh/OjdsO9BDd1n//Vvzv0sZFYUmNfj4nKHwPVjy', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(10) unsigned NOT NULL,
  `id_grupo` int(10) unsigned NOT NULL,
  `login` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_grupo`, `login`, `nome`, `senha`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Santos', 'Marlon', '$2y$10$QGYf5c1v5QtPA.mX9njpDePsvpryG1HXoklWKRFm5ER', 'A', '2017-11-05 05:03:14', '2017-11-05 05:06:42');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id_grupo`), ADD UNIQUE KEY `grupos_nome_unique` (`nome`);

--
-- Índices de tabela `ips`
--
ALTER TABLE `ips`
 ADD PRIMARY KEY (`id_ip`), ADD UNIQUE KEY `ips_ip_unique` (`ip`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Índices de tabela `regras`
--
ALTER TABLE `regras`
 ADD PRIMARY KEY (`id_regras`), ADD UNIQUE KEY `regras_id_grupo_url_tipo_unique` (`id_grupo`,`url`,`tipo`), ADD UNIQUE KEY `regras_id_usuario_url_tipo_unique` (`id_usuario`,`url`,`tipo`), ADD UNIQUE KEY `regras_id_grupo_id_usuario_url_tipo_unique` (`id_grupo`,`id_usuario`,`url`,`tipo`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `usuarios_login_unique` (`login`), ADD KEY `usuarios_id_grupo_foreign` (`id_grupo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
MODIFY `id_grupo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `ips`
--
ALTER TABLE `ips`
MODIFY `id_ip` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `regras`
--
ALTER TABLE `regras`
MODIFY `id_regras` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `regras`
--
ALTER TABLE `regras`
ADD CONSTRAINT `regras_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
ADD CONSTRAINT `regras_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
