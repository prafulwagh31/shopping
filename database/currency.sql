-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2021 at 06:36 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`, `status`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek', ''),
(2, 'America', 'Dollars', 'USD', '$', ''),
(3, 'Afghanistan', 'Afghanis', 'AFN', '?', ''),
(4, 'Argentina', 'Pesos', 'ARS', '$', ''),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ', ''),
(6, 'Australia', 'Dollars', 'AUD', '$', ''),
(7, 'Azerbaijan', 'New Manats', 'AZN', '???', ''),
(8, 'Bahamas', 'Dollars', 'BSD', '$', ''),
(9, 'Barbados', 'Dollars', 'BBD', '$', ''),
(10, 'Belarus', 'Rubles', 'BYR', 'p.', ''),
(11, 'Belgium', 'Euro', 'EUR', '€', ''),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$', ''),
(13, 'Bermuda', 'Dollars', 'BMD', '$', ''),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b', ''),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM', ''),
(16, 'Botswana', 'Pula', 'BWP', 'P', ''),
(17, 'Bulgaria', 'Leva', 'BGN', '??', ''),
(18, 'Brazil', 'Reais', 'BRL', 'R$', ''),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£', '1'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$', ''),
(21, 'Cambodia', 'Riels', 'KHR', '?', ''),
(22, 'Canada', 'Dollars', 'CAD', '$', ''),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$', ''),
(24, 'Chile', 'Pesos', 'CLP', '$', ''),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥', ''),
(26, 'Colombia', 'Pesos', 'COP', '$', ''),
(27, 'Costa Rica', 'Colón', 'CRC', '?', ''),
(28, 'Croatia', 'Kuna', 'HRK', 'kn', ''),
(29, 'Cuba', 'Pesos', 'CUP', '?', ''),
(30, 'Cyprus', 'Euro', 'EUR', '€', ''),
(31, 'Czech Republic', 'Koruny', 'CZK', 'K?', ''),
(32, 'Denmark', 'Kroner', 'DKK', 'kr', ''),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$', ''),
(34, 'East Caribbean', 'Dollars', 'XCD', '$', ''),
(35, 'Egypt', 'Pounds', 'EGP', '£', ''),
(36, 'El Salvador', 'Colones', 'SVC', '$', ''),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£', ''),
(38, 'Euro', 'Euro', 'EUR', '€', ''),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£', ''),
(40, 'Fiji', 'Dollars', 'FJD', '$', ''),
(41, 'France', 'Euro', 'EUR', '€', ''),
(42, 'Ghana', 'Cedis', 'GHC', '¢', ''),
(43, 'Gibraltar', 'Pounds', 'GIP', '£', ''),
(44, 'Greece', 'Euro', 'EUR', '€', ''),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q', ''),
(46, 'Guernsey', 'Pounds', 'GGP', '£', ''),
(47, 'Guyana', 'Dollars', 'GYD', '$', ''),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€', ''),
(49, 'Honduras', 'Lempiras', 'HNL', 'L', ''),
(50, 'Hong Kong', 'Dollars', 'HKD', '$', ''),
(51, 'Hungary', 'Forint', 'HUF', 'Ft', ''),
(52, 'Iceland', 'Kronur', 'ISK', 'kr', ''),
(53, 'India', 'Rupees', 'INR', 'Rp', ''),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp', ''),
(55, 'Iran', 'Rials', 'IRR', '?', ''),
(56, 'Ireland', 'Euro', 'EUR', '€', ''),
(57, 'Isle of Man', 'Pounds', 'IMP', '£', ''),
(58, 'Israel', 'New Shekels', 'ILS', '?', ''),
(59, 'Italy', 'Euro', 'EUR', '€', ''),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$', ''),
(61, 'Japan', 'Yen', 'JPY', '¥', ''),
(62, 'Jersey', 'Pounds', 'JEP', '£', ''),
(63, 'Kazakhstan', 'Tenge', 'KZT', '??', ''),
(64, 'Korea (North)', 'Won', 'KPW', '?', ''),
(65, 'Korea (South)', 'Won', 'KRW', '?', ''),
(66, 'Kyrgyzstan', 'Soms', 'KGS', '??', ''),
(67, 'Laos', 'Kips', 'LAK', '?', ''),
(68, 'Latvia', 'Lati', 'LVL', 'Ls', ''),
(69, 'Lebanon', 'Pounds', 'LBP', '£', ''),
(70, 'Liberia', 'Dollars', 'LRD', '$', ''),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF', ''),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt', ''),
(73, 'Luxembourg', 'Euro', 'EUR', '€', ''),
(74, 'Macedonia', 'Denars', 'MKD', '???', ''),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM', ''),
(76, 'Malta', 'Euro', 'EUR', '€', ''),
(77, 'Mauritius', 'Rupees', 'MUR', '?', ''),
(78, 'Mexico', 'Pesos', 'MXN', '$', ''),
(79, 'Mongolia', 'Tugriks', 'MNT', '?', ''),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT', ''),
(81, 'Namibia', 'Dollars', 'NAD', '$', ''),
(82, 'Nepal', 'Rupees', 'NPR', '?', ''),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ', ''),
(84, 'Netherlands', 'Euro', 'EUR', '€', ''),
(85, 'New Zealand', 'Dollars', 'NZD', '$', ''),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$', ''),
(87, 'Nigeria', 'Nairas', 'NGN', '?', ''),
(88, 'North Korea', 'Won', 'KPW', '?', ''),
(89, 'Norway', 'Krone', 'NOK', 'kr', ''),
(90, 'Oman', 'Rials', 'OMR', '?', ''),
(91, 'Pakistan', 'Rupees', 'PKR', '?', ''),
(92, 'Panama', 'Balboa', 'PAB', 'B/.', ''),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs', ''),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.', ''),
(95, 'Philippines', 'Pesos', 'PHP', 'Php', ''),
(96, 'Poland', 'Zlotych', 'PLN', 'z?', ''),
(97, 'Qatar', 'Rials', 'QAR', '?', ''),
(98, 'Romania', 'New Lei', 'RON', 'lei', ''),
(99, 'Russia', 'Rubles', 'RUB', '???', ''),
(100, 'Saint Helena', 'Pounds', 'SHP', '£', ''),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '?', ''),
(102, 'Serbia', 'Dinars', 'RSD', '???.', ''),
(103, 'Seychelles', 'Rupees', 'SCR', '?', ''),
(104, 'Singapore', 'Dollars', 'SGD', '$', ''),
(105, 'Slovenia', 'Euro', 'EUR', '€', ''),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$', ''),
(107, 'Somalia', 'Shillings', 'SOS', 'S', ''),
(108, 'South Africa', 'Rand', 'ZAR', 'R', ''),
(109, 'South Korea', 'Won', 'KRW', '?', ''),
(110, 'Spain', 'Euro', 'EUR', '€', ''),
(111, 'Sri Lanka', 'Rupees', 'LKR', '?', ''),
(112, 'Sweden', 'Kronor', 'SEK', 'kr', ''),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF', ''),
(114, 'Suriname', 'Dollars', 'SRD', '$', ''),
(115, 'Syria', 'Pounds', 'SYP', '£', ''),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$', ''),
(117, 'Thailand', 'Baht', 'THB', '?', ''),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$', ''),
(119, 'Turkey', 'Lira', 'TRY', 'TL', ''),
(120, 'Turkey', 'Liras', 'TRL', '£', ''),
(121, 'Tuvalu', 'Dollars', 'TVD', '$', ''),
(122, 'Ukraine', 'Hryvnia', 'UAH', '?', ''),
(123, 'United Kingdom', 'Pounds', 'GBP', '£', ''),
(124, 'United States of America', 'Dollars', 'USD', '$', ''),
(125, 'Uruguay', 'Pesos', 'UYU', '$U', ''),
(126, 'Uzbekistan', 'Sums', 'UZS', '??', ''),
(127, 'Vatican City', 'Euro', 'EUR', '€', ''),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs', ''),
(129, 'Vietnam', 'Dong', 'VND', '?', ''),
(130, 'Yemen', 'Rials', 'YER', '?', ''),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$', ''),
(132, 'India', 'Rupees', 'INR', '?', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;