-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2018 at 05:37 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` varchar(30) NOT NULL,
  `AdminName` varchar(30) NOT NULL,
  `AdminAdd` varchar(255) NOT NULL,
  `AdminPhno` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `AdminEmail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `AdminAdd`, `AdminPhno`, `Password`, `AdminEmail`) VALUES
('A-000001', 'Kyawt No No Aung', 'No.246, 1th Street, Insein, Yangon', '09261859020', 'kyawtnonoaung', 'kyawtnonoaung@gmail.com'),
('A-000002', 'Ei Po Po Aung', 'No.258, Mahar_Thukhitar Street, Bahan, Yangon', '09799816695', 'eipopoaung', 'eipopoaung@gmail.com'),
('A-000003', 'kk', 'kkkk', '0912345', 'kkkk', 'kk@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` varchar(30) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Email`, `Password`, `Address`, `PhoneNumber`) VALUES
('C-000001', 'Noe Noe', 'noenoe@gmail.com', 'noenoe', 'No.21, 1st Street, Insein, Yangon', '095063784'),
('C-000002', 'Po Po', 'popo@gmail.com', 'popo', 'No.23, Oo_Chit_Mg Street, Kamaryoot, Yangon', '095063785'),
('C-000003', 'Ei Khaing', 'eikhaing@gmail.com', 'eikhaing', 'No.99 , 19 Street, Lanmataw, Yangon', '095063781'),
('C-000004', 'San Aung', 'sanaung@gmail.com', 'sanaung', 'No.243, Khayay Street, Hli, Yangon', '095063782'),
('C-000005', 'Su Su', 'susu@gmail.com', 'susu', 'No.45, Zee_Pin Street, Bayintnung, Yangon', '095063783'),
('C-000006', 'Su Hlaing', 'suhlaing@gmail.com', 'suhlaing', 'No.12, Nilar 5th Street, North Okkala, Yangon', '095063786'),
('C-000007', 'Eaint Thu', 'eaintthu@gmail.com', 'eaintthu', 'No.5, Min_Gyi Street, North Dagon, Yangon', '095063787'),
('C-000008', 'Hnin Aye Wai', 'hninayewai@gmail.com', 'hninayewai', 'No.246, 8th Street, South Dagon, Yangon', '095063788'),
('C-000009', 'Aung Aung', 'aungaung@gmail.com', 'aungaung', 'No.22,  Hnin_Si Street, Dagon, Yangon', '095063789'),
('C-000010', 'Khin Khin', 'khinkhin@gmail.com', 'khinkhin', 'No.91, Main Street, Mingalar_Taung_Nyont, Yangon', '095063710'),
('C-000011', 'Thet Myat', 'thetmyat@gmail.com', 'thetmyat', 'No.68, Myit_Tar Street, South Okkala, Yangon', '095063711'),
('C-000012', 'Min Min', 'minmin@gmail.com', 'minmin', 'No.1, Sapal Street, Mayangone, Yangon', '095063712'),
('C-000013', 'Ye Min', 'yemin@gmail.com', 'yemin', 'No.137, Oo_Yaygal Street, Kamaryoot, Yangon', '095063713'),
('C-000014', 'Ei Ei', 'eiei@gmail.com', 'eiei', 'Insein\r\n', '09256194212');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `DeliveryID` varchar(30) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `ContactPerson` varchar(30) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `ContactPhone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `OrderID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `ProductID`, `Quantity`, `Amount`) VALUES
('O_000001', 'P-000001', 3, 3000),
('O_000001', 'P-000005', 1, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` varchar(30) NOT NULL,
  `DeliveryID` varchar(30) NOT NULL,
  `CustomerID` varchar(30) NOT NULL,
  `OrderDate` date NOT NULL,
  `PaymentType` varchar(30) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `CardNo` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `DeliveryID`, `CustomerID`, `OrderDate`, `PaymentType`, `DeliveryAddress`, `TotalAmount`, `CardNo`, `Status`) VALUES
('O_000001', 'D_000001', 'C_000001', '2018-03-14', 'Cash', '', 6500, '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` varchar(30) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Ingredients` varchar(1000) NOT NULL,
  `Flavour` varchar(50) NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Quantity`, `Price`, `Ingredients`, `Flavour`, `Image`) VALUES
('P-000001', 'White chocolate brioche twists', 25, 1000, 'Sugar, Salt, Lemon zest, Milk, Lemon juice, Eggs, Butter, White chocolate', 'White chocolate, Lemon (smell)', 'images/_p1.jpg'),
('P-000002', 'Herbed wheat clover leaf rolls', 25, 400, 'Salt, Dried thyme, Dried oregano, Dried basil, Garlic powder, Milk, Honey, Butter', 'Thyme, Garlic, Oregano and basil', 'images/_p2.jpg'),
('P-000003', 'Crescent rolls', 25, 500, 'Milk, Butter, Egg, Salt, Sugar', 'Plain', 'images/_p3.jpg'),
('P-000004', 'Brown sugar pecan cookie', 50, 300, 'Butter, Brown sugar, Egg, Vanilla extract, Salt, Coconut flakes, Chopped walnuts, Pecan halves', 'Vanilla,  Walnuts, Pecan', 'images/_p4.png'),
('P-000005', 'Pumpkin pecon bread pudding', 20, 3500, 'Pumpkin puree, Egg, Milk, Condensed milk, Pumpkin pie spice, Chopped pecans, Coconut cream cold, Maple syrup', 'Pumpkin, Pecan, Coconut, Maple', 'images/_p5.jpg'),
('P-000006', 'Pumpkin beer bread', 30, 2000, 'Salt, Sugar, Butter, Honey, Cinnamon, Nutmeg, Ginger, Pumpkin, Beer', 'Cinnamon, Nutmeg, Ginger, Pumpkin, Beer', 'images/_p6.jpg'),
('P-000007', 'Bacon onion rye bread', 20, 2000, 'Organic dark rye flour, Sugar, Milk, Chopped onion, Caraway seeds, Bacon, Bacon grease, Butter', 'Onion, Caraway, Bacon', 'images/_p7.jpg'),
('P-000008', 'Sunflower bread', 20, 3500, 'Roasted sunflower seed kernels, Kosher salt, Milk, Honey, Molasses, Butter, Egg, Salt', 'Plain, Sunflower seed kernels', 'images/_p8.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE IF NOT EXISTS `production` (
  `ProductionID` varchar(30) DEFAULT NULL,
  `RawID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Unit` varchar(20) NOT NULL,
  `Date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `PurchaseID` varchar(30) NOT NULL,
  `SupplierID` varchar(30) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `SupplierID`, `PurchaseDate`, `TotalAmount`, `TotalQty`) VALUES
('P-000001', 'S-000001', '2018-03-15', 50000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE IF NOT EXISTS `purchasedetail` (
  `RawID` varchar(30) NOT NULL,
  `PurchaseID` varchar(30) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`RawID`, `PurchaseID`, `PurchaseDate`, `Price`, `Quantity`) VALUES
('R-000001', 'P-000001', '2018-03-15', 50000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `raw`
--

CREATE TABLE IF NOT EXISTS `raw` (
  `RawID` varchar(30) NOT NULL,
  `RawName` varchar(30) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw`
--

INSERT INTO `raw` (`RawID`, `RawName`, `Price`, `Quantity`) VALUES
('R-000001', 'Flour', 3500, 300);

-- --------------------------------------------------------

--
-- Table structure for table `rawdetail`
--

CREATE TABLE IF NOT EXISTS `rawdetail` (
  `RawID` varchar(30) NOT NULL,
  `ProductionID` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierID` varchar(30) NOT NULL,
  `SupplierName` varchar(30) NOT NULL,
  `SupplierAdd` varchar(255) NOT NULL,
  `SupplierPhno` varchar(30) NOT NULL,
  `SupplierEmail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `SupplierAdd`, `SupplierPhno`, `SupplierEmail`) VALUES
('S-000001', 'Htet Htet', 'Insein', '09779741257', 'htethtet@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
