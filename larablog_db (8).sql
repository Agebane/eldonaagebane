-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Abr-2023 às 00:14
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `larablog_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_social_media`
--

CREATE TABLE `blog_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bsm_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsm_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsm_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsm_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `blog_social_media`
--

INSERT INTO `blog_social_media` (`id`, `bsm_facebook`, `bsm_instagram`, `bsm_youtube`, `bsm_linkedin`, `created_at`, `updated_at`) VALUES
(1, 'http://www.facebook.com', 'http://www.instagram.com', 'http://www.youtube.com', 'http://www.eliseuagebane.com', NULL, '2023-04-04 17:01:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordenando` int(11) NOT NULL DEFAULT 10000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome_categoria`, `ordenando`, `created_at`, `updated_at`) VALUES
(1, 'Sobre Nós', 2, '2023-03-27 00:34:52', '2023-04-08 10:18:10'),
(6, 'Projetos', 3, '2023-04-04 16:47:59', '2023-04-08 10:18:49'),
(7, 'Linguas', 1, '2023-04-04 23:28:36', '2023-04-05 09:58:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_15_101744_create_types_table', 1),
(6, '2023_03_19_233547_create_settings_table', 2),
(7, '2023_03_21_223923_create_blog_social_media_table', 3),
(8, '2023_03_26_145757_create_categorias_table', 4),
(9, '2023_03_26_145846_create_subcategorias_table', 4),
(10, '2023_03_27_002738_create_categorias_table', 5),
(11, '2023_03_27_003339_create_sub_categorias_table', 5),
(12, '2023_03_27_144644_create_posts_table', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('gomesagebane@gmail.com', 'SUNtbWo2NDg5OXMybE1semNUbHJtdXJFakl3YzFvYkk2NmY3c2RacXZSSkZWdVJDdDRQSGpTdUtUSEtyRzdHZw==', '2023-04-10 08:33:59'),
('gomesagebane@gmail.com', 'UjNwM1lQOUNKaW4wNVlmeXQ1ejhtaTI0ZEt2UWxDV1ZUQTBwSXhsNUdxbzRKaDliVEFuRUp6c0ZJd1pzaWQxeQ==', '2023-04-10 09:55:30'),
('gomesagebane@gmail.com', 'U1hHM2FMZGdGYmRqUm4xVzA0OFJDWWRob1hNbHBKWmc1b0NOcW13UGVxSVVheVBTcllFaDlvMkhWeEdESjM0YQ==', '2023-04-10 09:57:01'),
('gomesagebane@gmail.com', 'QU9SNERyUXJaaE5pZ3BtQXljWEx0UDNwWFY1REl5VHFNUXZuUGdFYWx4U0kxZHVCWnZJcllWTXRHZjRvSTd5TA==', '2023-04-10 09:57:22'),
('gomesagebane@gmail.com', 'NjE4RmdmbGNiS1VHd240RUlpNDhwZERxUExuVVREVU93SVZIaFRjVTUzSjFBa21KSXJBd0lPU3Q2aDAxM2ppcw==', '2023-04-10 10:10:44'),
('emilyagebane@gmail.com', 'ME9oMmdZMk9GNlUzOWliUGlTaWRHZVB5TW1SWWVNbEhZTnEyemtwcUI0ZXR5NmcweFZSNU1WZFJmQlRNTTQ0VA==', '2023-04-10 10:41:36'),
('emilyagebane@gmail.com', 'aFV5bkIxV3J0SXdBM0lub0JqaDVJNlE3cHkxV094TzZMVkVsTm5JOEJQVHhTYm5NRjNJSDVhdXRQMERCbURmYg==', '2023-04-10 10:47:35'),
('emilyagebane@gmail.com', 'TGlrbDZxWW5PVjhVaWowMEVGT0doVEVaWnpjSHRqSDJHVE4zWlZwTU8ycElQT2tuZkNlTzdNOGFTNWJkbXJxYw==', '2023-04-10 10:53:48'),
('emilyagebane@gmail.com', 'QUxNNnpnTExDeVlwVVlWVjVERTk3RGZuTWZkTWhYY05lWUczRXpzbkZFNWMzcUM4VGdGWndCNnlHQWZqcWlEWA==', '2023-04-10 10:55:07'),
('emilyagebane@gmail.com', 'aTJGeFgxSnM2akJCb0JLQ3FobFplSUtTUXZsZHdDZDU4OW9vNnNjVE5IWnFoQW1lVm5JM2RsSnFOU1R3Nm9yZg==', '2023-04-10 22:48:32'),
('emilyagebane@gmail.com', 'NDZaaGNSRkRhMFJxbXN1MTBDaWZWNHN4SmdzUmlValVXc3JmeGxLeXhqYnY5YVBZMVBwMjVqWWd3d1JESU5wVw==', '2023-04-10 22:49:08'),
('emilyagebane@gmail.com', 'UERXaEJkcW5yVTM3SHlDYXFtVHNmUFZkVDZVaTZsQjUyNWtCU0Y5V1lEa1I2dld1VjF5VTVkM2hZM2J4QXduUQ==', '2023-04-11 13:46:27'),
('eldonaagebane@gmail.com', 'NWthZTZoZHVuRjNPWlNaNWp4VjNOZzNtNE5YTTA4QjdhSmdKVW5KYWdGcmNhT2ZjdHc5NGxOUjBJcmt1d0pSeQ==', '2023-04-11 13:57:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_tags` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `usuario_id`, `categoria_id`, `post_title`, `post_slug`, `post_content`, `post_tags`, `featured_image`, `created_at`, `updated_at`) VALUES
(63, 9, 1, 'Boas vindas', NULL, '<p>O bit de start, como o pr&oacute;prio nome j&aacute; indica, marca o in&iacute;cio da transmiss&atilde;o de um caracter e sempre apresenta uma transi&ccedil;&atilde;o inicial para marcar &quot;sua presen&ccedil;a&quot; e possibilitar o disparo da contagem no oscilador de recep&ccedil;&atilde;o. Em seguida, tem-se o caracter e mais um bit opcional de paridade que pode ser usado para detec&ccedil;&atilde;o de erros. E finalizando, o bit de stop &eacute; usado como indicador de final de caracter e permite que o receptor tenha um intervalo de tempo para acessar o seu registro de recep&ccedil;&atilde;o e transmitir o in&iacute;cio do bit de start do pr&oacute;ximo caracter.</p>', NULL, '1681424000_8a26974ee6444acd.jpg', '2023-04-13 14:10:16', '2023-04-13 22:13:20'),
(65, 9, 1, 'Muito ruim', NULL, '<p>O bit de start, como o pr&oacute;prio nome j&aacute; indica, marca o in&iacute;cio da transmiss&atilde;o de um caracter e sempre apresenta uma transi&ccedil;&atilde;o inicial para marcar &quot;sua presen&ccedil;a&quot; e possibilitar o disparo da contagem no oscilador de recep&ccedil;&atilde;o. Em seguida, tem-se o caracter e mais um bit opcional de paridade que pode ser usado para detec&ccedil;&atilde;o de erros. E finalizando, o bit de stop &eacute; usado como indicador de final de caracter e permite que o receptor tenha um intervalo de tempo para acessar o seu registro de recep&ccedil;&atilde;o e transmitir o in&iacute;cio do bit de start do pr&oacute;ximo caracter.</p>', NULL, '1681395178_546fd146c83f428c.jpg', '2023-04-13 14:12:59', '2023-04-13 14:12:59'),
(67, 9, 10, 'Vida de Gueto', NULL, '<p>A elabora&ccedil;&atilde;o da Monografia &eacute; um componente curricular obrigat&oacute;rio para a conclus&atilde;o dos Cursos de Licenciatura &ndash; na modalidade de especializa&ccedil;&atilde;o, ou seja, trabalho de pesquisa individual, sob orienta&ccedil;&atilde;o do docente, envolvendo temas de abrang&ecirc;ncia da &aacute;rea de especializa&ccedil;&atilde;o e deve ter no m&iacute;nimo trinta (30) p&aacute;ginas. 2. Concluir o curso significa cumprir todos os quesitos exigidos para conclus&atilde;o do curso atrav&eacute;s da aprova&ccedil;&atilde;o em todas as disciplinas, na monografia e em todas as demais atividades acad&eacute;micas previstas no Projeto Pedag&oacute;gico do Curso. 3. O n&atilde;o cumprimento do quesito Monografia ou a reprova&ccedil;&atilde;o da Monografia, por qualquer dos motivos definidos neste regulamento, implica a n&atilde;o integraliza&ccedil;&atilde;o do curso e consequentemente o n&atilde;o recebimento do Certificado de Conclus&atilde;o de Curso. Artigo 2.&ordm; (Objetivo da monografia) Consiste em propiciar ao estudante a ocasi&atilde;o de demonstrar o grau de habilita&ccedil;&atilde;o adquirido, o aprofundamento tem&aacute;tico, o est&iacute;mulo &agrave; produ&ccedil;&atilde;o cient&iacute;fica, &agrave; consulta de bibliografia especializada e o aperfei&ccedil;oamento da capacidade de interpreta&ccedil;&atilde;o cr&iacute;tica na &aacute;rea de especializa&ccedil;&atilde;o.</p>', NULL, '1681398932_36e273986ed577b8.jpg', '2023-04-13 15:15:32', '2023-04-13 15:15:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `blog_name`, `blog_email`, `blog_description`, `blog_logo`, `blog_favicon`, `created_at`, `updated_at`) VALUES
(1, 'Eldona', 'blogeliseu@gmail.com', 'site de Eldona', '1680627280_16854_larablog_logo.png', '1679490194_1268_larablog_favicon.ico', NULL, '2023-04-04 17:02:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categorias`
--

CREATE TABLE `sub_categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_subcategoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_principal` int(11) DEFAULT NULL,
  `ordenando` int(11) NOT NULL DEFAULT 10000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sub_categorias`
--

INSERT INTO `sub_categorias` (`id`, `nome_subcategoria`, `slug`, `categoria_principal`, `ordenando`, `created_at`, `updated_at`) VALUES
(1, 'Eliseu', 'eliseu', 1, 3, '2023-03-27 09:39:02', '2023-04-05 10:09:53'),
(9, 'Pitar', 'pitar', 6, 5, '2023-04-04 16:50:27', '2023-04-05 10:11:37'),
(10, 'Ram', 'ram', 1, 1, '2023-04-04 23:28:58', '2023-04-05 10:09:53'),
(11, 'Lenovo', 'lenovo', 6, 4, '2023-04-04 23:29:23', '2023-04-05 10:11:37'),
(12, 'portfólio', 'portfolio', 0, 2, '2023-04-05 00:12:08', '2023-04-08 10:19:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin/Super Author', NULL, NULL),
(2, 'Author', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 2,
  `block` int(11) DEFAULT NULL,
  `direct_publish` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `username`, `picture`, `biography`, `type`, `block`, `direct_publish`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eliseu Agebane', 'eldonaagebane@gmail.com', NULL, '$2y$10$LRgi3naYKFq2BD1gZVWitu8yW2/XN94KVqQCcOR6pmX1FA3HynBme', 'Eng.informático', 'AIMG1168116294797844.jpg', 'ser rico', 1, 0, 0, NULL, NULL, '2023-04-11 13:41:40'),
(2, 'Felismina', 'donaagebane@gmail.com', NULL, '$2y$10$ESHTeXAK28IWXV2Tuoy8zO1pWSHzsmEcsB6fI4w6ee16UCSbOBeZu', 'MinaFeliz', 'AIMG2167974624098563.jpg', 'linda', 2, 1, 1, NULL, '2023-03-23 11:33:59', '2023-03-26 00:38:55'),
(6, 'Abrão-kabi', 'kotalinux@gmail.com', NULL, '$2y$10$1S1wFaI5HcLe9MWT8dmN9erPGVXiZ/IohfQzfSW/bc2TkhO5mL6sm', 'Abrão_linu', 'AIMG6167974637077620.jpg', NULL, 2, 0, 1, NULL, '2023-03-25 12:04:22', '2023-04-04 16:59:14'),
(9, 'Midana', 'gomesagebane@gmail.com', NULL, '$2y$10$ZgxW.2jixcSTyWyBvS2k/Oubv1dVFXqCck8frBGc0rlsemssGRifq', 'Midana', 'AIMG9168130045569302.jpg', 'Sou muito lindo', 1, NULL, 0, NULL, '2023-04-10 08:33:02', '2023-04-12 11:54:15'),
(10, 'Boss', 'emilyagebane@gmail.com', NULL, '$2y$10$mAi/7N0ctfgDyJzI3Fax6OE/xxKptLMmFPL0Z8CY8gJwS17w2yS9m', 'Emilyage', NULL, NULL, 2, NULL, 0, NULL, '2023-04-10 10:16:17', '2023-04-10 10:16:17'),
(11, 'Sumaila', 'suailaagebane@gmail.com', NULL, '$2y$10$SP6ocuGV2.rSod7.lE9rMeTffaMKLiUZ6fgaZEamq7ftiMBuI4w72', 'Sumaila', 'AIMG1116812213838301.jpg', NULL, 2, NULL, 1, NULL, '2023-04-10 22:42:22', '2023-04-11 13:56:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `blog_social_media`
--
ALTER TABLE `blog_social_media`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `blog_social_media`
--
ALTER TABLE `blog_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sub_categorias`
--
ALTER TABLE `sub_categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
