-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2025 at 11:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rarity` enum('Common','Rare','Epic','Legendary','Champion') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `elixir` int DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `rarity`, `image_url`, `page_url`, `created_at`, `updated_at`, `elixir`) VALUES
(1, 'Knight', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/knight.png', 'https://royaleapi.com/card/knight', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(2, 'Archers', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/archers.png', 'https://royaleapi.com/card/archers', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(3, 'Goblins', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblins.png', 'https://royaleapi.com/card/goblins', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(4, 'Giant', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/giant.png', 'https://royaleapi.com/card/giant', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(5, 'P.E.K.K.A', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v8-7d088998/pekka.png', 'https://royaleapi.com/card/p-e-k-k-a', '2025-11-13 13:41:28', '2025-11-13 14:59:51', 7),
(6, 'Minions', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/minions.png', 'https://royaleapi.com/card/minions', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(7, 'Balloon', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/balloon.png', 'https://royaleapi.com/card/balloon', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(8, 'Witch', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/witch.png', 'https://royaleapi.com/card/witch', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(9, 'Barbarians', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/barbarians.png', 'https://royaleapi.com/card/barbarians', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(10, 'Golem', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/golem.png', 'https://royaleapi.com/card/golem', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 8),
(11, 'Skeletons', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/skeletons.png', 'https://royaleapi.com/card/skeletons', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 1),
(12, 'Valkyrie', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/valkyrie.png', 'https://royaleapi.com/card/valkyrie', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(13, 'Skeleton Army', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/skeleton-army.png', 'https://royaleapi.com/card/skeleton-army', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(14, 'Bomber', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/bomber.png', 'https://royaleapi.com/card/bomber', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(15, 'Musketeer', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/musketeer.png', 'https://royaleapi.com/card/musketeer', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(16, 'Baby Dragon', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/baby-dragon.png', 'https://royaleapi.com/card/baby-dragon', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(17, 'Prince', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/prince.png', 'https://royaleapi.com/card/prince', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(18, 'Wizard', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/wizard.png', 'https://royaleapi.com/card/wizard', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(19, 'Mini P.E.K.K.A', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v8-7d088998/mini-pekka.png', 'https://royaleapi.com/card/mini-p-e-k-k-a', '2025-11-13 13:41:28', '2025-11-13 14:58:18', 4),
(20, 'Giant Skeleton', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/giant-skeleton.png', 'https://royaleapi.com/card/giant-skeleton', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(21, 'Hog Rider', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/hog-rider.png', 'https://royaleapi.com/card/hog-rider', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(22, 'Minion Horde', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/minion-horde.png', 'https://royaleapi.com/card/minion-horde', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(23, 'Ice Wizard', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/ice-wizard.png', 'https://royaleapi.com/card/ice-wizard', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(24, 'Royal Giant', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/royal-giant.png', 'https://royaleapi.com/card/royal-giant', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(25, 'Guards', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/guards.png', 'https://royaleapi.com/card/guards', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(26, 'Princess', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/princess.png', 'https://royaleapi.com/card/princess', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(27, 'Dark Prince', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/dark-prince.png', 'https://royaleapi.com/card/dark-prince', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(28, 'Three Musketeers', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/three-musketeers.png', 'https://royaleapi.com/card/three-musketeers', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 9),
(29, 'Lava Hound', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/lava-hound.png', 'https://royaleapi.com/card/lava-hound', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 7),
(30, 'Ice Spirit', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/ice-spirit.png', 'https://royaleapi.com/card/ice-spirit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 1),
(31, 'Fire Spirit', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/fire-spirit.png', 'https://royaleapi.com/card/fire-spirit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 1),
(32, 'Miner', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/miner.png', 'https://royaleapi.com/card/miner', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(33, 'Sparky', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/sparky.png', 'https://royaleapi.com/card/sparky', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(34, 'Bowler', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/bowler.png', 'https://royaleapi.com/card/bowler', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(35, 'Lumberjack', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/lumberjack.png', 'https://royaleapi.com/card/lumberjack', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(36, 'Ice Golem', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/ice-golem.png', 'https://royaleapi.com/card/ice-golem', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(37, 'Mega Minion', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mega-minion.png', 'https://royaleapi.com/card/mega-minion', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(38, 'Dart Goblin', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/dart-goblin.png', 'https://royaleapi.com/card/dart-goblin', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(39, 'Goblin Barrel', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-barrel.png', 'https://royaleapi.com/card/goblin-barrel', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(40, 'Tornado', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/tornado.png', 'https://royaleapi.com/card/tornado', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(41, 'Clone', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/clone.png', 'https://royaleapi.com/card/clone', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(42, 'Executioner', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/executioner.png', 'https://royaleapi.com/card/executioner', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(43, 'Bandit', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/bandit.png', 'https://royaleapi.com/card/bandit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(44, 'Electro Wizard', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/electro-wizard.png', 'https://royaleapi.com/card/electro-wizard', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(45, 'Night Witch', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/night-witch.png', 'https://royaleapi.com/card/night-witch', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(46, 'Inferno Dragon', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/inferno-dragon.png', 'https://royaleapi.com/card/inferno-dragon', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(47, 'Graveyard', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/graveyard.png', 'https://royaleapi.com/card/graveyard', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(48, 'The Log', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/the-log.png', 'https://royaleapi.com/card/the-log', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(49, 'Arrows', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/arrows.png', 'https://royaleapi.com/card/arrows', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(50, 'Fireball', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/fireball.png', 'https://royaleapi.com/card/fireball', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(51, 'Zap', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/zap.png', 'https://royaleapi.com/card/zap', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(52, 'Poison', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/poison.png', 'https://royaleapi.com/card/poison', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(53, 'Freeze', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/freeze.png', 'https://royaleapi.com/card/freeze', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(54, 'Mirror', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mirror.png', 'https://royaleapi.com/card/mirror', '2025-11-13 13:41:28', '2025-11-13 14:50:52', -1),
(55, 'Rage', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/rage.png', 'https://royaleapi.com/card/rage', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(56, 'Lightning', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/lightning.png', 'https://royaleapi.com/card/lightning', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(57, 'Rocket', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/rocket.png', 'https://royaleapi.com/card/rocket', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(58, 'Goblin Hut', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-hut.png', 'https://royaleapi.com/card/goblin-hut', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(59, 'Cannon', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/cannon.png', 'https://royaleapi.com/card/cannon', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(60, 'X-Bow', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/x-bow.png', 'https://royaleapi.com/card/x-bow', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(61, 'Tesla', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/tesla.png', 'https://royaleapi.com/card/tesla', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(62, 'Elixir Collector', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/elixir-collector.png', 'https://royaleapi.com/card/elixir-collector', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(63, 'Inferno Tower', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/inferno-tower.png', 'https://royaleapi.com/card/inferno-tower', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(64, 'Bomb Tower', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/bomb-tower.png', 'https://royaleapi.com/card/bomb-tower', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(65, 'Barbarian Hut', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/barbarian-hut.png', 'https://royaleapi.com/card/barbarian-hut', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 7),
(66, 'Mortar', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mortar.png', 'https://royaleapi.com/card/mortar', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(67, 'Furnace', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/furnace.png', 'https://royaleapi.com/card/furnace', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(68, 'Tombstone', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/tombstone.png', 'https://royaleapi.com/card/tombstone', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(69, 'Royal Recruits', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/royal-recruits.png', 'https://royaleapi.com/card/royal-recruits', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 6),
(70, 'Ram Rider', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/ram-rider.png', 'https://royaleapi.com/card/ram-rider', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(71, 'Magic Archer', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/magic-archer.png', 'https://royaleapi.com/card/magic-archer', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(72, 'Rascals', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/rascals.png', 'https://royaleapi.com/card/rascals', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(73, 'Cannon Cart', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/cannon-cart.png', 'https://royaleapi.com/card/cannon-cart', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(74, 'Mega Knight', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mega-knight.png', 'https://royaleapi.com/card/mega-knight', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 7),
(75, 'Skeleton Barrel', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/skeleton-barrel.png', 'https://royaleapi.com/card/skeleton-barrel', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(76, 'Flying Machine', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/flying-machine.png', 'https://royaleapi.com/card/flying-machine', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(77, 'Wall Breakers', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/wall-breakers.png', 'https://royaleapi.com/card/wall-breakers', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(78, 'Battle Ram', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/battle-ram.png', 'https://royaleapi.com/card/battle-ram', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(79, 'Zappies', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/zappies.png', 'https://royaleapi.com/card/zappies', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(80, 'Goblin Gang', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-gang.png', 'https://royaleapi.com/card/goblin-gang', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(81, 'Spear Goblins', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/spear-goblins.png', 'https://royaleapi.com/card/spear-goblins', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(82, 'Bats', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/bats.png', 'https://royaleapi.com/card/bats', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(83, 'Royal Ghost', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/royal-ghost.png', 'https://royaleapi.com/card/royal-ghost', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(84, 'Hunter', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/hunter.png', 'https://royaleapi.com/card/hunter', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(85, 'Electro Dragon', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/electro-dragon.png', 'https://royaleapi.com/card/electro-dragon', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(86, 'Barbarian Barrel', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/barbarian-barrel.png', 'https://royaleapi.com/card/barbarian-barrel', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(87, 'Goblin Cage', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-cage.png', 'https://royaleapi.com/card/goblin-cage', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(88, 'Elixir Golem', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/elixir-golem.png', 'https://royaleapi.com/card/elixir-golem', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(89, 'Battle Healer', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/battle-healer.png', 'https://royaleapi.com/card/battle-healer', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(90, 'Firecracker', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/firecracker.png', 'https://royaleapi.com/card/firecracker', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(91, 'Royal Delivery', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/royal-delivery.png', 'https://royaleapi.com/card/royal-delivery', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(92, 'Heal Spirit', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/heal-spirit.png', 'https://royaleapi.com/card/heal-spirit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 1),
(93, 'Skeleton Dragons', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/skeleton-dragons.png', 'https://royaleapi.com/card/skeleton-dragons', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(94, 'Mother Witch', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mother-witch.png', 'https://royaleapi.com/card/mother-witch', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(95, 'Electro Spirit', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/electro-spirit.png', 'https://royaleapi.com/card/electro-spirit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 1),
(96, 'Electro Giant', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/electro-giant.png', 'https://royaleapi.com/card/electro-giant', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 8),
(97, 'Goblin Drill', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-drill.png', 'https://royaleapi.com/card/goblin-drill', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(98, 'Archer Queen', 'Champion', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/archer-queen.png', 'https://royaleapi.com/card/archer-queen', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(99, 'Golden Knight', 'Champion', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/golden-knight.png', 'https://royaleapi.com/card/golden-knight', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(100, 'Skeleton King', 'Champion', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/skeleton-king.png', 'https://royaleapi.com/card/skeleton-king', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(101, 'Mighty Miner', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/mighty-miner.png', 'https://royaleapi.com/card/mighty-miner', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(102, 'Phoenix', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/phoenix.png', 'https://royaleapi.com/card/phoenix', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(103, 'Monk', 'Champion', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/monk.png', 'https://royaleapi.com/card/monk', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(104, 'Little Prince', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/little-prince.png', 'https://royaleapi.com/card/little-prince', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(105, 'Dagger Duchess', 'Champion', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/dagger-duchess.png', 'https://royaleapi.com/card/dagger-duchess', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(106, 'Goblin Machine', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-machine.png', 'https://royaleapi.com/card/goblin-machine', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(107, 'Goblin Curse', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-curse.png', 'https://royaleapi.com/card/goblin-curse', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(108, 'Cannoneer', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/cannoneer.png', 'https://royaleapi.com/card/cannoneer', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(109, 'Spirit Empress', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/spirit-empress.png', 'https://royaleapi.com/card/spirit-empress', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(110, 'Royal Chef', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/royal-chef.png', 'https://royaleapi.com/card/royal-chef', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(111, 'Tower Princess', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/tower-princess.png', 'https://royaleapi.com/card/tower-princess', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(112, 'Boss Bandit', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/boss-bandit.png', 'https://royaleapi.com/card/boss-bandit', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(113, 'Goblin Demolisher', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblin-demolisher.png', 'https://royaleapi.com/card/goblin-demolisher', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(114, 'Goblinstein', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/goblinstein.png', 'https://royaleapi.com/card/goblinstein', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 5),
(115, 'Suspicious Bush', 'Legendary', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/suspicious-bush.png', 'https://royaleapi.com/card/suspicious-bush', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2),
(116, 'Void', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/void.png', 'https://royaleapi.com/card/void', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(117, 'Berserker', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/berserker.png', 'https://royaleapi.com/card/berserker', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(118, 'Rune Giant', 'Epic', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/rune-giant.png', 'https://royaleapi.com/card/rune-giant', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 4),
(119, 'Earthquake', 'Rare', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/earthquake.png', 'https://royaleapi.com/card/earthquake', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 3),
(120, 'Giant Snowball', 'Common', 'https://cdns3.royaleapi.com/cdn-cgi/image/w=150,h=180,format=auto/static/img/cards/v6-aa179c9e/giant-snowball.png', 'https://royaleapi.com/card/giant-snowball', '2025-11-13 13:41:28', '2025-11-13 13:41:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `decks`
--

CREATE TABLE `decks` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT 'Deck',
  `is_favorite` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `decks`
--

INSERT INTO `decks` (`id`, `user_id`, `name`, `is_favorite`, `created_at`) VALUES
(1, 5, 'Deck 1', 0, '2025-10-28 09:10:57'),
(2, 5, 'Deck 2', 1, '2025-10-28 09:10:57'),
(3, 5, 'Deck 3', 0, '2025-10-28 09:10:57'),
(4, 5, 'Deck 4', 0, '2025-10-28 09:10:57'),
(5, 5, 'Deck 5', 0, '2025-10-28 09:10:57'),
(6, 5, 'Deck 6', 0, '2025-10-28 09:10:57'),
(7, 5, 'Deck 7', 0, '2025-10-28 09:10:57'),
(8, 5, 'Deck 8', 0, '2025-10-28 09:10:57'),
(9, 5, 'Deck 9', 0, '2025-10-28 09:10:57'),
(10, 5, 'Deck 10', 0, '2025-10-28 09:10:57'),
(11, 6, 'Deck 1', 0, '2025-10-28 09:14:05'),
(12, 6, 'Deck 2', 0, '2025-10-28 09:14:05'),
(13, 6, 'Deck 3\r\n', 1, '2025-10-28 09:14:05'),
(14, 6, 'Deck 4', 0, '2025-10-28 09:14:05'),
(15, 6, 'Deck 5', 0, '2025-10-28 09:14:05'),
(16, 6, 'Deck 6', 0, '2025-10-28 09:14:05'),
(17, 6, 'Deck 7', 0, '2025-10-28 09:14:05'),
(18, 6, 'Deck 8', 0, '2025-10-28 09:14:05'),
(19, 6, 'Deck 9', 0, '2025-10-28 09:14:05'),
(20, 6, 'Deck 10', 0, '2025-10-28 09:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `deck_cards`
--

CREATE TABLE `deck_cards` (
  `deck_id` int UNSIGNED NOT NULL,
  `card_id` int UNSIGNED NOT NULL,
  `position` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deck_cards`
--

INSERT INTO `deck_cards` (`deck_id`, `card_id`, `position`) VALUES
(1, 6, 3),
(1, 22, 2),
(1, 35, 1),
(1, 45, 7),
(1, 66, 5),
(1, 72, 8),
(1, 94, 6),
(1, 103, 4),
(2, 17, 5),
(2, 25, 4),
(2, 38, 1),
(2, 39, 3),
(2, 48, 8),
(2, 57, 7),
(2, 72, 6),
(2, 90, 2),
(3, 2, 2),
(3, 7, 5),
(3, 16, 4),
(3, 43, 6),
(3, 49, 3),
(3, 65, 8),
(3, 86, 7),
(3, 98, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deck_id` int UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `likes` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `deck_id`, `title`, `description`, `likes`, `created_at`) VALUES
(14, 5, 1, 'gargouille', 'test desc', 3, '2025-11-24 19:24:10'),
(17, 5, 2, 'Deck Fripons Meta', 'Pas de batiment, faites attention aux cochons', 1, '2025-11-27 14:53:39'),
(18, 5, 3, 'Test de post', 'Agressif', 1, '2025-11-28 10:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `user_id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`user_id`, `post_id`) VALUES
(5, 14),
(10, 14),
(5, 17),
(10, 18);

-- --------------------------------------------------------

--
-- Table structure for table `signalements`
--

CREATE TABLE `signalements` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'Utilisateur signalé',
  `reporter_id` int UNSIGNED NOT NULL COMMENT 'Utilisateur qui signale',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Description détaillée du signalement',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signalements`
--

INSERT INTO `signalements` (`id`, `user_id`, `reporter_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 'charles', '2025-11-06 14:05:44', '2025-11-06 14:05:44'),
(2, 6, 5, 'test', '2025-11-08 11:00:41', '2025-11-08 11:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','membre') DEFAULT 'membre',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `pseudo`, `password`, `role`, `created_at`, `is_delete`) VALUES
(5, 'Guilbert', 'Maxime', 'maximeg', '$2y$10$mcX1NPy75N3BRJveMTvB7.h3fBN2bUyWOu5ZXxckLf5BvGB97Zez2', 'admin', '2025-10-27 14:34:15', 0),
(6, 'testnom', 'testprenom', 'testpseudo', '$2y$10$OU2rlPDa/G0BQWIA3uY5Q.xG9WAEHXeyA9hYpeYOHdfOgRbgJcv/m', 'membre', '2025-10-27 17:17:05', 0),
(9, 'admin', 'admin', 'admin', '$2y$10$jcWgZ4CzwXwOh2l0e11gt.s9ERP3C1bWS/IqyL27ni9ItEfIo5AS.', 'admin', '2025-12-03 12:09:39', 0),
(10, 'user', 'user', 'user', '$2y$10$oW4S7q7yaue9X7R15ItWIOftsY2XhnwlEkaWcXzd7bM3Y26XQatQe', 'membre', '2025-12-07 11:21:56', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_cards_name` (`name`);

--
-- Indexes for table `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deck_cards`
--
ALTER TABLE `deck_cards`
  ADD PRIMARY KEY (`deck_id`,`card_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `deck_id` (`deck_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `signalements`
--
ALTER TABLE `signalements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_unique_report` (`reporter_id`,`user_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_reporter_id` (`reporter_id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `decks`
--
ALTER TABLE `decks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `signalements`
--
ALTER TABLE `signalements`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `decks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deck_cards`
--
ALTER TABLE `deck_cards`
  ADD CONSTRAINT `deck_cards_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deck_cards_ibfk_2` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `signalements`
--
ALTER TABLE `signalements`
  ADD CONSTRAINT `fk_signalements_reporter` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_signalements_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
