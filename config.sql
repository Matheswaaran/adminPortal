-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 12, 2018 at 06:36 AM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `IHRM_Database`
--
DROP DATABASE IF EXISTS `IHRM_Database`;
CREATE DATABASE IF NOT EXISTS `IHRM_Database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `IHRM_Database`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `first_name`, `last_name`, `username`, `email_id`, `contact_no`, `password`, `created`) VALUES
(1, 'Rockin', 'MAT', 'mat', 'mat@mat.com', '9025923103', 'r40tXLqSv9m/peVnAhDM+o7JSqE0qbz7S04PNk3qTi4=', '2018-06-11 03:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `aadhar_uid` int(20) NOT NULL DEFAULT '0',
  `aadhar_string` varchar(3000) NOT NULL DEFAULT '0',
  `address_1` varchar (100) NOT NULL,
  `address_2` varchar (100) NOT NULL,
  `district` varchar (100) NOT NULL,
  `state` varchar (100) NOT NULL,
  `pincode` varchar (10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `emp_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `auth` int(2) NOT NULL DEFAULT '0',
  `aadhar_uid` int(20) NOT NULL,
  `aadhar_string` varchar(3000) NOT NULL DEFAULT '0',
  `address_1` varchar (100) NOT NULL,
  `address_2` varchar (100) NOT NULL,
  `district` varchar (100) NOT NULL,
  `state` varchar (100) NOT NULL,
  `pincode` varchar (10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `skill` int(3) NOT NULL,
  `emp_type` int(3) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract_users`
--

CREATE TABLE `contract_users` (
  `contract_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `aadhar_uid` int(20) NOT NULL,
  `aadhar_string` varchar(3000) NOT NULL DEFAULT '0',
  `address_1` varchar (100) NOT NULL,
  `address_2` varchar (100) NOT NULL,
  `district` varchar (100) NOT NULL,
  `state` varchar (100) NOT NULL,
  `pincode` varchar (10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pkg_contract_users`
--

CREATE TABLE `pkg_contract_users` (
  `pkg_contract_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `aadhar_uid` int(20) NOT NULL,
  `aadhar_string` varchar(3000) NOT NULL DEFAULT '0',
  `address_1` varchar (100) NOT NULL,
  `address_2` varchar (100) NOT NULL,
  `district` varchar (100) NOT NULL,
  `state` varchar (100) NOT NULL,
  `pincode` varchar (10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
