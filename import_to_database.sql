-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2012 at 06:06 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `faraface_se4`
--

-- --------------------------------------------------------

--
-- Table structure for table `engine4_payment_gateways`
--

DROP TABLE IF EXISTS `engine4_payment_gateways`;
CREATE TABLE IF NOT EXISTS `engine4_payment_gateways` (
  `gateway_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `plugin` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `config` mediumblob,
  `test_mode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`gateway_id`),
  KEY `enabled` (`enabled`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `engine4_payment_gateways`
--

INSERT INTO `engine4_payment_gateways` (`gateway_id`, `title`, `description`, `enabled`, `plugin`, `config`, `test_mode`) VALUES
(1, '2Checkout', NULL, 0, 'Payment_Plugin_Gateway_2Checkout', NULL, 0),
(2, 'PayPal', NULL, 0, 'Payment_Plugin_Gateway_PayPal', 0x7b22757365726e616d65223a22656e2e6a2e74616c65626940676d61696c2e636f6d222c2270617373776f7264223a2231333635343236313233222c227369676e6174757265223a223131313131227d, 0),
(3, 'Testing', NULL, 1, 'Payment_Plugin_Gateway_Testing', NULL, 1),
(4, 'Zarinpal', NULL, 1, 'Payment_Plugin_Gateway_Zarinpal', 0xd644ced8374c2d34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `engine4_payment_products`
--

DROP TABLE IF EXISTS `engine4_payment_products`;
CREATE TABLE IF NOT EXISTS `engine4_payment_products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `extension_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `extension_id` int(10) unsigned DEFAULT NULL,
  `sku` bigint(20) unsigned NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(16,2) unsigned NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `extension_type` (`extension_type`,`extension_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `engine4_payment_products`
--

INSERT INTO `engine4_payment_products` (`product_id`, `extension_type`, `extension_id`, `sku`, `title`, `description`, `price`) VALUES
(1, 'payment_subscription', 1, 882342006, 'تست', 'تست', 1000.00),
(2, 'payment_subscription', 2, 2645429394, 'کاربر طلایی', 'کاربران طلایی دارای فول امکانات سایت هستند و تمامی موارد برای این سطح کاربری فعال می باشد.', 5000.00),
(3, 'payment_subscription', 3, 2171700500, 'کاربر طلایی', 'کاربران این سطح دارای فول امکانات سایت هستند.', 30000.00),
(4, 'payment_subscription', 4, 2826164819, 'کاربر نقره ای', 'کاربران این سطح دارای امکانات کمتری نسبت به کاربران طلایی هستند.', 15000.00),
(5, 'payment_subscription', 5, 36140522, 'کاربر برنزی', 'قیمت این سطح رایگان می باشد.', 0.00),
(6, 'payment_subscription', 6, 4200922924, 'تست', 'تست', 0.00),
(7, 'payment_subscription', 7, 2442680908, 'تست', 'تست', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `zarinpal`
--

DROP TABLE IF EXISTS `zarinpal`;
CREATE TABLE IF NOT EXISTS `zarinpal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `zarinpal`
--

INSERT INTO `zarinpal` (`id`, `mid`, `url`) VALUES
(1, '50b307a7-b5e4-4044-aeb9-5b195ee8aeb5', 'http://www.faraface.com/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
