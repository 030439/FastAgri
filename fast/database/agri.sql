-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 06:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agri`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `FasalName` varchar(255) DEFAULT NULL,
  `SeedQuality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `FasalName`, `SeedQuality`) VALUES
(1, 'Wheat', 'High'),
(2, 'Rice', 'Medium'),
(3, 'Barley', 'Low'),
(4, 'Maize', 'High'),
(5, 'Soybean', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `comapny` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `Name`, `comapny`, `contact`, `cnic`, `Address`) VALUES
(1, 'ABC Inc.', 'ABC Company', '123-456-7890', '12345-67890', '123 Customer St'),
(2, 'XYZ Corp.', 'XYZ Company', '987-654-3210', '54321-09876', '456 Client St'),
(3, 'PQR Ltd.', 'PQR Company', '555-555-5555', '98765-43210', '789 Buyer St'),
(4, 'LMN Co.', 'LMN Company', '111-222-3333', '24680-13579', '321 Retailer St'),
(5, 'EFG Enterprises', 'EFG Company', '999-888-7777', '13579-02468', '654 Consumer St');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `Name`) VALUES
(1, 'Manager'),
(2, 'Supervisor'),
(3, 'Clerk'),
(4, 'Technician'),
(5, 'Assistant');

-- --------------------------------------------------------

--
-- Table structure for table `directsale`
--

CREATE TABLE `directsale` (
  `id` int(11) NOT NULL,
  `stocke_id` int(11) DEFAULT NULL,
  `PqId` int(11) DEFAULT NULL,
  `Rate` decimal(18,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `TotalAmount` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directsale`
--

INSERT INTO `directsale` (`id`, `stocke_id`, `PqId`, `Rate`, `Quantity`, `Amount`, `TotalAmount`) VALUES
(1, 1, 1, 12.50, 50, 625.00, 650.00),
(2, 2, 2, 15.00, 25, 375.00, 400.00),
(3, 3, 3, 20.00, 30, 600.00, 625.00),
(4, 4, 4, 25.00, 10, 250.00, 265.00),
(5, 5, 5, 8.00, 15, 120.00, 135.00);

-- --------------------------------------------------------

--
-- Table structure for table `employeecategory`
--

CREATE TABLE `employeecategory` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeecategory`
--

INSERT INTO `employeecategory` (`id`, `Name`) VALUES
(1, 'Full Time'),
(2, 'Part Time'),
(3, 'Contractual'),
(4, 'Intern'),
(5, 'Consultant');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_cat_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FatherName` varchar(255) DEFAULT NULL,
  `Nic` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactNo` varchar(20) DEFAULT NULL,
  `BasicSalary` decimal(18,2) DEFAULT NULL,
  `Allowances` decimal(18,2) DEFAULT NULL,
  `Medical` decimal(18,2) DEFAULT NULL,
  `PerLabourRate` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_cat_id`, `designation_id`, `Name`, `FatherName`, `Nic`, `Address`, `ContactNo`, `BasicSalary`, `Allowances`, `Medical`, `PerLabourRate`) VALUES
(1, 1, 1, 'John Doe', 'Michael Doe', '12345-67890', '123 Main St', '123-456-7890', 50000.00, 5000.00, 2000.00, 20.00),
(2, 2, 2, 'Jane Smith', 'Sarah Smith', '54321-09876', '456 Elm St', '987-654-3210', 40000.00, 4000.00, 1500.00, 15.00),
(3, 3, 3, 'Alice Johnson', 'David Johnson', '98765-43210', '789 Oak St', '555-555-5555', 35000.00, 3500.00, 1200.00, 12.00),
(4, 4, 4, 'Bob Brown', 'Robert Brown', '24680-13579', '321 Maple St', '111-222-3333', 30000.00, 3000.00, 1000.00, 10.00),
(5, 5, 5, 'Emma Davis', 'Daniel Davis', '13579-02468', '654 Pine St', '999-888-7777', 25000.00, 2500.00, 800.00, 8.00);

-- --------------------------------------------------------

--
-- Table structure for table `gatepasses`
--

CREATE TABLE `gatepasses` (
  `id` int(11) NOT NULL,
  `SellId` int(11) DEFAULT NULL,
  `DriverName` varchar(255) DEFAULT NULL,
  `DriverContactNo` varchar(20) DEFAULT NULL,
  `VehicleRegNo` varchar(255) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gatepasses`
--

INSERT INTO `gatepasses` (`id`, `SellId`, `DriverName`, `DriverContactNo`, `VehicleRegNo`, `Date`) VALUES
(1, 1, 'John Smith', '123-456-7890', 'ABC123', '2023-01-01 00:00:00'),
(2, 2, 'Jane Doe', '987-654-3210', 'XYZ456', '2023-01-02 00:00:00'),
(3, 3, 'Alice Johnson', '555-555-5555', 'PQR789', '2023-01-03 00:00:00'),
(4, 4, 'Bob Brown', '111-222-3333', 'LMN987', '2023-01-04 00:00:00'),
(5, 5, 'Emma Davis', '999-888-7777', 'EFG654', '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gpdetail`
--

CREATE TABLE `gpdetail` (
  `id` int(11) NOT NULL,
  `GpId` int(11) DEFAULT NULL,
  `SellId` int(11) DEFAULT NULL,
  `DriverName` varchar(255) DEFAULT NULL,
  `DriverContactNo` varchar(20) DEFAULT NULL,
  `VehicleRegNo` varchar(255) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gpdetail`
--

INSERT INTO `gpdetail` (`id`, `GpId`, `SellId`, `DriverName`, `DriverContactNo`, `VehicleRegNo`, `Date`) VALUES
(1, 1, 1, 'John Smith', '123-456-7890', 'ABC123', '2023-01-01 00:00:00'),
(2, 2, 2, 'Jane Doe', '987-654-3210', 'XYZ456', '2023-01-02 00:00:00'),
(3, 3, 3, 'Alice Johnson', '555-555-5555', 'PQR789', '2023-01-03 00:00:00'),
(4, 4, 4, 'Bob Brown', '111-222-3333', 'LMN987', '2023-01-04 00:00:00'),
(5, 5, 5, 'Emma Davis', '999-888-7777', 'EFG654', '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `Name`) VALUES
(1, 'Grade A'),
(2, 'Grade B'),
(3, 'Grade C'),
(4, 'Grade D'),
(5, 'Grade E');

-- --------------------------------------------------------

--
-- Table structure for table `issuestock`
--

CREATE TABLE `issuestock` (
  `id` int(11) NOT NULL,
  `PqId` int(11) DEFAULT NULL,
  `empoyee_id` int(11) DEFAULT NULL,
  `tunnel_id` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuestock`
--

INSERT INTO `issuestock` (`id`, `PqId`, `empoyee_id`, `tunnel_id`, `Quantity`) VALUES
(1, 1, 1, 1, 50),
(2, 2, 2, 2, 25),
(3, 3, 3, 3, 30),
(4, 4, 4, 4, 10),
(5, 5, 5, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

CREATE TABLE `productions` (
  `id` int(11) NOT NULL,
  `TunnelId` int(11) DEFAULT NULL,
  `UnitId` int(11) DEFAULT NULL,
  `CropId` int(11) DEFAULT NULL,
  `GradeId` int(11) DEFAULT NULL,
  `Bags` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productions`
--

INSERT INTO `productions` (`id`, `TunnelId`, `UnitId`, `CropId`, `GradeId`, `Bags`, `Quantity`) VALUES
(1, 1, 1, 1, 1, 100, 1000),
(2, 2, 2, 2, 2, 50, 500),
(3, 3, 3, 3, 3, 75, 750),
(4, 4, 4, 4, 4, 25, 250),
(5, 5, 5, 5, 5, 30, 300);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Name`, `unit_id`) VALUES
(1, 'Wheat', 1),
(2, 'Rice', 1),
(3, 'Sugar', 2),
(4, 'Milk', 3),
(5, 'Eggs', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchasequantity`
--

CREATE TABLE `purchasequantity` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `RemainingQuantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasequantity`
--

INSERT INTO `purchasequantity` (`id`, `purchase_id`, `RemainingQuantity`) VALUES
(1, 1, 100),
(2, 2, 50),
(3, 3, 75),
(4, 4, 25),
(5, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product__id` int(11) DEFAULT NULL,
  `Supplier_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `expenses` decimal(18,2) DEFAULT NULL,
  `total_amount` decimal(18,2) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product__id`, `Supplier_id`, `quantity`, `rate`, `amount`, `expenses`, `total_amount`, `Date`) VALUES
(1, 1, 1, 100, 10.00, 1000.00, 50.00, 1050.00, '2023-01-01 00:00:00'),
(2, 2, 2, 50, 20.00, 1000.00, 25.00, 1025.00, '2023-01-02 00:00:00'),
(3, 3, 3, 75, 15.00, 1125.00, 30.00, 1155.00, '2023-01-03 00:00:00'),
(4, 4, 4, 25, 30.00, 750.00, 15.00, 765.00, '2023-01-04 00:00:00'),
(5, 5, 5, 30, 5.00, 150.00, 10.00, 160.00, '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roll` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roll`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Employee'),
(4, 'Customer'),
(5, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `selldetails`
--

CREATE TABLE `selldetails` (
  `id` int(11) NOT NULL,
  `SellId` int(11) DEFAULT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `ProductionId` int(11) DEFAULT NULL,
  `GradeId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Rate` decimal(18,2) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `Labour` decimal(18,2) DEFAULT NULL,
  `Freight` decimal(18,2) DEFAULT NULL,
  `NetAmount` decimal(18,2) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selldetails`
--

INSERT INTO `selldetails` (`id`, `SellId`, `CustomerId`, `ProductionId`, `GradeId`, `Quantity`, `Rate`, `Amount`, `Labour`, `Freight`, `NetAmount`, `Date`) VALUES
(1, 1, 1, 1, 1, 50, 15.00, 750.00, 25.00, 10.00, 765.00, '2023-01-01 00:00:00'),
(2, 2, 2, 2, 2, 25, 20.00, 500.00, 15.00, 5.00, 520.00, '2023-01-02 00:00:00'),
(3, 3, 3, 3, 3, 30, 25.00, 750.00, 20.00, 15.00, 785.00, '2023-01-03 00:00:00'),
(4, 4, 4, 4, 4, 10, 30.00, 300.00, 10.00, 5.00, 315.00, '2023-01-04 00:00:00'),
(5, 5, 5, 5, 5, 15, 8.00, 120.00, 8.00, 5.00, 125.00, '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `shareholders`
--

CREATE TABLE `shareholders` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `capital_amount` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shareholders`
--

INSERT INTO `shareholders` (`id`, `Name`, `phone`, `address`, `cnic`, `capital_amount`) VALUES
(1, 'John Doe', '123-456-7890', '123 Main St', '12345-67890', 100000.00),
(2, 'Jane Smith', '987-654-3210', '456 Elm St', '54321-09876', 75000.00),
(3, 'Alice Johnson', '555-555-5555', '789 Oak St', '98765-43210', 50000.00),
(4, 'Bob Brown', '111-222-3333', '321 Maple St', '24680-13579', 25000.00),
(5, 'Emma Davis', '999-888-7777', '654 Pine St', '13579-02468', 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `sh_id` int(11) DEFAULT NULL,
  `tunnel_id` int(11) DEFAULT NULL,
  `shares_values` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `sh_id`, `tunnel_id`, `shares_values`) VALUES
(1, 1, 1, 1000.00),
(2, 2, 2, 500.00),
(3, 3, 3, 750.00),
(4, 4, 4, 250.00),
(5, 5, 5, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `PqId` int(11) DEFAULT NULL,
  `qunatity` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `PqId`, `qunatity`, `Date`) VALUES
(1, 1, 100, '2023-01-01 00:00:00'),
(2, 2, 50, '2023-01-02 00:00:00'),
(3, 3, 75, '2023-01-03 00:00:00'),
(4, 4, 25, '2023-01-04 00:00:00'),
(5, 5, 30, '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `Name`, `company_name`, `contact`, `cnic`, `Address`) VALUES
(1, 'ABC Traders', 'ABC Company', '123-456-7890', '12345-67890', '123 Supplier St'),
(2, 'XYZ Enterprises', 'XYZ Company', '987-654-3210', '54321-09876', '456 Vendor St'),
(3, 'PQR Industries', 'PQR Company', '555-555-5555', '98765-43210', '789 Distributor St'),
(4, 'LMN Corporation', 'LMN Company', '111-222-3333', '24680-13579', '321 Wholesaler St'),
(5, 'EFG Suppliers', 'EFG Company', '999-888-7777', '13579-02468', '654 Manufacturer St');

-- --------------------------------------------------------

--
-- Table structure for table `tunnels`
--

CREATE TABLE `tunnels` (
  `id` int(11) NOT NULL,
  `sh_id` int(11) DEFAULT NULL,
  `share_id` int(11) DEFAULT NULL,
  `TName` varchar(255) DEFAULT NULL,
  `product__id` int(11) DEFAULT NULL,
  `CoveredArea` decimal(18,2) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunnels`
--

INSERT INTO `tunnels` (`id`, `sh_id`, `share_id`, `TName`, `product__id`, `CoveredArea`, `Date`) VALUES
(1, 1, 1, 'Tunnel A', 1, 100.00, '2023-01-01 00:00:00'),
(2, 2, 2, 'Tunnel B', 2, 75.00, '2023-01-02 00:00:00'),
(3, 3, 3, 'Tunnel C', 3, 50.00, '2023-01-03 00:00:00'),
(4, 4, 4, 'Tunnel D', 4, 25.00, '2023-01-04 00:00:00'),
(5, 5, 5, 'Tunnel E', 5, 30.00, '2023-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `Name`) VALUES
(1, 'Kilogram'),
(2, 'Gram'),
(3, 'Liter'),
(4, 'Meter'),
(5, 'Piece');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `Password`) VALUES
(1, 1, 'admin_user', 'admin_pass'),
(2, 2, 'manager_user', 'manager_pass'),
(3, 3, 'employee_user', 'employee_pass'),
(4, 4, 'customer_user', 'customer_pass'),
(5, 5, 'supplier_user', 'supplier_pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directsale`
--
ALTER TABLE `directsale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocke_id` (`stocke_id`),
  ADD KEY `PqId` (`PqId`);

--
-- Indexes for table `employeecategory`
--
ALTER TABLE `employeecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_cat_id` (`employee_cat_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `gatepasses`
--
ALTER TABLE `gatepasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SellId` (`SellId`);

--
-- Indexes for table `gpdetail`
--
ALTER TABLE `gpdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `GpId` (`GpId`),
  ADD KEY `SellId` (`SellId`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuestock`
--
ALTER TABLE `issuestock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PqId` (`PqId`),
  ADD KEY `empoyee_id` (`empoyee_id`),
  ADD KEY `tunnel_id` (`tunnel_id`);

--
-- Indexes for table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CropId` (`CropId`),
  ADD KEY `TunnelId` (`TunnelId`),
  ADD KEY `UnitId` (`UnitId`),
  ADD KEY `GradeId` (`GradeId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `purchasequantity`
--
ALTER TABLE `purchasequantity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__id` (`product__id`),
  ADD KEY `Supplier_id` (`Supplier_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selldetails`
--
ALTER TABLE `selldetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SellId` (`SellId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ProductionId` (`ProductionId`),
  ADD KEY `GradeId` (`GradeId`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shareholders`
--
ALTER TABLE `shareholders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sh_id` (`sh_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PqId` (`PqId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tunnels`
--
ALTER TABLE `tunnels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__id` (`product__id`),
  ADD KEY `share_id` (`share_id`),
  ADD KEY `sh_id` (`sh_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `directsale`
--
ALTER TABLE `directsale`
  ADD CONSTRAINT `directsale_ibfk_1` FOREIGN KEY (`stocke_id`) REFERENCES `stocks` (`id`),
  ADD CONSTRAINT `directsale_ibfk_2` FOREIGN KEY (`PqId`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`employee_cat_id`) REFERENCES `employeecategory` (`id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`);

--
-- Constraints for table `gatepasses`
--
ALTER TABLE `gatepasses`
  ADD CONSTRAINT `gatepasses_ibfk_1` FOREIGN KEY (`SellId`) REFERENCES `sells` (`id`);

--
-- Constraints for table `gpdetail`
--
ALTER TABLE `gpdetail`
  ADD CONSTRAINT `gpdetail_ibfk_1` FOREIGN KEY (`GpId`) REFERENCES `gatepasses` (`id`),
  ADD CONSTRAINT `gpdetail_ibfk_2` FOREIGN KEY (`SellId`) REFERENCES `sells` (`id`);

--
-- Constraints for table `issuestock`
--
ALTER TABLE `issuestock`
  ADD CONSTRAINT `issuestock_ibfk_1` FOREIGN KEY (`PqId`) REFERENCES `purchasequantity` (`id`),
  ADD CONSTRAINT `issuestock_ibfk_2` FOREIGN KEY (`empoyee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `issuestock_ibfk_3` FOREIGN KEY (`tunnel_id`) REFERENCES `tunnels` (`id`);

--
-- Constraints for table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`CropId`) REFERENCES `crops` (`id`),
  ADD CONSTRAINT `productions_ibfk_2` FOREIGN KEY (`TunnelId`) REFERENCES `tunnels` (`id`),
  ADD CONSTRAINT `productions_ibfk_3` FOREIGN KEY (`UnitId`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `productions_ibfk_4` FOREIGN KEY (`GradeId`) REFERENCES `grades` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `purchasequantity`
--
ALTER TABLE `purchasequantity`
  ADD CONSTRAINT `purchasequantity_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`product__id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`Supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `selldetails`
--
ALTER TABLE `selldetails`
  ADD CONSTRAINT `selldetails_ibfk_1` FOREIGN KEY (`SellId`) REFERENCES `sells` (`id`),
  ADD CONSTRAINT `selldetails_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `selldetails_ibfk_3` FOREIGN KEY (`ProductionId`) REFERENCES `productions` (`id`),
  ADD CONSTRAINT `selldetails_ibfk_4` FOREIGN KEY (`GradeId`) REFERENCES `grades` (`id`);

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`sh_id`) REFERENCES `shareholders` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`PqId`) REFERENCES `purchasequantity` (`id`);

--
-- Constraints for table `tunnels`
--
ALTER TABLE `tunnels`
  ADD CONSTRAINT `tunnels_ibfk_1` FOREIGN KEY (`product__id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `tunnels_ibfk_2` FOREIGN KEY (`share_id`) REFERENCES `shares` (`id`),
  ADD CONSTRAINT `tunnels_ibfk_3` FOREIGN KEY (`sh_id`) REFERENCES `shareholders` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
