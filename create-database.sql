-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 fév. 2024 à 11:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `AdressId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Street` varchar(25) DEFAULT NULL,
  `City` varchar(90) DEFAULT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `PostalCode` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `UserId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `ProductName` varchar(25) DEFAULT NULL,
  `UserName` varchar(25) DEFAULT NULL,
  `Quantity` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

CREATE TABLE `invoices` (
  `UserId` int(11) DEFAULT NULL,
  `InvoiceId` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `InvoiceDate` datetime DEFAULT NULL,
  `UnitPrice` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `AdressId` int(11) DEFAULT NULL,
  `DepartureDate` datetime DEFAULT NULL,
  `ArrivalDate` datetime DEFAULT NULL,
  `DeliveryCompany` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `UserId` int(11) DEFAULT NULL,
  `CardType` varchar(15) DEFAULT NULL,
  `CardNumber` varchar(70) DEFAULT NULL,
  `ExpirationDate` char(5) DEFAULT NULL,
  `CVV` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Description` VARCHAR(255) NOT NULL,
  `Vendor` varchar(20) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products_photo`
--

CREATE TABLE `products_photo` (
  `ProductId` int(11) DEFAULT NULL,
  `Image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rates`
--

CREATE TABLE `rates` (
  `UserId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Stars` int(11) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `LastName` varchar(25) DEFAULT NULL,
  `FirstName` varchar(25) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Passwd` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_photo`
--

CREATE TABLE `users_photo` (
  `UserId` int(11) DEFAULT NULL,
  `Image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`AdressId`),
  ADD KEY `UserId` (`UserId`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD KEY `UserId` (`UserId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Index pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `AdressId` (`AdressId`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD KEY `UserId` (`UserId`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`);

--
-- Index pour la table `products_photo`
--
ALTER TABLE `products_photo`
  ADD KEY `ProductId` (`ProductId`);

--
-- Index pour la table `rates`
--
ALTER TABLE `rates`
  ADD KEY `UserId` (`UserId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- Index pour la table `users_photo`
--
ALTER TABLE `users_photo`
  ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `AdressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Contraintes pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoices` (`InvoiceId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`AdressId`) REFERENCES `adresses` (`AdressId`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Contraintes pour la table `products_photo`
--
ALTER TABLE `products_photo`
  ADD CONSTRAINT `products_photo_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Contraintes pour la table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`);

--
-- Contraintes pour la table `users_photo`
--
ALTER TABLE `users_photo`
  ADD CONSTRAINT `users_photo_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
