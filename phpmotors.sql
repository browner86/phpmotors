-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2021 at 05:59 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(10) UNSIGNED NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(8, 'Motorcycles'),
(9, 'Off Road');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3','') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(22, 'Brian', 'Brown', 'brian@mesquiteroot.com', '$2y$10$O.QRl9uIBI/oQb5cXP2sqeYWAxEPGWbXTkS/4tAru27fYegkOsPUK', '1', NULL),
(24, 'Admin', 'User', 'admin@cse340.net', '$2y$10$PJHKmUvgWXgyXtVkdp5dM.bAYTwPMBR5fYNGKZ7OaVRI/.NRHYo2y', '3', NULL),
(25, 'Bob', 'Ross', 'bob@happytrees.com', '$2y$10$MNPbPhXglWLfJUSVWeOoTuDbqiGA1VsnQaQSszUoacGpBRrd9p4bK', '1', NULL),
(26, 'Nathan', 'Ottobot', 'Notttobot64@aol.com', '$2y$10$71jj46WXGwmKOcMKw682KekzBHnUxanJ/SkuaP7R5/otA815UajP2', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(15, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-07-04 00:09:24', 1),
(16, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-07-04 00:09:24', 1),
(17, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-07-04 00:09:49', 1),
(18, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-07-04 00:09:49', 1),
(19, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-07-04 00:10:17', 1),
(20, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-07-04 00:10:17', 1),
(21, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-07-04 00:10:47', 1),
(22, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-07-04 00:10:47', 1),
(23, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-07-04 00:11:21', 1),
(24, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-07-04 00:11:21', 1),
(25, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-07-04 00:12:18', 1),
(26, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-07-04 00:12:18', 1),
(27, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-07-04 00:16:21', 1),
(28, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-07-04 00:16:21', 1),
(29, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-07-04 00:17:16', 1),
(30, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-07-04 00:17:16', 1),
(31, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-07-04 00:18:04', 1),
(32, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-07-04 00:18:04', 1),
(33, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-07-04 00:18:31', 1),
(34, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-07-04 00:18:31', 1),
(35, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-07-04 00:18:58', 1),
(36, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-07-04 00:18:58', 1),
(37, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-07-04 00:19:11', 1),
(38, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-07-04 00:19:11', 1),
(39, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-07-04 00:19:34', 1),
(40, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-07-04 00:19:34', 1),
(41, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-07-04 00:20:12', 1),
(42, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-07-04 00:20:12', 1),
(43, 15, 'dogCar.jpg', '/phpmotors/images/vehicles/dogCar.jpg', '2021-07-04 00:20:53', 1),
(44, 15, 'dogCar-tn.jpg', '/phpmotors/images/vehicles/dogCar-tn.jpg', '2021-07-04 00:20:53', 1),
(47, 15, 'dogCar2.jpeg', '/phpmotors/images/vehicles/dogCar2.jpeg', '2021-07-04 00:35:34', 0),
(48, 15, 'dogCar2-tn.jpeg', '/phpmotors/images/vehicles/dogCar2-tn.jpeg', '2021-07-04 00:35:34', 0),
(49, 26, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-07-04 00:43:10', 1),
(50, 26, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-07-04 00:43:10', 1),
(51, 3, 'aventator2.jpeg', '/phpmotors/images/vehicles/aventator2.jpeg', '2021-07-04 02:36:09', 0),
(52, 3, 'aventator2-tn.jpeg', '/phpmotors/images/vehicles/aventator2-tn.jpeg', '2021-07-04 02:36:09', 0),
(53, 10, 'camaro2.jpeg', '/phpmotors/images/vehicles/camaro2.jpeg', '2021-07-04 02:36:28', 0),
(54, 10, 'camaro2-tn.jpeg', '/phpmotors/images/vehicles/camaro2-tn.jpeg', '2021-07-04 02:36:28', 0),
(55, 6, 'batmobile2.jpg', '/phpmotors/images/vehicles/batmobile2.jpg', '2021-07-04 02:37:31', 0),
(56, 6, 'batmobile2-tn.jpg', '/phpmotors/images/vehicles/batmobile2-tn.jpg', '2021-07-04 02:37:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(255) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/dogCar.jpg', '/phpmotors/images/vehicles/dogCar-tn.jpg', '35000', 1, 'Brown', 2),
(26, 'DMC', 'DeLorean', 'See the Future', '../images/no-image.png', '../images/no-image.png', '85000', 1, 'Gray', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(1, 'Really good at climbing', '2021-07-13 18:35:21', 1, 22),
(11, 'Not Bad At All', '2021-07-14 09:33:10', 1, 24),
(12, 'A little Tall for me. Traded it in for a Miata.', '2021-07-14 17:00:26', 4, 24),
(13, 'Didn&#39;t Fit in My Garage. Would not reccomend', '2021-07-14 17:00:48', 8, 24),
(15, 'Too Cartoony for me.', '2021-07-14 17:15:53', 7, 24),
(16, 'I own several of these and they make great birthday gifts.', '2021-07-14 17:39:14', 3, 25),
(17, 'Pretty good but I have to say I prefer my Cessna.', '2021-07-14 17:39:22', 13, 25),
(18, 'I went back in time and met Leonardo DeVinci. I think i&#39;m a better artist.', '2021-07-14 17:40:00', 26, 25),
(19, 'This truck really gets the ladies excited.', '2021-07-14 17:41:10', 4, 25),
(20, 'Nice Try FBI...', '2021-07-14 17:42:01', 14, 25),
(21, 'I got one of these from beating up its previous owner. Surprisingly, it kind of smelled like cats.', '2021-07-14 17:42:49', 6, 25),
(22, 'I quit my job and now I make $8k per day working from home. You can too just go to www.virusdownload.com and leave your personal information.', '2021-07-14 17:50:22', 3, 26);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_invId` (`invId`),
  ADD KEY `FK_clientID` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_img_Inv` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_Inv_class` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
