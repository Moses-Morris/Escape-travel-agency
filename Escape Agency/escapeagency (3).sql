-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 08:45 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escapeagency`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

CREATE TABLE `accomodation` (
  `HostingID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `Type` enum('hotel','resort','airbnb') NOT NULL DEFAULT 'hotel',
  `PricePerNight` int(11) NOT NULL,
  `RatingAVG` decimal(3,2) NOT NULL DEFAULT 0.00,
  `ImageURL` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `DistFromOrigin` int(11) NOT NULL DEFAULT 0,
  `Features` text DEFAULT NULL,
  `active` varchar(254) NOT NULL DEFAULT 'active',
  `Description` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgentID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accomodation`
--

INSERT INTO `accomodation` (`HostingID`, `Name`, `DestinationID`, `Type`, `PricePerNight`, `RatingAVG`, `ImageURL`, `Location`, `DistFromOrigin`, `Features`, `active`, `Description`, `Created_at`, `AgentID`) VALUES
(1, 'Grand Hotel', 1, 'hotel', 200, '4.50', 'hotel1.jpg', 'Arizona', 5, 'Pool, WiFi, Breakfast', 'active', 'Luxury hotel in Arizona.', '2025-03-03 13:06:32', 2),
(2, 'Eiffel Stay', 2, 'airbnb', 150, '4.60', 'hotel2.jpg', 'Paris', 2, 'WiFi, Kitchen, Balcony', 'active', 'Cozy stay near Eiffel.', '2025-03-03 13:06:32', 6),
(3, 'Great Wall Resort', 3, 'resort', 250, '4.70', 'hotel3.jpg', 'Beijing', 10, 'Spa, Breakfast, Mountain View', 'active', 'Luxurious resort near the Great Wall.', '2025-03-03 13:06:32', 3),
(4, 'Santorini Villas', 4, 'airbnb', 180, '4.80', 'hotel4.jpg', 'Santorini', 3, 'Beach Access, Pool, Bar', 'active', 'Stunning villas in Santorini.', '2025-03-03 13:06:32', 4),
(5, 'Inca Lodge', 5, 'hotel', 160, '4.60', 'hotel5.jpg', 'Cusco', 7, 'Breakfast, WiFi, Tours', 'active', 'Comfortable lodge near Machu Picchu.', '2025-03-03 13:06:32', 1),
(6, 'Bali Beach Resort', 6, 'resort', 220, '4.90', 'hotel6.jpg', 'Bali', 2, 'Beachfront, Pool, Spa', 'active', 'Exclusive resort in Bali.', '2025-03-03 13:06:32', 7),
(7, 'Liberty Suites', 7, 'hotel', 140, '4.40', 'hotel7.jpg', 'New York', 1, 'City View, WiFi, Breakfast', 'active', 'Elegant hotel near the Statue of Liberty.', '2025-03-03 13:06:32', 3),
(8, 'Giza Retreat', 8, 'airbnb', 130, '4.50', 'hotel8.jpg', 'Giza', 8, 'WiFi, Rooftop, Historic View', 'active', 'Unique stay near the pyramids.', '2025-03-03 13:06:32', 5),
(9, 'Venetian Hideaway', 9, 'resort', 200, '4.80', 'hotel9.jpg', 'Venice', 4, 'Canal View, Gondola Access, Fine Dining', 'active', 'Romantic getaway in Venice.', '2025-03-03 13:06:32', 6),
(10, 'Falls Lodge', 10, 'hotel', 180, '4.70', 'hotel10.jpg', 'Ontario', 3, 'Waterfall View, WiFi, Spa', 'active', 'Peaceful stay near Niagara Falls.', '2025-03-03 13:06:32', 2),
(11, 'Seaside Hotel', 1, 'hotel', 150, '4.20', 'hotel.jpg', 'Beachfront', 0, 'WiFi, Pool, Breakfast', 'active', 'Luxury stay by the beach.', '2025-03-03 13:22:15', 2),
(12, 'Alpine Resort', 2, 'resort', 200, '4.70', 'resort.jpg', 'Mountain View', 0, 'Spa, Hiking, Gym', 'active', 'Cozy resort in the Alps.', '2025-03-03 13:22:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ActivityID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `ImageURL` varchar(255) NOT NULL DEFAULT '0',
  `RatingAVG` decimal(3,2) NOT NULL,
  `Duration` varchar(255) DEFAULT '1',
  `Status` varchar(254) NOT NULL DEFAULT 'active',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `DestinationID` int(254) NOT NULL DEFAULT 1,
  `AgentID` int(254) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ActivityID`, `Name`, `Description`, `Price`, `ImageURL`, `RatingAVG`, `Duration`, `Status`, `Created_at`, `DestinationID`, `AgentID`) VALUES
(1, 'Scuba Diving', 'Explore the deep blue sea.', 100, 'scuba.jpg', '4.60', '3 hours', 'active', '2025-03-03 13:21:59', 1, 1),
(2, 'Hiking', 'Guided mountain hiking.', 50, 'hiking.jpg', '4.80', '5 hours', 'active', '2025-03-03 13:21:59', 1, 1),
(3, 'Scuba Diving', 'Explore the deep blue sea.', 100, 'scuba.jpg', '4.60', '3 hours', 'active', '2025-03-03 13:22:15', 1, 1),
(4, 'Hiking', 'Guided mountain hiking.', 50, 'hiking.jpg', '4.80', '5 hours', 'active', '2025-03-03 13:22:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adventures`
--

CREATE TABLE `adventures` (
  `AdventureID` int(11) NOT NULL,
  `ImageURL` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `RatingAVG` varchar(255) NOT NULL DEFAULT '0',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adventures`
--

INSERT INTO `adventures` (`AdventureID`, `ImageURL`, `Location`, `RatingAVG`, `Created_at`) VALUES
(1, 'adventure1.jpg', 'Tsavo National Park', '4.8', '2025-03-03 13:18:42'),
(2, 'adventure2.jpg', 'Mount Kenya', '4.9', '2025-03-03 13:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `agentads`
--

CREATE TABLE `agentads` (
  `AdID` int(11) NOT NULL,
  `AdName` varchar(255) DEFAULT NULL,
  `AgentID` int(11) NOT NULL,
  `Keywords` varchar(255) DEFAULT NULL,
  `DiscountID` int(11) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `PosterImg` varchar(255) DEFAULT NULL,
  `StartDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `EndDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('active','inactive') DEFAULT 'active',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agentproperties`
--

CREATE TABLE `agentproperties` (
  `PropertyID` int(11) NOT NULL,
  `PropertyName` varchar(254) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `Status` enum('active','inactive') DEFAULT 'active',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `RatingAVG` decimal(3,2) NOT NULL DEFAULT 0.00,
  `Services` varchar(255) NOT NULL DEFAULT ' ',
  `Features` varchar(255) NOT NULL DEFAULT ' ',
  `Description` text DEFAULT NULL,
  `Price` int(11) DEFAULT 0,
  `Location` varchar(255) DEFAULT NULL,
  `OptionType` varchar(255) DEFAULT NULL,
  `AgentType` varchar(255) DEFAULT NULL,
  `ImageURL` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agentproperties`
--

INSERT INTO `agentproperties` (`PropertyID`, `PropertyName`, `AgentID`, `Status`, `Created_at`, `RatingAVG`, `Services`, `Features`, `Description`, `Price`, `Location`, `OptionType`, `AgentType`, `ImageURL`) VALUES
(1, 'Villa', 1, 'active', '2025-04-01 08:11:23', '0.00', ' House Room Services', ' Wifi, Chefs, Bathtabs, Pool', 'Get an amazing Experience with this Vila', 400, 'Kenya', 'Cruise', 'Travel', 'klnlbskbkjmnv,mnkv');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `AgentID` int(11) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Keywords` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` varchar(254) NOT NULL DEFAULT 'hashedpassword',
  `Phone` varchar(255) NOT NULL,
  `AgentType` enum('Travel','Hosting','Transport','Adventure','Cruise') NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Established` timestamp NOT NULL DEFAULT current_timestamp(),
  `Services` text NOT NULL,
  `Status` enum('active','inactive') DEFAULT 'inactive',
  `ProfileImg` varchar(255) DEFAULT 'default.jpg',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`AgentID`, `CompanyName`, `Description`, `Keywords`, `Email`, `PasswordHash`, `Phone`, `AgentType`, `Country`, `Location`, `Established`, `Services`, `Status`, `ProfileImg`, `Created_at`) VALUES
(1, 'Elite Travel Kenya', 'Luxury and budget travel solutions in Kenya and beyond.', 'Luxury Travel, Flight Booking, Tours', 'contact@elitetravel.co.ke', 'hashedpassword', '254712345678', 'Travel', 'Kenya', 'Nairobi', '0000-00-00 00:00:00', 'International & Local Tours, Flight Booking', 'active', 'elite_travel.jpg', '2025-03-06 11:17:10'),
(2, 'Coastal Getaways', 'Beach vacations and adventure tourism in the Indian Ocean region.', 'Beach Tours, Snorkeling, Diving', 'book@coastalgetaways.com', 'hashedpassword', '254745678901', 'Travel', 'Kenya', 'Diani Beach', '0000-00-00 00:00:00', 'Beach Packages, Diving, Snorkeling', 'active', 'coastal_getaways.jpg', '2025-03-06 11:17:10'),
(3, 'Safari Globe', 'Guided safari experiences with expert travel consultants.', 'African Safaris, Wildlife Tours', 'info@safariglobe.com', 'hashedpassword', '254798345678', 'Travel', 'Kenya', 'Nairobi', '0000-00-00 00:00:00', 'Wildlife Safaris, Mountain Climbing', 'active', 'safari_globe.jpg', '2025-03-06 11:17:10'),
(4, 'Misty Mountains Lodges', 'Luxury eco-lodges for an immersive safari experience.', 'Luxury Lodges, Eco Retreats, Safari Camps', 'stay@mistymountains.com', 'hashedpassword', '254798765432', 'Hosting', 'Uganda', 'Kampala', '0000-00-00 00:00:00', 'Luxury Lodges, Safari Camps, Eco Retreats', 'active', 'misty_lodges.jpg', '2025-03-06 11:17:10'),
(5, 'Zanzibar Beach Stays', 'Premium beachfront resorts for a tropical escape.', 'Beach Resorts, Island Retreats, Ocean Views', 'zanzibar@beachstays.com', 'hashedpassword', '255789012345', 'Hosting', 'Tanzania', 'Zanzibar', '0000-00-00 00:00:00', 'Luxury Beach Resorts & Villas', 'active', 'zanzibar_resorts.jpg', '2025-03-06 11:17:10'),
(6, 'Serengeti Safari Lodges', 'Exclusive accommodations in the Serengeti National Park.', 'Safari Lodges, Nature Retreats, Wildlife Views', 'booking@serengetisafari.com', 'hashedpassword', '255700567890', 'Hosting', 'Tanzania', 'Serengeti', '0000-00-00 00:00:00', 'Luxury Safari Lodges & Tented Camps', 'active', 'serengeti_lodges.jpg', '2025-03-06 11:17:10'),
(7, 'Skyline Transport Services', 'Reliable transport solutions for travelers and tourists.', 'Airport Transfers, Car Rentals, Tour Buses', 'booking@skytransport.com', 'hashedpassword', '254700567890', 'Transport', 'Kenya', 'Mombasa', '0000-00-00 00:00:00', 'Airport Transfers, Tour Buses, Private Cars', 'active', 'skyline_transport.jpg', '2025-03-06 11:17:10'),
(8, 'Nairobi City Express', 'Executive transport services within Nairobi and beyond.', 'Executive Cars, Chauffeur Services, Airport Pickups', 'info@ncexpress.com', 'hashedpassword', '254733456789', 'Transport', 'Kenya', 'Nairobi', '0000-00-00 00:00:00', 'Airport Transfers, Executive Car Hire', 'active', 'nairobi_express.jpg', '2025-03-06 11:17:10'),
(9, 'Tanzania Road Trips', 'Road trip adventures with car hire and guided services.', 'Car Rentals, Road Trips, Tour Guides', 'rentals@tzroadtrips.com', 'hashedpassword', '255765432109', 'Transport', 'Tanzania', 'Arusha', '0000-00-00 00:00:00', 'Self-Drive & Guided Road Trips', 'active', 'tz_roadtrips.jpg', '2025-03-06 11:17:10'),
(10, 'Big Five Safari Tours', 'Experience the Big Five in their natural habitat.', 'Big Five Safari, Wildlife Adventures', 'tours@bigfive.com', 'hashedpassword', '254701234568', 'Adventure', 'Tanzania', 'Serengeti', '0000-00-00 00:00:00', 'Big Five Game Drives, Luxury Safari Camps', 'active', 'big_five_safari.jpg', '2025-03-06 11:17:10'),
(11, 'Safari World Tours', 'Specialized in curated wildlife safari tours.', 'Wildlife Safaris, Game Drives, Nature Walks', 'info@safariworld.com', 'hashedpassword', '254723456789', 'Adventure', 'Kenya', 'Maasai Mara', '0000-00-00 00:00:00', 'Wildlife Safaris, Nature Walks, Game Drives', 'active', 'safari_world.jpg', '2025-03-06 11:17:10'),
(12, 'Explore Uganda Adventures', 'Gorilla trekking and adventure travel in Uganda.', 'Gorilla Trekking, Hiking, Bird Watching', 'support@exploreuganda.com', 'hashedpassword', '256701234567', 'Adventure', 'Uganda', 'Bwindi', '0000-00-00 00:00:00', 'Gorilla Trekking, Hiking, Bird Watching', 'active', 'explore_uganda.jpg', '2025-03-06 11:17:10'),
(13, 'Serene Cruise & Tours', 'Luxury ocean cruises and private yacht experiences.', 'Ocean Cruises, Island Hopping, Yacht Charters', 'contact@serenecruise.com', 'hashedpassword', '255768901234', 'Cruise', 'Tanzania', 'Dar es Salaam', '0000-00-00 00:00:00', 'Ocean Cruises, Island Hopping, Yacht Charters', 'active', 'serene_cruise.jpg', '2025-03-06 11:17:10'),
(14, 'Victoria Lake Boat Safaris', 'Exclusive boat safari tours on Lake Victoria.', 'Boat Safaris, Fishing Trips, Island Tours', 'book@victoriaboats.com', 'hashedpassword', '256765098432', 'Cruise', 'Uganda', 'Jinja', '0000-00-00 00:00:00', 'Lake Cruises, Sport Fishing, Nature Trips', 'active', 'victoria_boats.jpg', '2025-03-06 11:17:10'),
(15, 'Lamu Dhow Adventures', 'Authentic Swahili dhow sailing experiences.', 'Dhow Sailing, Cultural Tours, Island Escapes', 'info@lamudhow.com', 'hashedpassword', '254756890123', 'Cruise', 'Kenya', 'Lamu', '0000-00-00 00:00:00', 'Dhow Cruises, Cultural Tours, Island Retreats', 'active', 'lamu_dhow.jpg', '2025-03-06 11:17:10'),
(16, 'Great Migration Tours', 'See the world-famous wildebeest migration.', 'Great Migration, Masai Mara Tours', 'contact@greatmigration.com', 'hashedpassword', '254721234567', 'Adventure', 'Kenya', 'Masai Mara', '0000-00-00 00:00:00', 'Wildebeest Migration Safari, Luxury Lodges', 'active', 'great_migration.jpg', '2025-03-06 11:17:10'),
(17, 'Kilimanjaro Expeditions', 'Trekking and climbing Mt. Kilimanjaro.', 'Mountain Climbing, Trekking, Guided Hikes', 'book@kiliexp.com', 'hashedpassword', '255754321098', 'Adventure', 'Tanzania', 'Moshi', '0000-00-00 00:00:00', 'Mt. Kilimanjaro Climbing, Trekking', 'active', 'kili_expeditions.jpg', '2025-03-06 11:17:10'),
(18, 'Rwanda Gorilla Expeditions', 'Gorilla trekking in Volcanoes National Park.', 'Gorilla Safaris, Volcano Climbing', 'info@gorillarwanda.com', 'hashedpassword', '250765432189', 'Adventure', 'Rwanda', 'Volcanoes National Park', '0000-00-00 00:00:00', 'Gorilla Trekking, Cultural Experiences', 'active', 'gorilla_rwanda.jpg', '2025-03-06 11:17:10'),
(19, 'Victoria Falls Adventure', 'Waterfall tours and adventure activities.', 'Victoria Falls, Water Rafting, Bungee Jumping', 'support@vicfalls.com', 'hashedpassword', '260732109876', 'Adventure', 'Zambia', 'Livingstone', '0000-00-00 00:00:00', 'Water Rafting, Bungee Jumping, Falls Tour', 'active', 'vic_falls.jpg', '2025-03-06 11:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `BlogID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `Role` varchar(254) NOT NULL DEFAULT '1',
  `DestinationID` int(11) NOT NULL DEFAULT 0,
  `BlogImage` varchar(255) NOT NULL,
  `Tagline` text DEFAULT NULL,
  `BlogTitle` varchar(255) NOT NULL,
  `Subtitle` varchar(255) NOT NULL,
  `PublishedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `BlogContent` varchar(255) NOT NULL,
  `Keywords` varchar(255) NOT NULL,
  `Published` int(254) NOT NULL DEFAULT 0,
  `Status` varchar(254) NOT NULL DEFAULT 'active',
  `Created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`BlogID`, `AuthorID`, `Role`, `DestinationID`, `BlogImage`, `Tagline`, `BlogTitle`, `Subtitle`, `PublishedDate`, `BlogContent`, `Keywords`, `Published`, `Status`, `Created_at`) VALUES
(1, 1, 'customer\r\n', 2, 'blog1.jpg', 'Explore the best', 'Why Mombasa is the perfect holiday spot', 'Best beaches and activities', '2025-03-03 13:18:42', 'Mombasa offers stunning beaches and exciting nightlife.', '#Mombasa #Travel', 0, 'active', '2025-03-13'),
(2, 1, 'agent', 3, 'blog2.jpg', 'Wildlife Adventure', 'A guide to Maasai Mara Safari', 'Everything you need to know', '2025-03-03 13:18:42', 'Experience the Big Five and breathtaking landscapes.', '#Safari #Wildlife', 1, 'active', '2025-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `HostingID` int(11) NOT NULL,
  `Activities` int(11) NOT NULL,
  `NumOfPeople` int(11) NOT NULL,
  `BookingType` varchar(255) NOT NULL,
  `StartDate` varchar(255) NOT NULL,
  `EndDate` varchar(255) NOT NULL,
  `TotalPrice` varchar(255) NOT NULL,
  `Status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `Active` enum('active','expired','delayed','cancelled','done') NOT NULL DEFAULT 'active',
  `Paid` tinyint(1) NOT NULL DEFAULT 0,
  `TravelOptions` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `FeatureID` int(254) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `DestinationID`, `HostingID`, `Activities`, `NumOfPeople`, `BookingType`, `StartDate`, `EndDate`, `TotalPrice`, `Status`, `Active`, `Paid`, `TravelOptions`, `Created_at`, `FeatureID`) VALUES
(1, 1, 2, 1, 3, 2, 'Family', '2025-07-01', '2025-07-10', '1500', 'confirmed', 'active', 1, 1, '2025-03-03 13:53:52', 1),
(2, 2, 3, 2, 4, 4, 'Friends', '2025-08-05', '2025-08-12', '2000', 'pending', 'active', 0, 2, '2025-03-03 13:53:52', 1),
(3, 3, 4, 3, 2, 1, 'Couple', '2025-09-15', '2025-09-20', '2500', 'cancelled', 'cancelled', 0, 3, '2025-03-03 13:53:52', 1),
(4, 4, 1, 4, 5, 5, 'Corporate', '2025-06-01', '2025-06-05', '3000', 'confirmed', 'active', 1, 1, '2025-03-03 13:53:52', 1),
(5, 5, 2, 5, 3, 3, 'Solo', '2025-11-10', '2025-11-15', '1200', 'confirmed', 'active', 1, 2, '2025-03-03 13:53:52', 1),
(6, 6, 5, 6, 6, 6, 'Family', '2025-12-01', '2025-12-10', '5000', 'pending', 'active', 0, 3, '2025-03-03 13:53:52', 1),
(7, 7, 6, 7, 2, 2, 'Friends', '2025-10-01', '2025-10-07', '1800', 'confirmed', 'active', 1, 1, '2025-03-03 13:53:52', 1),
(8, 8, 7, 8, 4, 4, 'Couple', '2025-09-20', '2025-09-25', '2200', 'cancelled', 'cancelled', 0, 2, '2025-03-03 13:53:52', 1),
(9, 9, 10, 9, 5, 5, 'Corporate', '2025-07-15', '2025-07-20', '3500', 'confirmed', 'active', 1, 3, '2025-03-03 13:53:52', 1),
(10, 10, 9, 10, 3, 3, 'Solo', '2025-06-10', '2025-06-15', '1100', 'pending', 'active', 0, 1, '2025-03-03 13:53:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `destinationgallery`
--

CREATE TABLE `destinationgallery` (
  `ID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Added_By` varchar(255) NOT NULL,
  `Image1` varchar(255) NOT NULL,
  `Image2` varchar(255) DEFAULT NULL,
  `Image3` varchar(255) DEFAULT NULL,
  `Image4` varchar(255) DEFAULT NULL,
  `Image5` varchar(255) DEFAULT NULL,
  `Status` enum('active','inactive') DEFAULT 'active',
  `Approved` enum('yes','no') DEFAULT 'no',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destinationgallery`
--

INSERT INTO `destinationgallery` (`ID`, `DestinationID`, `Description`, `Added_By`, `Image1`, `Image2`, `Image3`, `Image4`, `Image5`, `Status`, `Approved`, `Created_at`) VALUES
(1, 1, 'Stunning beach sunset view.', 'Admin', 'gallery1.jpg', 'gallery2.jpg', NULL, NULL, NULL, 'active', 'no', '2025-03-03 13:18:42'),
(2, 2, 'Wildlife adventure in Maasai Mara.', 'Admin', 'gallery3.jpg', 'gallery4.jpg', 'gallery5.jpg', NULL, NULL, 'active', 'no', '2025-03-03 13:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `DestinationID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `RatingAVG` decimal(3,2) NOT NULL DEFAULT 0.00,
  `Featured` tinyint(1) DEFAULT 0,
  `PopularityRanking` int(11) NOT NULL DEFAULT 0,
  `Activities` int(11) NOT NULL DEFAULT 0,
  `DistFromOrigin` int(11) NOT NULL DEFAULT 0,
  `TravelOptions` enum('Air','Water','Road') DEFAULT NULL,
  `AgentID` int(11) NOT NULL DEFAULT 0,
  `Status` enum('approved','unapproved') DEFAULT 'unapproved',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`DestinationID`, `Name`, `Location`, `Country`, `Description`, `ImageURL`, `Price`, `RatingAVG`, `Featured`, `PopularityRanking`, `Activities`, `DistFromOrigin`, `TravelOptions`, `AgentID`, `Status`, `Created_at`) VALUES
(1, 'Grand Canyon', 'Arizona', 'USA', 'A breathtaking canyon.', 'grandcanyon.jpg', 500, '4.80', 1, 1, 3, 1500, 'Air', 2, 'approved', '2025-03-03 13:27:46'),
(2, 'Eiffel Tower', 'Paris', 'France', 'Iconic landmark.', 'eiffel.jpg', 300, '4.90', 1, 2, 5, 0, 'Road', 6, 'approved', '2025-03-03 13:27:46'),
(3, 'Great Wall', 'Beijing', 'China', 'Historic ancient wall.', 'greatwall.jpg', 400, '4.70', 0, 3, 2, 1000, 'Road', 1, 'approved', '2025-03-03 13:27:46'),
(4, 'Santorini', 'Santorini', 'Greece', 'Beautiful island destination.', 'santorini.jpg', 700, '4.90', 1, 4, 6, 500, 'Water', 4, 'approved', '2025-03-03 13:27:46'),
(5, 'Machu Picchu', 'Cusco', 'Peru', 'Historic Inca city.', 'machupicchu.jpg', 600, '4.80', 0, 5, 4, 800, 'Air', 2, 'approved', '2025-03-03 13:27:46'),
(6, 'Bali', 'Bali', 'Indonesia', 'Tropical paradise.', 'bali.jpg', 650, '4.90', 1, 6, 5, 200, 'Water', 7, 'approved', '2025-03-03 13:27:46'),
(7, 'Statue of Liberty', 'New York', 'USA', 'Famous landmark.', 'liberty.jpg', 350, '4.70', 0, 7, 1, 0, 'Road', 3, 'approved', '2025-03-03 13:27:46'),
(8, 'Pyramids of Giza', 'Giza', 'Egypt', 'Ancient pyramids.', 'pyramids.jpg', 500, '4.80', 1, 8, 2, 1200, 'Road', 5, 'approved', '2025-03-03 13:27:46'),
(9, 'Venice', 'Venice', 'Italy', 'Romantic city on water.', 'venice.jpg', 600, '4.90', 1, 9, 3, 300, 'Water', 6, 'approved', '2025-03-03 13:27:46'),
(10, 'Niagara Falls', 'Ontario', 'Canada', 'Spectacular waterfalls.', 'niagara.jpg', 550, '4.80', 0, 10, 3, 100, 'Road', 1, 'approved', '2025-03-03 13:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `DiscountID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Discount` varchar(255) NOT NULL DEFAULT '1',
  `DiscountName` varchar(255) NOT NULL,
  `StartDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `EndDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `NumOfCodes` int(11) NOT NULL,
  `Status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgentID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`DiscountID`, `DestinationID`, `Code`, `Description`, `Discount`, `DiscountName`, `StartDate`, `EndDate`, `NumOfCodes`, `Status`, `Created_at`, `AgentID`) VALUES
(1, 1, 'SUMMER20', '20% off for summer travelers.', '20%', 'Summer Special', '2025-03-03 13:13:42', '2025-03-03 13:13:42', 50, 'active', '2025-03-03 13:13:42', 2),
(2, 2, 'WINTER15', '15% off for winter vacations.', '15%', 'Winter Deal', '2025-03-03 13:13:42', '2025-03-03 13:13:42', 30, 'active', '2025-03-03 13:13:42', 0),
(3, 1, 'SUMMER20', '20% off for summer travelers.', '20%', 'Summer Special', '2025-03-03 13:16:10', '2025-03-03 13:16:10', 50, 'active', '2025-03-03 13:16:10', 0),
(4, 2, 'WINTER15', '15% off for winter vacations.', '15%', 'Winter Deal', '2025-03-03 13:16:10', '2025-03-03 13:16:10', 30, 'active', '2025-03-03 13:16:10', 0),
(5, 1, 'SUMMER20', '20% off for summer travelers.', '20%', 'Summer Special', '2025-03-03 13:18:10', '2025-03-03 13:18:10', 50, 'active', '2025-03-03 13:18:10', 0),
(6, 2, 'WINTER15', '15% off for winter vacations.', '15%', 'Winter Deal', '2025-03-03 13:18:10', '2025-03-03 13:18:10', 30, 'active', '2025-03-03 13:18:10', 1),
(7, 1, 'SUMMER20', '20% off for summer travelers.', '20%', 'Summer Special', '2025-03-03 13:18:41', '2025-03-03 13:18:41', 50, 'inactive', '2025-03-03 13:18:41', 0),
(8, 2, 'WINTER15', '15% off for winter vacations.', '15%', 'Winter Deal', '2025-03-03 13:18:41', '2025-03-03 13:18:41', 30, 'active', '2025-03-03 13:18:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Activities` int(11) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `DestinationID` int(11) NOT NULL DEFAULT 0,
  `StartDate` varchar(255) NOT NULL,
  `EndDate` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `ImageURL` varchar(255) NOT NULL,
  `LikesAVG` int(11) NOT NULL DEFAULT 0,
  `Description` text NOT NULL,
  `Tagline` varchar(255) NOT NULL,
  `RatingAVG` decimal(3,2) NOT NULL DEFAULT 0.00,
  `Status` varchar(254) NOT NULL DEFAULT 'active',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgentID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `Activities`, `Location`, `Country`, `DestinationID`, `StartDate`, `EndDate`, `Price`, `ImageURL`, `LikesAVG`, `Description`, `Tagline`, `RatingAVG`, `Status`, `Created_at`, `AgentID`) VALUES
(1, 'Safari Adventure', 5, 'Nairobi', 'Kenya', 1, '2025-03-10', '2025-03-15', 500, 'safari.jpg', 100, 'Experience the wild', 'Wildlife at its best', '4.80', 'active', '2025-03-03 13:08:03', 2),
(2, 'Mountain Hike', 3, 'Mt. Kilimanjaro', 'Tanzania', 2, '2025-04-01', '2025-04-05', 800, 'hike.jpg', 150, 'Conquer the highest peaks', 'Reach new heights', '4.70', 'active', '2025-03-03 13:08:03', 3),
(3, 'Beach Party', 4, 'Diani Beach', 'Kenya', 3, '2025-05-15', '2025-05-18', 200, 'beach.jpg', 80, 'Relax by the ocean', 'Sun, sand, and sea', '4.60', 'active', '2025-03-03 13:08:03', 1),
(4, 'Desert Safari', 6, 'Dubai Desert', 'UAE', 4, '2025-06-10', '2025-06-12', 600, 'desert.jpg', 90, 'Thrilling sand dune rides', 'Feel the desert thrill', '4.50', 'inactive', '2025-03-03 13:08:03', 5),
(5, 'Cultural Tour', 3, 'Cape Town', 'South Africa', 5, '2025-07-20', '2025-07-22', 400, 'culture.jpg', 120, 'Immerse in traditions', 'Heritage comes alive', '4.90', 'active', '2025-03-03 13:08:03', 4),
(6, 'Snowboarding Trip', 2, 'Swiss Alps', 'Switzerland', 6, '2025-12-01', '2025-12-07', 1000, 'snowboard.jpg', 130, 'Feel the adrenaline', 'Glide through snow', '4.80', 'active', '2025-03-03 13:08:03', 6),
(7, 'Wildlife Expedition', 5, 'Serengeti', 'Tanzania', 7, '2025-08-10', '2025-08-14', 700, 'wildlife.jpg', 140, 'Explore the big five', 'Nature at its finest', '4.90', 'active', '2025-03-03 13:08:03', 3),
(8, 'Cruise Trip', 7, 'Caribbean', 'Multiple', 8, '2025-09-05', '2025-09-15', 2000, 'cruise.jpg', 180, 'Luxury at sea', 'Sail in style', '4.70', 'active', '2025-03-03 13:08:03', 2),
(9, 'Rainforest Adventure', 4, 'Amazon', 'Brazil', 9, '2025-11-01', '2025-11-06', 900, 'rainforest.jpg', 200, 'Journey into the wild', 'Uncover the unknown', '4.60', 'active', '2025-03-03 13:08:03', 7),
(10, 'Historical Walk', 2, 'Rome', 'Italy', 10, '2025-10-10', '2025-10-12', 300, 'rome.jpg', 160, 'Travel back in time', 'History comes alive', '4.80', 'active', '2025-03-03 13:08:03', 1),
(11, 'Beach Party', 5, 'Mombasa', 'Kenya', 1, '2025-06-01', '2025-06-05', 100, 'event1.jpg', 250, 'A thrilling beach party with live music.', 'Sun, Sand & Fun!', '4.70', 'active', '2025-03-03 13:13:41', 3),
(12, 'Safari Adventure', 3, 'Maasai Mara', 'Kenya', 2, '2025-07-10', '2025-07-15', 500, 'event2.jpg', 300, 'Experience the wild like never before.', 'Into the Wild!', '4.90', 'active', '2025-03-03 13:13:41', 5),
(13, 'Beach Party', 5, 'Mombasa', 'Kenya', 1, '2025-06-01', '2025-06-05', 100, 'event1.jpg', 250, 'A thrilling beach party with live music.', 'Sun, Sand & Fun!', '4.70', 'active', '2025-03-03 13:16:10', 3),
(14, 'Safari Adventure', 3, 'Maasai Mara', 'Kenya', 2, '2025-07-10', '2025-07-15', 500, 'event2.jpg', 300, 'Experience the wild like never before.', 'Into the Wild!', '4.90', 'active', '2025-03-03 13:16:10', 5),
(15, 'Beach Party', 5, 'Mombasa', 'Kenya', 1, '2025-06-01', '2025-06-05', 100, 'event1.jpg', 250, 'A thrilling beach party with live music.', 'Sun, Sand & Fun!', '4.70', 'active', '2025-03-03 13:18:10', 3),
(16, 'Safari Adventure', 3, 'Maasai Mara', 'Kenya', 2, '2025-07-10', '2025-07-15', 500, 'event2.jpg', 300, 'Experience the wild like never before.', 'Into the Wild!', '4.90', 'active', '2025-03-03 13:18:10', 5),
(17, 'Beach Party', 5, 'Mombasa', 'Kenya', 1, '2025-06-01', '2025-06-05', 100, 'event1.jpg', 250, 'A thrilling beach party with live music.', 'Sun, Sand & Fun!', '4.70', 'active', '2025-03-03 13:18:38', 3),
(18, 'Safari Adventure', 3, 'Maasai Mara', 'Kenya', 2, '2025-07-10', '2025-07-15', 500, 'event2.jpg', 300, 'Experience the wild like never before.', 'Into the Wild!', '4.90', 'active', '2025-03-03 13:18:38', 5);

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `FeatureID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Discount` varchar(255) NOT NULL DEFAULT '1',
  `StartDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `EndDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgentID` int(254) NOT NULL DEFAULT 1,
  `Status` int(254) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`FeatureID`, `DestinationID`, `Name`, `Description`, `Discount`, `StartDate`, `EndDate`, `Created_at`, `AgentID`, `Status`) VALUES
(1, 1, 'Luxury Safari', 'Exclusive safari experience with discounts', '15%', '2025-02-28 21:00:00', '2025-03-08 21:00:00', '2025-03-03 13:09:36', 1, 0),
(2, 2, 'Mountain Trek Deal', 'Special offer for Kilimanjaro hikers', '20%', '2025-04-04 21:00:00', '2025-04-19 21:00:00', '2025-03-03 13:09:36', 1, 1),
(3, 3, 'Beach Getaway', 'Discounts on beachside resorts', '10%', '2025-05-09 21:00:00', '2025-05-24 21:00:00', '2025-03-03 13:09:36', 1, 1),
(4, 4, 'Desert Thrill', 'Book now for an unforgettable ride', '18%', '2025-06-14 21:00:00', '2025-06-29 21:00:00', '2025-03-03 13:09:36', 1, 1),
(5, 5, 'Cultural Wonders', 'Explore cultural gems at reduced prices', '12%', '2025-06-30 21:00:00', '2025-07-13 21:00:00', '2025-03-03 13:09:36', 1, 1),
(6, 6, 'Snow Adventure', 'Winter fun with great discounts', '25%', '2025-12-04 21:00:00', '2025-12-19 21:00:00', '2025-03-03 13:09:36', 1, 1),
(7, 7, 'Wildlife Safari', 'Unbeatable deals on Serengeti tours', '22%', '2025-07-31 21:00:00', '2025-08-14 21:00:00', '2025-03-03 13:09:36', 1, 1),
(8, 8, 'Luxury Cruise', 'Early bird offers on cruises', '30%', '2025-09-09 21:00:00', '2025-09-24 21:00:00', '2025-03-03 13:09:36', 1, 1),
(9, 9, 'Rainforest Exploration', 'Special package for Amazon adventure', '15%', '2025-11-01 21:00:00', '2025-11-11 21:00:00', '2025-03-03 13:09:36', 1, 1),
(10, 10, 'Historic Journey', 'Step into history with special prices', '17%', '2025-10-04 21:00:00', '2025-10-19 21:00:00', '2025-03-03 13:09:36', 1, 1),
(11, 1, 'Summer Discount', 'Enjoy a 20% discount on all bookings.', '20%', '2025-05-31 21:00:00', '2025-06-29 21:00:00', '2025-03-03 13:13:42', 1, 1),
(12, 2, 'Winter Special', 'Get a 15% discount on your winter trip.', '15%', '2025-11-30 21:00:00', '2025-12-30 21:00:00', '2025-03-03 13:13:42', 1, 1),
(13, 1, 'Summer Discount', 'Enjoy a 20% discount on all bookings.', '20%', '2025-05-31 21:00:00', '2025-06-29 21:00:00', '2025-03-03 13:16:10', 1, 1),
(14, 2, 'Winter Special', 'Get a 15% discount on your winter trip.', '15%', '2025-11-30 21:00:00', '2025-12-30 21:00:00', '2025-03-03 13:16:10', 1, 1),
(15, 1, 'Summer Discount', 'Enjoy a 20% discount on all bookings.', '20%', '2025-05-31 21:00:00', '2025-06-29 21:00:00', '2025-03-03 13:18:10', 1, 1),
(16, 2, 'Winter Special', 'Get a 15% discount on your winter trip.', '15%', '2025-11-30 21:00:00', '2025-12-30 21:00:00', '2025-03-03 13:18:10', 1, 1),
(17, 1, 'Summer Discount', 'Enjoy a 20% discount on all bookings.', '20%', '2025-05-31 21:00:00', '2025-06-29 21:00:00', '2025-03-03 13:18:39', 1, 1),
(18, 2, 'Winter Special', 'Get a 15% discount on your winter trip.', '15%', '2025-11-30 21:00:00', '2025-12-30 21:00:00', '2025-03-03 13:18:39', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `NewsletterID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `SubscriptionStatus` tinyint(1) DEFAULT 1,
  `Enable` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`NewsletterID`, `Email`, `Created_at`, `SubscriptionStatus`, `Enable`) VALUES
(1, 'user1@example.com', '2025-03-03 13:13:42', 0, 1),
(2, 'user2@example.com', '2025-03-03 13:13:42', 1, 0),
(3, 'user1@example.com', '2025-03-03 13:16:10', 1, 1),
(4, 'user2@example.com', '2025-03-03 13:16:10', 1, 0),
(5, 'user1@example.com', '2025-03-03 13:18:10', 1, 1),
(6, 'user2@example.com', '2025-03-03 13:18:10', 1, 0),
(7, 'user1@example.com', '2025-03-03 13:18:41', 1, 1),
(8, 'user2@example.com', '2025-03-03 13:18:41', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgentID` int(11) NOT NULL DEFAULT 0,
  `Urgency` int(11) NOT NULL DEFAULT 0,
  `active` int(254) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `Message`, `Type`, `Status`, `Created_at`, `AgentID`, `Urgency`, `active`) VALUES
(1, 1, 'Your booking has been confirmed!', '', 'unread', '2025-03-01 07:00:00', 1, 0, 1),
(2, 2, 'New discount on safaris!', '', 'read', '2025-03-02 08:30:00', 0, 0, 1),
(3, 3, 'Reminder: Your trip is tomorrow.', '', 'unread', '2025-03-03 06:15:00', 0, 0, 1),
(4, 4, 'Exclusive offer for members!', '', 'read', '2025-03-04 11:00:00', 0, 0, 1),
(5, 5, 'Your wishlist destination is on sale!', '', 'unread', '2025-03-05 09:45:00', 0, 0, 1),
(6, 6, 'Limited-time cruise deal!', '', 'read', '2025-03-06 05:30:00', 0, 0, 1),
(7, 7, 'Travel insurance reminder.', '', 'unread', '2025-03-07 04:00:00', 0, 0, 1),
(8, 8, 'Flight price drop alert!', '', 'read', '2025-03-08 12:00:00', 0, 0, 1),
(9, 9, 'Your itinerary has been updated.', '', 'unread', '2025-03-09 15:20:00', 0, 0, 1),
(10, 10, 'New travel blog published.', '', 'read', '2025-03-10 17:10:00', 0, 0, 1),
(11, 1, 'Your booking has been confirmed.', 'alert', 'unread', '2025-03-03 13:13:42', 1, 1, 1),
(12, 2, 'New discount available for Maasai Mara Safari.', 'promo', 'unread', '2025-03-03 13:13:42', 5, 2, 1),
(13, 1, 'Your booking has been confirmed.', 'alert', 'unread', '2025-03-03 13:16:10', 3, 1, 1),
(14, 2, 'New discount available for Maasai Mara Safari.', 'promo', 'unread', '2025-03-03 13:16:10', 5, 2, 1),
(15, 1, 'Your booking has been confirmed.', 'alert', 'unread', '2025-03-03 13:18:10', 3, 1, 1),
(16, 2, 'New discount available for Maasai Mara Safari.', 'promo', 'unread', '2025-03-03 13:18:10', 5, 2, 1),
(17, 1, 'Your booking has been confirmed.', 'alert', 'unread', '2025-03-03 13:18:40', 3, 1, 1),
(18, 2, 'New discount available for Maasai Mara Safari.', 'promo', 'unread', '2025-03-03 13:18:40', 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `OrderNo` int(11) NOT NULL,
  `Name` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `PayMethod` text DEFAULT NULL,
  `Status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `Active` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `TransactionDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `TransactionSummary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `OrderNo`, `Name`, `UserID`, `BookingID`, `Amount`, `PayMethod`, `Status`, `Active`, `TransactionDate`, `TransactionSummary`) VALUES
(1, 1001, 'Visa', 1, 1, 1500, 'Credit Card', 'paid', 'active', '2025-03-03 13:07:36', 'Payment successful'),
(2, 1002, 'Mastercard', 2, 2, 2000, 'Debit Card', 'unpaid', 'inactive', '2025-03-03 13:07:36', 'Pending confirmation'),
(3, 1003, 'PayPal', 3, 3, 2500, 'PayPal', 'paid', 'active', '2025-03-03 13:07:36', 'Transaction completed'),
(4, 1004, 'Stripe', 4, 4, 3000, 'Stripe', 'paid', 'active', '2025-03-03 13:07:36', 'Payment processed'),
(5, 1005, 'Bank Transfer', 5, 5, 1200, 'Bank Transfer', 'unpaid', 'inactive', '2025-03-03 13:07:36', 'Awaiting clearance'),
(6, 1006, 'Crypto', 6, 6, 5000, 'Bitcoin', 'paid', 'active', '2025-03-03 13:07:36', 'Confirmed on blockchain'),
(7, 1007, 'Visa', 7, 7, 1800, 'Credit Card', 'paid', 'active', '2025-03-03 13:07:36', 'Success'),
(8, 1008, 'Mastercard', 8, 8, 2200, 'Debit Card', 'unpaid', 'inactive', '2025-03-03 13:07:36', 'Pending approval'),
(9, 1009, 'PayPal', 9, 9, 3500, 'PayPal', 'paid', 'active', '2025-03-03 13:07:36', 'Transaction cleared'),
(10, 1010, 'Stripe', 10, 10, 1100, 'Stripe', 'paid', 'active', '2025-03-03 13:07:36', 'Processed successfully'),
(11, 1001, 'Visa', 1, 1, 1500, 'Credit Card', 'paid', 'active', '2025-03-03 13:08:53', 'Payment successful'),
(12, 1002, 'Mastercard', 2, 2, 2000, 'Debit Card', 'unpaid', 'inactive', '2025-03-03 13:08:53', 'Pending confirmation'),
(13, 1003, 'PayPal', 3, 3, 2500, 'PayPal', 'paid', 'active', '2025-03-03 13:08:53', 'Transaction completed'),
(14, 1004, 'Stripe', 4, 4, 3000, 'Stripe', 'paid', 'active', '2025-03-03 13:08:53', 'Payment processed'),
(15, 1005, 'Bank Transfer', 5, 5, 1200, 'Bank Transfer', 'unpaid', 'inactive', '2025-03-03 13:08:53', 'Awaiting clearance'),
(16, 1006, 'Crypto', 6, 6, 5000, 'Bitcoin', 'paid', 'active', '2025-03-03 13:08:53', 'Confirmed on blockchain'),
(17, 1007, 'Visa', 7, 7, 1800, 'Credit Card', 'paid', 'active', '2025-03-03 13:08:53', 'Success'),
(18, 1008, 'Mastercard', 8, 8, 2200, 'Debit Card', 'unpaid', 'inactive', '2025-03-03 13:08:53', 'Pending approval'),
(19, 1009, 'PayPal', 9, 9, 3500, 'PayPal', 'paid', 'active', '2025-03-03 13:08:53', 'Transaction cleared'),
(20, 1010, 'Stripe', 10, 10, 1100, 'Stripe', 'paid', 'active', '2025-03-03 13:08:53', 'Processed successfully');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `RatingAVG` decimal(3,2) NOT NULL,
  `ReviewComment` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(254) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `UserID`, `DestinationID`, `RatingAVG`, `ReviewComment`, `Created_at`, `Status`) VALUES
(1, 1, 2, '4.50', 'Amazing experience, highly recommend!', '2025-03-03 13:07:35', 'active'),
(2, 2, 3, '4.00', 'Great views and service!', '2025-03-03 13:07:35', 'active'),
(3, 3, 4, '3.50', 'Decent, but expected more.', '2025-03-03 13:07:35', 'active'),
(4, 4, 1, '5.00', 'Best vacation ever!', '2025-03-03 13:07:35', 'active'),
(5, 5, 5, '4.20', 'Good but a bit pricey.', '2025-03-03 13:07:35', 'active'),
(6, 6, 6, '3.80', 'Beautiful but crowded.', '2025-03-03 13:07:35', 'inactive'),
(7, 7, 7, '4.90', 'Absolutely loved it!', '2025-03-03 13:07:35', 'active'),
(8, 8, 8, '4.70', 'Great value for money.', '2025-03-03 13:07:35', 'active'),
(9, 9, 9, '4.30', 'Would visit again.', '2025-03-03 13:07:35', 'active'),
(10, 10, 10, '3.90', 'Nice experience overall.', '2025-03-03 13:07:35', 'active'),
(11, 1, 2, '4.50', 'Amazing experience, highly recommend!', '2025-03-03 13:08:53', 'active'),
(12, 2, 3, '4.00', 'Great views and service!', '2025-03-03 13:08:53', 'active'),
(13, 3, 4, '3.50', 'Decent, but expected more.', '2025-03-03 13:08:53', 'active'),
(14, 4, 1, '5.00', 'Best vacation ever!', '2025-03-03 13:08:53', 'active'),
(15, 5, 5, '4.20', 'Good but a bit pricey.', '2025-03-03 13:08:53', 'active'),
(16, 6, 6, '3.80', 'Beautiful but crowded.', '2025-03-03 13:08:53', 'active'),
(17, 7, 7, '4.90', 'Absolutely loved it!', '2025-03-03 13:08:53', 'active'),
(18, 8, 8, '4.70', 'Great value for money.', '2025-03-03 13:08:53', 'active'),
(19, 9, 9, '4.30', 'Would visit again.', '2025-03-03 13:08:53', 'active'),
(20, 10, 10, '3.90', 'Nice experience overall.', '2025-03-03 13:08:53', 'active'),
(21, 1, 1, '4.50', 'Amazing beach vacation!', '2025-03-03 13:22:15', 'active'),
(22, 2, 2, '4.80', 'Loved the mountain retreat.', '2025-03-03 13:22:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `traveloptions`
--

CREATE TABLE `traveloptions` (
  `TravelID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `TravelMode` enum('air','water','road','NONE') NOT NULL DEFAULT 'NONE',
  `Details` text DEFAULT NULL,
  `Prices` int(11) DEFAULT 0,
  `Status` enum('active','inactive','disabled') NOT NULL DEFAULT 'active',
  `Created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traveloptions`
--

INSERT INTO `traveloptions` (`TravelID`, `BookingID`, `DestinationID`, `AgentID`, `TravelMode`, `Details`, `Prices`, `Status`, `Created_at`) VALUES
(7, 1, 2, 1, 'air', 'Direct flight from Nairobi to Mombasa', 300, 'active', '2025-03-13'),
(8, 2, 3, 2, 'road', 'Luxury coach ride with meals included', 50, 'active', '2025-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Country` text NOT NULL DEFAULT 0,
  `Location` text NOT NULL DEFAULT 0,
  `ProfileImg` varchar(255) DEFAULT 'No Image',
  `Role` enum('customer','agent','admin','superadmin') DEFAULT 'customer',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Email`, `PasswordHash`, `Phone`, `Country`, `Location`, `ProfileImg`, `Role`, `Created_at`) VALUES
(1, 'John Doe', 'john@example.com', 'hashedpassword', '+1234567890', 'USA', 'New York', 'profile1.jpg', 'customer', '2025-03-03 12:56:59'),
(2, 'Alice Smith', 'alice@example.com', 'hashedpassword', '+1987654321', 'Canada', 'Toronto', 'profile2.jpg', 'agent', '2025-03-03 12:56:59'),
(3, 'Bob Johnson', 'bob@example.com', 'hashedpassword', '+1122334455', 'UK', 'London', 'profile3.jpg', 'admin', '2025-03-03 12:56:59'),
(4, 'Charlie Brown', 'charlie@example.com', 'hashedpassword', '+1444555666', 'Australia', 'Sydney', 'profile4.jpg', 'customer', '2025-03-03 12:56:59'),
(5, 'David Wilson', 'david@example.com', 'hashedpassword', '+1555666777', 'Germany', 'Berlin', 'profile5.jpg', 'superadmin', '2025-03-03 12:56:59'),
(6, 'Eva Green', 'eva@example.com', 'hashedpassword', '+1666777888', 'France', 'Paris', 'profile6.jpg', 'customer', '2025-03-03 12:56:59'),
(7, 'Frank White', 'frank@example.com', 'hashedpassword', '+1777888999', 'Japan', 'Tokyo', 'profile7.jpg', 'agent', '2025-03-03 12:56:59'),
(8, 'Grace Hall', 'grace@example.com', 'hashedpassword', '+1888999000', 'Italy', 'Rome', 'profile8.jpg', 'customer', '2025-03-03 12:56:59'),
(9, 'Henry Adams', 'henry@example.com', 'hashedpassword', '+1999000111', 'Spain', 'Madrid', 'profile9.jpg', 'admin', '2025-03-03 12:56:59'),
(10, 'Isabella Scott', 'isabella@example.com', 'hashedpassword', '+2111222333', 'India', 'Mumbai', 'profile10.jpg', 'customer', '2025-03-03 12:56:59'),
(11, 'Jack Turner', 'jack@example.com', 'hashedpassword', '+2222333444', 'Brazil', 'Rio de Janeiro', 'profile11.jpg', 'agent', '2025-03-03 12:56:59'),
(12, 'Karen Baker', 'karen@example.com', 'hashedpassword', '+2333444555', 'South Africa', 'Cape Town', 'profile12.jpg', 'customer', '2025-03-03 12:56:59'),
(13, 'Liam Harris', 'liam@example.com', 'hashedpassword', '+2444555666', 'Russia', 'Moscow', 'profile13.jpg', 'admin', '2025-03-03 12:56:59'),
(14, 'Mia Carter', 'mia@example.com', 'hashedpassword', '+2555666777', 'Mexico', 'Mexico City', 'profile14.jpg', 'superadmin', '2025-03-03 12:56:59'),
(15, 'Noah Anderson', 'noah@example.com', 'hashedpassword', '+2666777888', 'UAE', 'Dubai', 'profile15.jpg', 'customer', '2025-03-03 12:56:59'),
(16, 'John Doe', 'johndoe@example.com', 'hashedpassword1', '+1234567890', 'USA', 'New York', 'No Image', 'customer', '2025-03-03 13:22:14'),
(17, 'Jane Smith', 'janesmith@example.com', 'hashedpassword2', '+9876543210', 'UK', 'London', 'No Image', 'agent', '2025-03-03 13:22:14'),
(18, 'Admin User', 'admin@example.com', 'hashedpassword3', '+1122334455', 'UAE', 'Dubai', 'No Image', 'admin', '2025-03-03 13:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `WishlistID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DestinationID` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Count` int(254) DEFAULT 1,
  `Status` varchar(254) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`WishlistID`, `UserID`, `DestinationID`, `Created_at`, `Count`, `Status`) VALUES
(1, 1, 2, '2025-02-28 21:00:00', 1, 'active'),
(2, 2, 5, '2025-03-01 21:00:00', 1, 'active'),
(3, 3, 7, '2025-03-02 21:00:00', 1, 'active'),
(4, 4, 1, '2025-03-03 21:00:00', 1, 'active'),
(5, 5, 4, '2025-03-04 21:00:00', 1, 'active'),
(6, 6, 9, '2025-03-05 21:00:00', 1, 'active'),
(7, 7, 3, '2025-03-06 21:00:00', 1, 'active'),
(8, 8, 6, '2025-03-07 21:00:00', 1, 'active'),
(9, 9, 8, '2025-03-08 21:00:00', 1, 'active'),
(10, 10, 10, '2025-03-09 21:00:00', 1, 'active'),
(11, 1, 2, '2025-03-03 13:13:42', 1, 'active'),
(12, 2, 3, '2025-03-03 13:13:42', 1, 'active'),
(13, 1, 2, '2025-03-03 13:16:10', 1, 'active'),
(14, 2, 3, '2025-03-03 13:16:10', 1, 'active'),
(15, 1, 2, '2025-03-03 13:18:10', 1, 'active'),
(16, 2, 3, '2025-03-03 13:18:10', 1, 'active'),
(17, 1, 2, '2025-03-03 13:18:39', 1, 'active'),
(18, 2, 3, '2025-03-03 13:18:39', 1, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD PRIMARY KEY (`HostingID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ActivityID`);

--
-- Indexes for table `adventures`
--
ALTER TABLE `adventures`
  ADD PRIMARY KEY (`AdventureID`);

--
-- Indexes for table `agentads`
--
ALTER TABLE `agentads`
  ADD PRIMARY KEY (`AdID`),
  ADD KEY `AgentID` (`AgentID`),
  ADD KEY `DiscountID` (`DiscountID`);

--
-- Indexes for table `agentproperties`
--
ALTER TABLE `agentproperties`
  ADD PRIMARY KEY (`PropertyID`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`AgentID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`BlogID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `DestinationID` (`DestinationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `HostingID` (`HostingID`);

--
-- Indexes for table `destinationgallery`
--
ALTER TABLE `destinationgallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`DestinationID`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`DiscountID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`FeatureID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`NewsletterID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `DestinationID` (`DestinationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `traveloptions`
--
ALTER TABLE `traveloptions`
  ADD PRIMARY KEY (`TravelID`),
  ADD KEY `BookingID` (`BookingID`),
  ADD KEY `DestinationID` (`DestinationID`),
  ADD KEY `AgentID` (`AgentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishlistID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodation`
--
ALTER TABLE `accomodation`
  MODIFY `HostingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adventures`
--
ALTER TABLE `adventures`
  MODIFY `AdventureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agentads`
--
ALTER TABLE `agentads`
  MODIFY `AdID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agentproperties`
--
ALTER TABLE `agentproperties`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `AgentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `BlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `destinationgallery`
--
ALTER TABLE `destinationgallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `DestinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `DiscountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `FeatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `NewsletterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `traveloptions`
--
ALTER TABLE `traveloptions`
  MODIFY `TravelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD CONSTRAINT `accomodation_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`) ON DELETE CASCADE;

--
-- Constraints for table `agentads`
--
ALTER TABLE `agentads`
  ADD CONSTRAINT `agentads_ibfk_1` FOREIGN KEY (`AgentID`) REFERENCES `agents` (`AgentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `agentads_ibfk_2` FOREIGN KEY (`DiscountID`) REFERENCES `discounts` (`DiscountID`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`HostingID`) REFERENCES `accomodation` (`HostingID`);

--
-- Constraints for table `destinationgallery`
--
ALTER TABLE `destinationgallery`
  ADD CONSTRAINT `destinationgallery_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`);

--
-- Constraints for table `featured`
--
ALTER TABLE `featured`
  ADD CONSTRAINT `featured_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `traveloptions`
--
ALTER TABLE `traveloptions`
  ADD CONSTRAINT `traveloptions_ibfk_1` FOREIGN KEY (`BookingID`) REFERENCES `bookings` (`BookingID`),
  ADD CONSTRAINT `traveloptions_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`),
  ADD CONSTRAINT `traveloptions_ibfk_3` FOREIGN KEY (`AgentID`) REFERENCES `agents` (`AgentID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `destinations` (`DestinationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
