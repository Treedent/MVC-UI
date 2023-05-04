-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 mai 2023 à 10:01
-- Version du serveur : 8.0.32-0ubuntu0.22.04.2
-- Version de PHP : 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `northwind`
--

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Alphabetical list of products`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Alphabetical list of products` (
`ProductID` int
,`ProductName` varchar(40)
,`SupplierID` int
,`CategoryID` int
,`QuantityPerUnit` varchar(20)
,`UnitPrice` decimal(10,4)
,`UnitsInStock` smallint
,`UnitsOnOrder` smallint
,`ReorderLevel` smallint
,`Discontinued` bit(1)
,`CategoryName` varchar(15)
);

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(15) NOT NULL,
  `Description` mediumtext,
  `Picture` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Category Sales for 1997`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Category Sales for 1997` (
`CategoryName` varchar(15)
,`CategorySales` double(25,8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Current Product List`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Current Product List` (
`ProductID` int
,`ProductName` varchar(40)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Customer and Suppliers by City`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Customer and Suppliers by City` (
`City` varchar(15)
,`CompanyName` varchar(40)
,`ContactName` varchar(30)
,`Relationship` varchar(9)
);

-- --------------------------------------------------------

--
-- Structure de la table `CustomerCustomerDemo`
--

CREATE TABLE `CustomerCustomerDemo` (
  `CustomerID` varchar(5) NOT NULL,
  `CustomerTypeID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CustomerDemographics`
--

CREATE TABLE `CustomerDemographics` (
  `CustomerTypeID` varchar(10) NOT NULL,
  `CustomerDesc` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` varchar(5) NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `ContactName` varchar(30) DEFAULT NULL,
  `ContactTitle` varchar(30) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `Phone` varchar(24) DEFAULT NULL,
  `Fax` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Employees`
--

CREATE TABLE `Employees` (
  `EmployeeID` int NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `FirstName` varchar(10) NOT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Photo` longblob,
  `Notes` mediumtext NOT NULL,
  `ReportsTo` int DEFAULT NULL,
  `PhotoPath` varchar(255) DEFAULT NULL,
  `Salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `EmployeeTerritories`
--

CREATE TABLE `EmployeeTerritories` (
  `EmployeeID` int NOT NULL,
  `TerritoryID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Invoices`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Invoices` (
`ShipName` varchar(40)
,`ShipAddress` varchar(60)
,`ShipCity` varchar(15)
,`ShipRegion` varchar(15)
,`ShipPostalCode` varchar(10)
,`ShipCountry` varchar(15)
,`CustomerID` varchar(5)
,`CustomerName` varchar(40)
,`Address` varchar(60)
,`City` varchar(15)
,`Region` varchar(15)
,`PostalCode` varchar(10)
,`Country` varchar(15)
,`Salesperson` double
,`OrderID` int
,`OrderDate` datetime
,`RequiredDate` datetime
,`ShippedDate` datetime
,`ShipperName` varchar(40)
,`ProductID` int
,`ProductName` varchar(40)
,`UnitPrice` decimal(10,4)
,`Quantity` smallint
,`Discount` double(8,0)
,`ExtendedPrice` double(22,8)
,`Freight` decimal(10,4)
);

-- --------------------------------------------------------

--
-- Structure de la table `Order Details`
--

CREATE TABLE `Order Details` (
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `UnitPrice` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `Quantity` smallint NOT NULL DEFAULT '1',
  `Discount` double(8,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Order Details Extended`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Order Details Extended` (
`OrderID` int
,`ProductID` int
,`ProductName` varchar(40)
,`UnitPrice` decimal(10,4)
,`Quantity` smallint
,`Discount` double(8,0)
,`ExtendedPrice` double(22,8)
);

-- --------------------------------------------------------

--
-- Structure de la table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int NOT NULL,
  `CustomerID` varchar(5) DEFAULT NULL,
  `EmployeeID` int DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `RequiredDate` datetime DEFAULT NULL,
  `ShippedDate` datetime DEFAULT NULL,
  `ShipVia` int DEFAULT NULL,
  `Freight` decimal(10,4) DEFAULT '0.0000',
  `ShipName` varchar(40) DEFAULT NULL,
  `ShipAddress` varchar(60) DEFAULT NULL,
  `ShipCity` varchar(15) DEFAULT NULL,
  `ShipRegion` varchar(15) DEFAULT NULL,
  `ShipPostalCode` varchar(10) DEFAULT NULL,
  `ShipCountry` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Orders Qry`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Orders Qry` (
`OrderID` int
,`CustomerID` varchar(5)
,`EmployeeID` int
,`OrderDate` datetime
,`RequiredDate` datetime
,`ShippedDate` datetime
,`ShipVia` int
,`Freight` decimal(10,4)
,`ShipName` varchar(40)
,`ShipAddress` varchar(60)
,`ShipCity` varchar(15)
,`ShipRegion` varchar(15)
,`ShipPostalCode` varchar(10)
,`ShipCountry` varchar(15)
,`CompanyName` varchar(40)
,`Address` varchar(60)
,`City` varchar(15)
,`Region` varchar(15)
,`PostalCode` varchar(10)
,`Country` varchar(15)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Order Subtotals`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Order Subtotals` (
`OrderID` int
,`Subtotal` double(25,8)
);

-- --------------------------------------------------------

--
-- Structure de la table `Products`
--

CREATE TABLE `Products` (
  `ProductID` int NOT NULL,
  `ProductName` varchar(40) NOT NULL,
  `SupplierID` int DEFAULT NULL,
  `CategoryID` int DEFAULT NULL,
  `QuantityPerUnit` varchar(20) DEFAULT NULL,
  `UnitPrice` decimal(10,4) DEFAULT '0.0000',
  `UnitsInStock` smallint DEFAULT '0',
  `UnitsOnOrder` smallint DEFAULT '0',
  `ReorderLevel` smallint DEFAULT '0',
  `Discontinued` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Products Above Average Price`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Products Above Average Price` (
`ProductName` varchar(40)
,`UnitPrice` decimal(10,4)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Product Sales for 1997`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Product Sales for 1997` (
`CategoryName` varchar(15)
,`ProductName` varchar(40)
,`ProductSales` double(25,8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Products by Category`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Products by Category` (
`CategoryName` varchar(15)
,`ProductName` varchar(40)
,`QuantityPerUnit` varchar(20)
,`UnitsInStock` smallint
,`Discontinued` bit(1)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Quarterly Orders`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Quarterly Orders` (
`CustomerID` varchar(5)
,`CompanyName` varchar(40)
,`City` varchar(15)
,`Country` varchar(15)
);

-- --------------------------------------------------------

--
-- Structure de la table `Region`
--

CREATE TABLE `Region` (
  `RegionID` int NOT NULL,
  `RegionDescription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Sales by Category`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Sales by Category` (
`CategoryID` int
,`CategoryName` varchar(15)
,`ProductName` varchar(40)
,`ProductSales` double(25,8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Sales Totals by Amount`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Sales Totals by Amount` (
`SaleAmount` double(25,8)
,`OrderID` int
,`CompanyName` varchar(40)
,`ShippedDate` datetime
);

-- --------------------------------------------------------

--
-- Structure de la table `Shippers`
--

CREATE TABLE `Shippers` (
  `ShipperID` int NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `Phone` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Summary of Sales by Quarter`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Summary of Sales by Quarter` (
`ShippedDate` datetime
,`OrderID` int
,`Subtotal` double(25,8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Summary of Sales by Year`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Summary of Sales by Year` (
`ShippedDate` datetime
,`OrderID` int
,`Subtotal` double(25,8)
);

-- --------------------------------------------------------

--
-- Structure de la table `Suppliers`
--

CREATE TABLE `Suppliers` (
  `SupplierID` int NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `ContactName` varchar(30) DEFAULT NULL,
  `ContactTitle` varchar(30) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `Phone` varchar(24) DEFAULT NULL,
  `Fax` varchar(24) DEFAULT NULL,
  `HomePage` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Territories`
--

CREATE TABLE `Territories` (
  `TerritoryID` varchar(20) NOT NULL,
  `TerritoryDescription` varchar(50) NOT NULL,
  `RegionID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la vue `Alphabetical list of products`
--
DROP TABLE IF EXISTS `Alphabetical list of products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Alphabetical list of products`  AS SELECT `Products`.`ProductID` AS `ProductID`, `Products`.`ProductName` AS `ProductName`, `Products`.`SupplierID` AS `SupplierID`, `Products`.`CategoryID` AS `CategoryID`, `Products`.`QuantityPerUnit` AS `QuantityPerUnit`, `Products`.`UnitPrice` AS `UnitPrice`, `Products`.`UnitsInStock` AS `UnitsInStock`, `Products`.`UnitsOnOrder` AS `UnitsOnOrder`, `Products`.`ReorderLevel` AS `ReorderLevel`, `Products`.`Discontinued` AS `Discontinued`, `Categories`.`CategoryName` AS `CategoryName` FROM (`Categories` join `Products` on((`Categories`.`CategoryID` = `Products`.`CategoryID`))) WHERE (`Products`.`Discontinued` = 0) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Category Sales for 1997`
--
DROP TABLE IF EXISTS `Category Sales for 1997`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Category Sales for 1997`  AS SELECT `Product Sales for 1997`.`CategoryName` AS `CategoryName`, sum(`Product Sales for 1997`.`ProductSales`) AS `CategorySales` FROM `Product Sales for 1997` GROUP BY `Product Sales for 1997`.`CategoryName` ;

-- --------------------------------------------------------

--
-- Structure de la vue `Current Product List`
--
DROP TABLE IF EXISTS `Current Product List`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Current Product List`  AS SELECT `Products`.`ProductID` AS `ProductID`, `Products`.`ProductName` AS `ProductName` FROM `Products` WHERE (`Products`.`Discontinued` = 0) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Customer and Suppliers by City`
--
DROP TABLE IF EXISTS `Customer and Suppliers by City`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Customer and Suppliers by City`  AS SELECT `Customers`.`City` AS `City`, `Customers`.`CompanyName` AS `CompanyName`, `Customers`.`ContactName` AS `ContactName`, 'Customers' AS `Relationship` FROM `Customers`union select `Suppliers`.`City` AS `City`,`Suppliers`.`CompanyName` AS `CompanyName`,`Suppliers`.`ContactName` AS `ContactName`,'Suppliers' AS `Suppliers` from `Suppliers` order by `City`,`CompanyName`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `Invoices`
--
DROP TABLE IF EXISTS `Invoices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Invoices`  AS SELECT `Orders`.`ShipName` AS `ShipName`, `Orders`.`ShipAddress` AS `ShipAddress`, `Orders`.`ShipCity` AS `ShipCity`, `Orders`.`ShipRegion` AS `ShipRegion`, `Orders`.`ShipPostalCode` AS `ShipPostalCode`, `Orders`.`ShipCountry` AS `ShipCountry`, `Orders`.`CustomerID` AS `CustomerID`, `Customers`.`CompanyName` AS `CustomerName`, `Customers`.`Address` AS `Address`, `Customers`.`City` AS `City`, `Customers`.`Region` AS `Region`, `Customers`.`PostalCode` AS `PostalCode`, `Customers`.`Country` AS `Country`, ((`Employees`.`FirstName` + ' ') + `Employees`.`LastName`) AS `Salesperson`, `Orders`.`OrderID` AS `OrderID`, `Orders`.`OrderDate` AS `OrderDate`, `Orders`.`RequiredDate` AS `RequiredDate`, `Orders`.`ShippedDate` AS `ShippedDate`, `Shippers`.`CompanyName` AS `ShipperName`, `Order Details`.`ProductID` AS `ProductID`, `Products`.`ProductName` AS `ProductName`, `Order Details`.`UnitPrice` AS `UnitPrice`, `Order Details`.`Quantity` AS `Quantity`, `Order Details`.`Discount` AS `Discount`, ((((`Order Details`.`UnitPrice` * `Order Details`.`Quantity`) * (1 - `Order Details`.`Discount`)) / 100) * 100) AS `ExtendedPrice`, `Orders`.`Freight` AS `Freight` FROM (((((`Customers` join `Orders` on((`Customers`.`CustomerID` = `Orders`.`CustomerID`))) join `Employees` on((`Employees`.`EmployeeID` = `Orders`.`EmployeeID`))) join `Order Details` on((`Orders`.`OrderID` = `Order Details`.`OrderID`))) join `Products` on((`Products`.`ProductID` = `Order Details`.`ProductID`))) join `Shippers` on((`Shippers`.`ShipperID` = `Orders`.`ShipVia`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Order Details Extended`
--
DROP TABLE IF EXISTS `Order Details Extended`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Order Details Extended`  AS SELECT `Order Details`.`OrderID` AS `OrderID`, `Order Details`.`ProductID` AS `ProductID`, `Products`.`ProductName` AS `ProductName`, `Order Details`.`UnitPrice` AS `UnitPrice`, `Order Details`.`Quantity` AS `Quantity`, `Order Details`.`Discount` AS `Discount`, ((((`Order Details`.`UnitPrice` * `Order Details`.`Quantity`) * (1 - `Order Details`.`Discount`)) / 100) * 100) AS `ExtendedPrice` FROM (`Products` join `Order Details` on((`Products`.`ProductID` = `Order Details`.`ProductID`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Orders Qry`
--
DROP TABLE IF EXISTS `Orders Qry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Orders Qry`  AS SELECT `Orders`.`OrderID` AS `OrderID`, `Orders`.`CustomerID` AS `CustomerID`, `Orders`.`EmployeeID` AS `EmployeeID`, `Orders`.`OrderDate` AS `OrderDate`, `Orders`.`RequiredDate` AS `RequiredDate`, `Orders`.`ShippedDate` AS `ShippedDate`, `Orders`.`ShipVia` AS `ShipVia`, `Orders`.`Freight` AS `Freight`, `Orders`.`ShipName` AS `ShipName`, `Orders`.`ShipAddress` AS `ShipAddress`, `Orders`.`ShipCity` AS `ShipCity`, `Orders`.`ShipRegion` AS `ShipRegion`, `Orders`.`ShipPostalCode` AS `ShipPostalCode`, `Orders`.`ShipCountry` AS `ShipCountry`, `Customers`.`CompanyName` AS `CompanyName`, `Customers`.`Address` AS `Address`, `Customers`.`City` AS `City`, `Customers`.`Region` AS `Region`, `Customers`.`PostalCode` AS `PostalCode`, `Customers`.`Country` AS `Country` FROM (`Customers` join `Orders` on((`Customers`.`CustomerID` = `Orders`.`CustomerID`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Order Subtotals`
--
DROP TABLE IF EXISTS `Order Subtotals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Order Subtotals`  AS SELECT `Order Details`.`OrderID` AS `OrderID`, sum(((((`Order Details`.`UnitPrice` * `Order Details`.`Quantity`) * (1 - `Order Details`.`Discount`)) / 100) * 100)) AS `Subtotal` FROM `Order Details` GROUP BY `Order Details`.`OrderID` ;

-- --------------------------------------------------------

--
-- Structure de la vue `Products Above Average Price`
--
DROP TABLE IF EXISTS `Products Above Average Price`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Products Above Average Price`  AS SELECT `Products`.`ProductName` AS `ProductName`, `Products`.`UnitPrice` AS `UnitPrice` FROM `Products` WHERE (`Products`.`UnitPrice` > (select avg(`Products`.`UnitPrice`) from `Products`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Product Sales for 1997`
--
DROP TABLE IF EXISTS `Product Sales for 1997`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Product Sales for 1997`  AS SELECT `Categories`.`CategoryName` AS `CategoryName`, `Products`.`ProductName` AS `ProductName`, sum(((((`Order Details`.`UnitPrice` * `Order Details`.`Quantity`) * (1 - `Order Details`.`Discount`)) / 100) * 100)) AS `ProductSales` FROM (((`Categories` join `Products` on((`Categories`.`CategoryID` = `Products`.`CategoryID`))) join `Order Details` on((`Products`.`ProductID` = `Order Details`.`ProductID`))) join `Orders` on((`Orders`.`OrderID` = `Order Details`.`OrderID`))) WHERE (`Orders`.`ShippedDate` between '1997-01-01' and '1997-12-31') GROUP BY `Categories`.`CategoryName`, `Products`.`ProductName` ;

-- --------------------------------------------------------

--
-- Structure de la vue `Products by Category`
--
DROP TABLE IF EXISTS `Products by Category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Products by Category`  AS SELECT `Categories`.`CategoryName` AS `CategoryName`, `Products`.`ProductName` AS `ProductName`, `Products`.`QuantityPerUnit` AS `QuantityPerUnit`, `Products`.`UnitsInStock` AS `UnitsInStock`, `Products`.`Discontinued` AS `Discontinued` FROM (`Categories` join `Products` on((`Categories`.`CategoryID` = `Products`.`CategoryID`))) WHERE (`Products`.`Discontinued` <> 1) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Quarterly Orders`
--
DROP TABLE IF EXISTS `Quarterly Orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Quarterly Orders`  AS SELECT DISTINCT `Customers`.`CustomerID` AS `CustomerID`, `Customers`.`CompanyName` AS `CompanyName`, `Customers`.`City` AS `City`, `Customers`.`Country` AS `Country` FROM (`Customers` join `Orders` on((`Customers`.`CustomerID` = `Orders`.`CustomerID`))) WHERE (`Orders`.`OrderDate` between '1997-01-01' and '1997-12-31') ;

-- --------------------------------------------------------

--
-- Structure de la vue `Sales by Category`
--
DROP TABLE IF EXISTS `Sales by Category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Sales by Category`  AS SELECT `Categories`.`CategoryID` AS `CategoryID`, `Categories`.`CategoryName` AS `CategoryName`, `Products`.`ProductName` AS `ProductName`, sum(`Order Details Extended`.`ExtendedPrice`) AS `ProductSales` FROM (((`Categories` join `Products` on((`Categories`.`CategoryID` = `Products`.`CategoryID`))) join `Order Details Extended` on((`Products`.`ProductID` = `Order Details Extended`.`ProductID`))) join `Orders` on((`Orders`.`OrderID` = `Order Details Extended`.`OrderID`))) WHERE (`Orders`.`OrderDate` between '1997-01-01' and '1997-12-31') GROUP BY `Categories`.`CategoryID`, `Categories`.`CategoryName`, `Products`.`ProductName` ;

-- --------------------------------------------------------

--
-- Structure de la vue `Sales Totals by Amount`
--
DROP TABLE IF EXISTS `Sales Totals by Amount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Sales Totals by Amount`  AS SELECT `Order Subtotals`.`Subtotal` AS `SaleAmount`, `Orders`.`OrderID` AS `OrderID`, `Customers`.`CompanyName` AS `CompanyName`, `Orders`.`ShippedDate` AS `ShippedDate` FROM ((`Customers` join `Orders` on((`Customers`.`CustomerID` = `Orders`.`CustomerID`))) join `Order Subtotals` on((`Orders`.`OrderID` = `Order Subtotals`.`OrderID`))) WHERE ((`Order Subtotals`.`Subtotal` > 2500) AND (`Orders`.`ShippedDate` between '1997-01-01' and '1997-12-31')) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Summary of Sales by Quarter`
--
DROP TABLE IF EXISTS `Summary of Sales by Quarter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Summary of Sales by Quarter`  AS SELECT `Orders`.`ShippedDate` AS `ShippedDate`, `Orders`.`OrderID` AS `OrderID`, `Order Subtotals`.`Subtotal` AS `Subtotal` FROM (`Orders` join `Order Subtotals` on((`Orders`.`OrderID` = `Order Subtotals`.`OrderID`))) WHERE (`Orders`.`ShippedDate` is not null) ;

-- --------------------------------------------------------

--
-- Structure de la vue `Summary of Sales by Year`
--
DROP TABLE IF EXISTS `Summary of Sales by Year`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Summary of Sales by Year`  AS SELECT `Orders`.`ShippedDate` AS `ShippedDate`, `Orders`.`OrderID` AS `OrderID`, `Order Subtotals`.`Subtotal` AS `Subtotal` FROM (`Orders` join `Order Subtotals` on((`Orders`.`OrderID` = `Order Subtotals`.`OrderID`))) WHERE (`Orders`.`ShippedDate` is not null) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Index pour la table `CustomerCustomerDemo`
--
ALTER TABLE `CustomerCustomerDemo`
  ADD PRIMARY KEY (`CustomerID`,`CustomerTypeID`),
  ADD KEY `FK_CustomerCustomerDemo` (`CustomerTypeID`);

--
-- Index pour la table `CustomerDemographics`
--
ALTER TABLE `CustomerDemographics`
  ADD PRIMARY KEY (`CustomerTypeID`);

--
-- Index pour la table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `City` (`City`),
  ADD KEY `CompanyName` (`CompanyName`),
  ADD KEY `PostalCode` (`PostalCode`),
  ADD KEY `Region` (`Region`);

--
-- Index pour la table `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `LastName` (`LastName`),
  ADD KEY `PostalCode` (`PostalCode`),
  ADD KEY `FK_Employees_Employees` (`ReportsTo`);

--
-- Index pour la table `EmployeeTerritories`
--
ALTER TABLE `EmployeeTerritories`
  ADD PRIMARY KEY (`EmployeeID`,`TerritoryID`),
  ADD KEY `FK_EmployeeTerritories_Territories` (`TerritoryID`);

--
-- Index pour la table `Order Details`
--
ALTER TABLE `Order Details`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `FK_Order_Details_Products` (`ProductID`);

--
-- Index pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `OrderDate` (`OrderDate`),
  ADD KEY `ShippedDate` (`ShippedDate`),
  ADD KEY `ShipPostalCode` (`ShipPostalCode`),
  ADD KEY `FK_Orders_Customers` (`CustomerID`),
  ADD KEY `FK_Orders_Employees` (`EmployeeID`),
  ADD KEY `FK_Orders_Shippers` (`ShipVia`);

--
-- Index pour la table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ProductName` (`ProductName`),
  ADD KEY `FK_Products_Categories` (`CategoryID`),
  ADD KEY `FK_Products_Suppliers` (`SupplierID`);

--
-- Index pour la table `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`RegionID`);

--
-- Index pour la table `Shippers`
--
ALTER TABLE `Shippers`
  ADD PRIMARY KEY (`ShipperID`);

--
-- Index pour la table `Suppliers`
--
ALTER TABLE `Suppliers`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `CompanyName` (`CompanyName`),
  ADD KEY `PostalCode` (`PostalCode`);

--
-- Index pour la table `Territories`
--
ALTER TABLE `Territories`
  ADD PRIMARY KEY (`TerritoryID`),
  ADD KEY `FK_Territories_Region` (`RegionID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Employees`
--
ALTER TABLE `Employees`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Shippers`
--
ALTER TABLE `Shippers`
  MODIFY `ShipperID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Suppliers`
--
ALTER TABLE `Suppliers`
  MODIFY `SupplierID` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CustomerCustomerDemo`
--
ALTER TABLE `CustomerCustomerDemo`
  ADD CONSTRAINT `FK_CustomerCustomerDemo` FOREIGN KEY (`CustomerTypeID`) REFERENCES `CustomerDemographics` (`CustomerTypeID`),
  ADD CONSTRAINT `FK_CustomerCustomerDemo_Customers` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`);

--
-- Contraintes pour la table `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `FK_Employees_Employees` FOREIGN KEY (`ReportsTo`) REFERENCES `Employees` (`EmployeeID`);

--
-- Contraintes pour la table `EmployeeTerritories`
--
ALTER TABLE `EmployeeTerritories`
  ADD CONSTRAINT `FK_EmployeeTerritories_Employees` FOREIGN KEY (`EmployeeID`) REFERENCES `Employees` (`EmployeeID`),
  ADD CONSTRAINT `FK_EmployeeTerritories_Territories` FOREIGN KEY (`TerritoryID`) REFERENCES `Territories` (`TerritoryID`);

--
-- Contraintes pour la table `Order Details`
--
ALTER TABLE `Order Details`
  ADD CONSTRAINT `FK_Order_Details_Orders` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`OrderID`),
  ADD CONSTRAINT `FK_Order_Details_Products` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`);

--
-- Contraintes pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `FK_Orders_Customers` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
  ADD CONSTRAINT `FK_Orders_Employees` FOREIGN KEY (`EmployeeID`) REFERENCES `Employees` (`EmployeeID`),
  ADD CONSTRAINT `FK_Orders_Shippers` FOREIGN KEY (`ShipVia`) REFERENCES `Shippers` (`ShipperID`);

--
-- Contraintes pour la table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `FK_Products_Categories` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`CategoryID`),
  ADD CONSTRAINT `FK_Products_Suppliers` FOREIGN KEY (`SupplierID`) REFERENCES `Suppliers` (`SupplierID`);

--
-- Contraintes pour la table `Territories`
--
ALTER TABLE `Territories`
  ADD CONSTRAINT `FK_Territories_Region` FOREIGN KEY (`RegionID`) REFERENCES `Region` (`RegionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
