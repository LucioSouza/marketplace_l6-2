-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Out-2020 às 04:26
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marketplace_l6`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Games', 'Games', 'games', '2020-10-10 05:14:33', '2020-10-10 05:14:33'),
(2, 'Esportes', 'Esportes', 'esportes', '2020-10-10 05:14:46', '2020-10-10 05:14:46'),
(3, 'Lazer', 'Lazer', 'lazer', '2020-10-10 05:14:55', '2020-10-10 05:14:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `category_product`
--

CREATE TABLE `category_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `category_product`
--

INSERT INTO `category_product` (`product_id`, `category_id`) VALUES
(1, 3),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 1);

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
(27, '2014_10_12_000000_create_users_table', 1),
(28, '2014_10_12_100000_create_password_resets_table', 1),
(29, '2019_08_19_000000_create_failed_jobs_table', 1),
(30, '2020_09_24_002108_create_table_store', 1),
(31, '2020_09_24_003659_create_products_table', 1),
(32, '2020_09_25_005826_create_categories_table', 1),
(33, '2020_09_25_010050_create_category_product_table', 1),
(34, '2020_09_30_013006_create_product_photos_table', 1),
(35, '2020_09_30_013428_alter_table_stores_add_column_logo', 1),
(36, '2020_10_03_221557_create_user_orders_table', 1),
(37, '2020_10_06_013330_create_order_store_table', 1),
(38, '2020_10_08_193844_create_notifications_table', 1),
(39, '2020_10_09_212543_alter_users_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1a746984-0b35-4a89-8f82-2f23cfa66299', 'App\\Notifications\\StoreReceiveNewOrder', 'App\\Models\\User', 19, '{\"message\":\"Voc\\u00ea tem um novo pedido\"}', NULL, '2020-10-14 01:50:50', '2020-10-14 01:50:50'),
('4031e6c8-6db4-421c-bf1d-8880a9d30670', 'App\\Notifications\\StoreReceiveNewOrder', 'App\\Models\\User', 1, '{\"message\":\"Voc\\u00ea tem um novo pedido\"}', NULL, '2020-10-14 01:21:50', '2020-10-14 01:21:50'),
('814abe57-0c77-4934-9f22-e422ac6c2593', 'App\\Notifications\\StoreReceiveNewOrder', 'App\\Models\\User', 1, '{\"message\":\"Voc\\u00ea tem um novo pedido\"}', NULL, '2020-10-14 02:01:38', '2020-10-14 02:01:38'),
('b496df69-3e2c-46e4-9855-45a015670844', 'App\\Notifications\\StoreReceiveNewOrder', 'App\\Models\\User', 1, '{\"message\":\"Voc\\u00ea tem um novo pedido\"}', '2020-10-10 05:25:39', '2020-10-10 05:24:34', '2020-10-10 05:25:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_store`
--

CREATE TABLE `order_store` (
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `order_store`
--

INSERT INTO `order_store` (`store_id`, `order_id`) VALUES
(1, 1),
(1, 2),
(19, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `store_id`, `name`, `description`, `body`, `price`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Santiago Haag', 'Eaque officiis minima occaecati.', 'Velit maiores itaque quasi nesciunt doloremque eum rerum.', '4.60', 'santiago-haag', '2020-10-10 05:07:21', '2020-10-10 05:15:21'),
(2, 2, 'Estevan Cummerata', 'Exercitationem praesentium ut sit iure nisi et et necessitatibus.', 'Consequatur officiis veniam magni deleniti. Nihil soluta eius et sunt distinctio accusamus. Temporibus vel corporis aspernatur atque non ex tenetur. Rerum et quia vitae architecto expedita corrupti ratione. Et voluptatum corrupti iste iure qui cupiditate. Sit voluptas alias autem.', '9.75', 'odit-alias-fuga-sapiente-facere-perspiciatis-odio-omnis-quis', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(3, 3, 'Mr. Darien Wiegand I', 'Ea nihil perspiciatis eligendi dignissimos a sapiente consequatur saepe.', 'Ea perspiciatis consequatur et atque nesciunt ad provident. Aut sunt commodi sit natus molestiae. Accusantium omnis exercitationem rerum deserunt ut et. Cumque quod consectetur iste voluptatem voluptatibus dignissimos. Officia tenetur laborum similique et at doloremque.', '5.85', 'dolore-illum-similique-et', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(4, 4, 'Hector Smith', 'Recusandae cum tempore id modi illo ut.', 'Aut molestias vitae quos nihil molestiae ex molestiae. Sunt reprehenderit quis a. Itaque eaque at voluptate harum qui occaecati voluptatem. Qui et nemo dolorem necessitatibus labore voluptatum aspernatur. Dolor minus beatae cum atque. Nesciunt maxime aut pariatur iste reiciendis incidunt voluptatem. Esse laboriosam recusandae omnis labore.', '2.11', 'nostrum-a-dicta-et-modi-ex-odit', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(5, 5, 'Dr. Imelda Murray PhD', 'Eum voluptatum fuga sunt tempore quasi officiis adipisci accusantium.', 'Mollitia sit quia qui eaque. Itaque quibusdam laborum doloribus est id consequatur. Illo sapiente alias sint et dolores perspiciatis. Quo exercitationem omnis sit ea voluptates voluptatem est. Perspiciatis aperiam voluptates reiciendis voluptates et. Labore esse corporis magnam voluptas. Asperiores necessitatibus est corporis sunt dolore tempore.', '4.43', 'ut-esse-reprehenderit-officiis-similique-beatae-id-est', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(6, 6, 'Rhoda Kozey III', 'Temporibus optio similique nihil praesentium quasi.', 'Magni id et dolor sed quis. Est asperiores quisquam tempora enim voluptatem consequuntur. Doloribus explicabo aut ut quis nisi tenetur ipsa. Nulla nostrum est et delectus nesciunt optio. Sit ut eius earum error ducimus exercitationem.', '8.71', 'asperiores-officiis-deleniti-quas-id-ipsum', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(7, 7, 'Jarod Kris DDS', 'Repudiandae et adipisci doloribus dolor cumque nulla accusantium exercitationem.', 'Porro reprehenderit iste quia provident itaque. Voluptas enim alias nulla aut. Ad nulla quas qui qui. Temporibus asperiores iste quisquam iure doloremque omnis distinctio. Consequatur dolores accusantium ullam in. Est voluptatem corporis voluptatem aut.', '2.89', 'asperiores-voluptates-laudantium-aut-ab-voluptatem', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(8, 8, 'Dr. Forrest VonRueden V', 'Sequi est et occaecati vel iste repellendus unde sit.', 'Ut fugiat et sed quidem recusandae. Eum labore dolores culpa numquam non perferendis aliquam necessitatibus. Et voluptatem asperiores quis numquam. Libero aut vel ut est et veniam amet.', '4.83', 'nulla-qui-architecto-mollitia-mollitia-veritatis-est', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(9, 9, 'Vickie Wisozk', 'Reiciendis commodi aut enim dignissimos quisquam est.', 'Ut facere ipsum possimus voluptas sequi voluptas molestias. Ut nisi ratione modi ut eos voluptatum dolorem. Quo totam nihil molestiae modi temporibus. Nostrum voluptas autem rerum commodi laborum.', '4.50', 'culpa-eos-cumque-sed-assumenda-fuga', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(10, 10, 'Alfonso Hyatt', 'Dolorem molestias adipisci sed vero et itaque sit.', 'Voluptatem aut sit ducimus voluptatibus fugiat placeat velit sint. Impedit in quia non ut. Assumenda qui officia aut temporibus delectus culpa enim velit. Voluptatem libero cum architecto praesentium ducimus. Commodi numquam saepe rerum.', '5.03', 'autem-id-reiciendis-dignissimos-quia-qui-numquam', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(11, 11, 'Elna Kling', 'Aspernatur ea soluta dolor ut.', 'Rem ab et minima quasi. Repellat sint harum dolores ea aut. Sint rerum aliquam dolorem ex qui voluptates ratione. Quaerat et tempore eos eligendi. Exercitationem rerum aut earum perspiciatis ut. Blanditiis nisi ea vel quisquam. Et et non architecto molestias omnis eum.', '2.78', 'sed-est-omnis-magnam', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(12, 12, 'Dr. Lizzie Lesch II', 'Assumenda rerum omnis impedit aspernatur id eaque.', 'Perferendis voluptatem eligendi praesentium nemo. Voluptatem iure aperiam velit quasi. Laudantium recusandae facere accusantium. Ut accusantium necessitatibus ut consequatur. Vitae sint est qui facilis architecto fugiat fuga velit. Sit incidunt repellendus dicta voluptatem.', '5.06', 'occaecati-enim-omnis-dignissimos-totam-quia-magni-odit-voluptas', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(13, 13, 'Mrs. Edwina Barton V', 'Labore consequatur dolorem reiciendis quisquam minima alias quae reiciendis.', 'Magni necessitatibus expedita temporibus quis. Quidem ipsam asperiores enim incidunt. Aperiam neque doloremque quia aut. Sit nostrum reprehenderit unde ut magnam vitae dolorem. Voluptatem omnis veritatis beatae nostrum voluptatibus. Non ab officia non dolore atque similique.', '5.36', 'iusto-nobis-veniam-minus-fugiat-sed-iure', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(14, 14, 'Amber Kutch', 'Quia impedit placeat quis totam illum quidem.', 'Doloribus sed sint et maiores. Voluptatem molestiae delectus et. Nihil fugiat a non nesciunt. Esse assumenda enim id et in modi.', '9.95', 'cupiditate-temporibus-illum-molestiae', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(15, 15, 'Sadie Nikolaus', 'Quod quod quia est nesciunt natus veniam.', 'Maiores aut sed culpa eligendi. Dolor et qui dolor perferendis necessitatibus perspiciatis repellendus dolor. Sunt eligendi reprehenderit non eos corrupti consequatur dolorem beatae. Similique autem aut ratione temporibus. Quis quisquam aut aut provident modi sapiente laudantium necessitatibus.', '9.10', 'minus-sint-deserunt-voluptatem-dicta-dolorum-beatae-dolores', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(16, 16, 'Dr. Frederik Champlin', 'Libero enim beatae debitis molestiae molestias hic ut.', 'Aliquam aut et quos consequuntur. Ad ab cum quia nihil. Maxime porro minima eos voluptas. Atque ab ullam aut aut quae veniam. Quidem quis cumque adipisci laboriosam qui aut.', '5.97', 'a-est-dolor-provident-voluptatem', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(17, 17, 'Alexandrea Herzog', 'Mollitia ea dolor suscipit natus.', 'Amet ea possimus deserunt qui aperiam doloribus repellat. Aut dignissimos totam assumenda eos ipsum sit est. Nisi a et dolor aut et. Eaque eaque fuga vitae ut molestiae sunt. Qui accusantium sint dignissimos omnis ab. Molestiae molestiae consectetur sint ut quia enim. Earum quis et vitae nihil eaque aut.', '4.48', 'quod-cumque-sed-repellendus-aut-aut-rerum-ab', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(18, 18, 'Elinore Ankunding DDS', 'Quaerat maxime dolorum consectetur animi blanditiis iusto natus.', 'Earum ut mollitia a facere illum tenetur. Laborum magnam rerum consequatur incidunt qui ipsum sed omnis. Et vel maxime dolor reprehenderit amet. Quos modi labore qui et qui nemo consequatur. Natus est voluptas temporibus eaque commodi repudiandae in sed. Enim necessitatibus in odit consequuntur magnam.', '5.43', 'animi-impedit-eveniet-tempora-illum-officia-expedita', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(19, 19, 'Brianne Gusikowski', 'Perspiciatis vel corrupti minima qui cupiditate.', 'Non dolores fuga dicta. Minima nostrum deleniti voluptas impedit. Molestias similique qui aut sint aut magni. Impedit molestiae et aut quas. Nobis dicta omnis quia porro modi eius tenetur. Voluptatum id non distinctio non error vitae eos. Iusto impedit aut qui.', '4.43', 'ut-tenetur-dicta-et-ut-et-distinctio', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(20, 20, 'Christine Mertz', 'Similique suscipit incidunt sint vitae corporis quod unde.', 'Cupiditate mollitia aliquid fuga blanditiis rerum. Possimus sint id aut fugit et aliquam veniam. Maxime aut sed quidem sed officia. Vel deserunt molestias et tenetur. Nemo fugit nostrum consequuntur voluptates eaque sapiente.', '1.17', 'beatae-dolorem-vitae-veniam-dolores-quasi-reiciendis', '2020-10-10 05:07:21', '2020-10-10 05:07:21'),
(21, 1, 'Bola de futebol', 'Bola de futebol', 'Bola de futebol', '150.00', 'bola-de-futebol', '2020-10-10 05:15:48', '2020-10-10 05:15:48'),
(22, 1, 'Produto com slug', 'Produto com slug', 'Produto com slug', '120.00', 'produto-com-slug', '2020-10-14 03:24:33', '2020-10-14 03:27:34'),
(23, 1, 'Produto com slug do Lúcio testano a remoção do acento editando o Ponta pé', 'Produto com slug do Lúcio testano a remoção do acento', 'Produto com slug do Lúcio testano a remoção do acento', '100.00', 'produto-com-slug-do-lucio-testano-a-remocao-do-acento-editando-o-ponta-pe', '2020-10-14 03:31:00', '2020-10-14 03:31:40'),
(24, 1, 'Produto com slug único', 'Produto com slug único', 'Produto com slug único', '12.00', 'produto-com-slug-unico', '2020-10-14 03:53:05', '2020-10-14 03:53:05'),
(25, 1, 'Produto com slug único', 'Produto com slug único', 'Produto com slug único', '12.00', 'produto-com-slug-unico-1', '2020-10-14 03:53:28', '2020-10-14 03:53:28'),
(26, 1, 'Produto com slug único', 'Produto com slug único', 'Produto com slug único', '12.00', 'produto-com-slug-unico-2', '2020-10-14 04:01:17', '2020-10-14 04:01:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_photos`
--

CREATE TABLE `product_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/07AAuUw77ZKlsE50iLWsf2HAV4GMM1gRL7ZzhjIi.jpeg', '2020-10-10 05:15:21', '2020-10-10 05:15:21'),
(4, 21, 'products/EfvcOeD24CtZfqKHfQrx6EhdiovDZPSDMlEZAPtY.jpeg', '2020-10-14 02:42:06', '2020-10-14 02:42:06'),
(5, 21, 'products/UsyWenY0vBw95HZigTpGKGrpYxGvOpWZWrGbkFGu.jpeg', '2020-10-14 02:42:06', '2020-10-14 02:42:06'),
(6, 22, 'products/TzUju6UBcB7Tj29YS5TxspcDRDkX27hAQMNOeTJa.jpeg', '2020-10-14 03:24:33', '2020-10-14 03:24:33'),
(7, 23, 'products/CtclmRRWKQoX974E8IGhr1AWMR3K4fbuKy6mkCx7.jpeg', '2020-10-14 03:31:00', '2020-10-14 03:31:00'),
(8, 24, 'products/HKHCFjnJ5WuspKF1NhLn50L8dM1G83b6nxmcQpap.jpeg', '2020-10-14 03:53:05', '2020-10-14 03:53:05'),
(9, 25, 'products/t784vhKVSYMB16eU8Gv1GziZhQ9Cfz24riDg3NvC.jpeg', '2020-10-14 03:53:28', '2020-10-14 03:53:28'),
(10, 26, 'products/bowjtgWRBa34pa2LPUkEUOo3S3ok5TRJFfHMBnmP.png', '2020-10-14 04:01:17', '2020-10-14 04:01:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `stores`
--

INSERT INTO `stores` (`id`, `user_id`, `name`, `description`, `phone`, `mobile_phone`, `slug`, `created_at`, `updated_at`, `logo`) VALUES
(1, 1, 'Manuela Volkman', 'Molestiae alias ratione iusto quam eum.', '1-361-624-4255 x64138', '241.855.0529', 'manuela-volkman', '2020-10-10 05:07:21', '2020-10-10 05:26:11', 'logo/8m12Emu7Had39RSAPjzVnEfNx3AYCvm7BQpmWgHl.jpeg'),
(2, 2, 'Tiara O\'Conner DVM', 'Necessitatibus laudantium tenetur ea sed sit.', '(676) 298-8264 x63812', '+1.406.945.3027', 'dolores-molestiae-commodi-ipsum-quo-vitae-eum-ad-enim', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(3, 3, 'Santino Dickinson', 'Dolores sunt natus magni velit animi facere.', '1-761-495-0326 x2573', '1-358-428-3725', 'ad-voluptatem-non-ullam-aut', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(4, 4, 'Max Nader MD', 'Dolor debitis qui alias iusto reprehenderit.', '1-519-828-9400 x30058', '613-927-0843', 'porro-sit-minima-natus-at-suscipit-hic-libero-placeat', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(5, 5, 'Rubye Dietrich', 'Ex voluptatem aut vero iure quam in nobis autem.', '1-282-316-8466 x729', '1-734-440-3958', 'magni-ullam-a-aut-officia', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(6, 6, 'Santos Veum', 'Cupiditate ea et aut fuga perferendis.', '503.397.5157 x3283', '851.466.0675 x307', 'non-et-velit-dolore', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(7, 7, 'Ms. Lucinda Beahan DDS', 'Autem omnis voluptate ut omnis dolores voluptatem.', '839.999.4506 x988', '1-520-262-1625', 'illo-veniam-voluptas-nemo-est-vitae', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(8, 8, 'Dr. Mabelle Prosacco IV', 'Neque ducimus aut est aliquam at.', '+1-280-907-8387', '735-778-7291', 'ea-facere-molestiae-fugiat-dolorum-placeat', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(9, 9, 'Sean Smitham', 'Tenetur nesciunt facilis hic expedita quia repellendus quod.', '364.247.1390 x02739', '+19314766846', 'necessitatibus-aut-rem-recusandae-cupiditate', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(10, 10, 'Dr. Gussie Sporer', 'Aut iure nihil consequuntur quidem et non sit.', '1-632-204-7199', '1-397-833-5308 x4555', 'quibusdam-eveniet-quibusdam-maxime-labore-et-eos', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(11, 11, 'Wilhelm Goyette', 'Ut aliquam quis beatae et consequuntur et ut.', '1-492-554-4096 x096', '1-589-729-6301', 'officiis-aut-ut-iure-sed-harum-quas', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(12, 12, 'Selena Dibbert', 'Velit tempore doloremque dolore aut et perferendis suscipit qui.', '1-418-826-1688', '253-873-3577 x87794', 'vel-qui-beatae-molestiae-necessitatibus-sunt-esse', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(13, 13, 'Dr. Paige Lueilwitz Sr.', 'Enim cumque doloremque dolor culpa voluptas.', '415-641-2318 x79917', '(393) 353-8692 x1546', 'neque-quam-reiciendis-aut-iure-dignissimos-aut-atque', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(14, 14, 'Sidney Quitzon', 'Tenetur enim molestiae dolores possimus ea et explicabo tempore.', '(767) 419-3856 x4067', '1-527-793-5090 x152', 'deserunt-et-adipisci-recusandae-non-repellendus-sunt-qui', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(15, 15, 'Rico Leuschke', 'Esse et in voluptas fuga earum laborum.', '+1 (828) 315-4314', '214.895.1401 x1904', 'natus-ipsam-suscipit-ullam-est-incidunt-architecto', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(16, 16, 'Dr. Colin Cronin III', 'Velit consequatur eum deleniti aut recusandae.', '(737) 275-2940 x37546', '(469) 656-7781 x6398', 'mollitia-laudantium-vitae-rerum-sit-aut-in-qui', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(17, 17, 'Mr. Wilmer Streich', 'Et odit laudantium inventore aliquid labore qui et.', '1-295-259-4884', '581.451.8207 x384', 'aspernatur-sint-ut-culpa', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(18, 18, 'Jerry Muller Sr.', 'Aut recusandae dolores eaque.', '778-248-4217 x162', '(983) 594-7908 x77780', 'et-dolorum-enim-porro-aut-deserunt', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(19, 19, 'Dr. Rolando Hodkiewicz', 'Et et unde occaecati qui nostrum.', '(663) 706-7564', '603.789.7695 x216', 'at-quo-mollitia-enim-sunt-velit-cupiditate', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL),
(20, 20, 'Prof. Coy Murphy', 'Perferendis consequatur blanditiis nihil at temporibus qui.', '951.212.9086 x3981', '+1.910.660.2329', 'ut-modi-itaque-sequi-dignissimos-sunt-eligendi-et', '2020-10-10 05:07:21', '2020-10-10 05:07:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ROLE_USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Nichole Labadie', 'xkrajcik@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'naHT9LWl6iJ9hflZk4bO9cqVw3ymgYqbNrYvUrGIlSAkSYee50fouayKp8lO', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_OWNER'),
(2, 'Merle Gerlach', 'hayley91@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aayNi1XgzPsJRRwlN5Pwnq0L8FmJU5e49ITHgLGaUu4cZ37wage8HeFdBl87', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(3, 'Bertram Bernier', 'wilhelm.beatty@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IBApsvkBTH', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(4, 'Maritza Rempel', 'ostehr@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9A4kH4p7aH', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(5, 'Elwyn Bauch', 'uhessel@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F10OZock0K', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(6, 'Rosalinda Bartell', 'alva77@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mJ1prn3AAB', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(7, 'Karson Bruen', 'kreiger.jorge@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NatBerXDp2', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(8, 'Sydnee Gusikowski', 'tcorwin@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'axRgxCoRhg', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(9, 'Rocio Stark IV', 'nconsidine@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FhhAlstgRc', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(10, 'Dr. Schuyler Kreiger III', 'ethan05@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g8V11O6eiq', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(11, 'Rhea Purdy', 'lilian.sawayn@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ggE6BJLclN', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(12, 'Skye Weber', 'pagac.pierre@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2SCxR3hPbt', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(13, 'Gerard West', 'xchamplin@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'leGZBem6jj', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(14, 'Raheem Haag', 'gavin.schaefer@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ms55vP8s4e', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(15, 'Elijah Mraz', 'gturner@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EeK8C17UOI', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(16, 'Carolyn Treutel', 'joseph55@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DTiYEAvTtV', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(17, 'Miss Elyssa Lind', 'lstracke@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '62ZkQXE4NC', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(18, 'Therese Prosacco MD', 'rosalee.considine@example.org', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UQJqzFWxf6', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(19, 'Damion Stark', 'felicita.stroman@example.net', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'T3tjJ6DASx', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER'),
(20, 'Dr. Haley Mohr MD', 'lconn@example.com', '2020-10-10 05:07:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QOmOZ9Qhxa', '2020-10-10 05:07:21', '2020-10-10 05:07:21', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_orders`
--

CREATE TABLE `user_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagseguro_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagseguro_status` int(11) NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user_orders`
--

INSERT INTO `user_orders` (`id`, `user_id`, `reference`, `pagseguro_code`, `pagseguro_status`, `items`, `created_at`, `updated_at`) VALUES
(1, 2, 'PEDIDO01', 'D1F616E0-50CC-41B5-8B11-87932DFE505E', 1, 'a:1:{i:0;a:5:{s:4:\"name\";s:15:\"Bola de futebol\";s:5:\"price\";s:6:\"150.00\";s:4:\"slug\";s:15:\"bola-de-futebol\";s:6:\"amount\";s:1:\"1\";s:8:\"store_id\";i:1;}}', '2020-10-10 05:24:33', '2020-10-10 05:24:33'),
(2, 2, 'Pedido-0201', '2218F236-CB25-43A4-8423-B9C4B542D66A', 3, 'a:1:{i:1;a:5:{s:4:\"name\";s:15:\"Bola de futebol\";s:5:\"price\";s:6:\"150.00\";s:4:\"slug\";s:15:\"bola-de-futebol\";s:6:\"amount\";s:1:\"1\";s:8:\"store_id\";i:1;}}', '2020-10-14 01:21:50', '2020-10-14 01:42:09'),
(3, 2, '4c0ce885-20e3-43e0-a157-b6865e95b759', '2E0BB8D6-F861-4FD9-8015-4C9B9620CB43', 1, 'a:1:{i:0;a:6:{s:4:\"name\";s:18:\"Brianne Gusikowski\";s:5:\"price\";s:4:\"4.43\";s:4:\"slug\";s:36:\"ut-tenetur-dicta-et-ut-et-distinctio\";s:6:\"amount\";s:2:\"30\";s:2:\"id\";i:19;s:8:\"store_id\";i:19;}}', '2020-10-14 01:50:50', '2020-10-14 01:50:50'),
(4, 2, 'ca708531-b770-4855-9058-5e11d068ac49', 'F335461F-42AA-42BF-B36B-F96D8503F384', 7, 'a:1:{i:0;a:6:{s:4:\"name\";s:15:\"Bola de futebol\";s:5:\"price\";s:6:\"150.00\";s:4:\"slug\";s:15:\"bola-de-futebol\";s:6:\"amount\";s:2:\"10\";s:2:\"id\";i:21;s:8:\"store_id\";i:1;}}', '2020-10-14 02:01:38', '2020-10-14 02:02:33');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `category_product`
--
ALTER TABLE `category_product`
  ADD KEY `category_product_product_id_foreign` (`product_id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`);

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
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Índices para tabela `order_store`
--
ALTER TABLE `order_store`
  ADD KEY `order_store_store_id_foreign` (`store_id`),
  ADD KEY `order_store_order_id_foreign` (`order_id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_store_id_foreign` (`store_id`);

--
-- Índices para tabela `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_photos_product_id_foreign` (`product_id`);

--
-- Índices para tabela `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_user_id_foreign` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_orders_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `order_store`
--
ALTER TABLE `order_store`
  ADD CONSTRAINT `order_store_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `user_orders` (`id`),
  ADD CONSTRAINT `order_store_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `product_photos`
--
ALTER TABLE `product_photos`
  ADD CONSTRAINT `product_photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `user_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
