-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 08:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12




-- CREATE TABLE `invoices` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `invoice_number` varchar(50) NOT NULL,
--   `member_id` int(11) NOT NULL,
--   `plan_id` int(11) DEFAULT NULL,
--   `amount` decimal(10,2) NOT NULL,
--   `payment_method` varchar(50) NOT NULL,
--   `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
--   `transaction_id` varchar(100) DEFAULT NULL,
--   `payment_date` datetime DEFAULT NULL,
--   `due_date` date DEFAULT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   PRIMARY KEY (`id`),
--   KEY `member_id` (`member_id`),
--   KEY `plan_id` (`plan_id`),
--   CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`user_id`),
--   CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymnsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `OTP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `username`, `email`, `gender`, `password`, `contact`, `street`, `city`, `state`, `OTP`) VALUES
(1, 'admin', 'admin@gmail.com', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '5896321470', '123 shivay society', 'surat', 'Gujarat', ''),
(3, 'ava joy', 'avadh@gmail.com', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '9874521360', 'surat', 'surat', 'Gujarat', ''),
(4, 'ava joy', 'direya4166@halbov.com', 'Male', '7ef605fc8dba5425d6965fbd4c8fbe1f', '9874521360', 'surat', 'surat', 'Gujarat', '973126');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `date`) VALUES
(7, 'This is to announce that our GYM will remain close for 51 days due to COVID-19.', '2020-03-30'),
(8, 'Opening of GYM Halls and Clubs are not fixed yet. Stay tuned for more updates!!', '2020-04-03'),
(9, 'Renovation Going On...', '2020-04-04'),
(10, 'This is a demo announcement from admin', '2022-06-03'),
(11, 'hi everyone', '2025-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL,
  `present` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`, `answer`, `created_at`, `is_read`) VALUES
(4, 'ava joy', 'wotor30234@arensus.com', '09085647123', 'fs sjf skjsjneskjsjskjndwndnawkldwmdiowjfoefjefeifrvnviubrjendiuenkjesn', '', '2025-01-18 14:07:04', 1),
(7, 'white paguses', 'wotor30234@arensus.com', '09085647123', 'skjbnskfmjsnsm jn,f jne,fn,nfjsn skn  ,n,fnk,snkjsndnd f e', '', '2025-01-22 08:41:27', 1),
(8, 'ava joy', 'direya4166@halbov.com', '09085647123', 'hello sir i have some query for your gym to join your club plz reply  ', '', '2025-01-22 09:57:49', 1),
(9, 'white paguses', 'whitehack880@gmail.coom', '884866151398', ' mcs djasdhabdhdbawhdbawhjdbwhjdfbhj', '', '2025-01-22 10:00:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `amount` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `amount`, `quantity`, `vendor`, `description`, `address`, `contact`, `date`) VALUES
(3, 'Treadmill', 909, 4, 'DnS', 'Edited Description', '7 Cedarstone Drive', '8521479633', '2019-03-07'),
(4, 'Vertical Press Machine', 949, 3, 'SS Industries', 'For Biceps And Triceps, Upper Back, Chest', '7 Cedarstone Drive', '1245558980', '2020-03-19'),
(5, 'Dumbell - Adjustable', 102, 26, 'Uptown Suppliers', 'Material: Steel, Rubber Plastic, Concrete', '7 Cedarstone Drive', '9875552100', '2020-03-29'),
(6, 'Multi Bench Press Machine', 219, 2, 'DnS Suppliers', '6 In 1 Multi Bench With Incline, Flat, Decline Ben', '7 Cedarstone Drive', '7410001010', '2020-04-05'),
(7, 'Demo', 265, 5, 'Demo', 'This is a demo test.', '77 Demo Lane', '8524445452', '2020-04-03'),
(10, 'RowWarrior Fitness Rowing Mach', 5616, 12, 'Roww Stores', 'HIGHEST QUALITY: This best of class air rowing mac', '52 Weekley Street', '7412585555', '2021-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `gym_blogs`
--

CREATE TABLE `gym_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_blogs`
--

INSERT INTO `gym_blogs` (`id`, `title`, `content`, `image_path`, `created_at`) VALUES
(1, 'Essential Tips for food Beginners at the Gym', 'Starting your fitness journey at the gym can feel overwhelming, but with the right approach, you can set yourself up for success. Here are 10 essential tips for beginners:\r\n1. Set Clear Goals\r\nBefore stepping into the gym, decide what you want to achieve: weight loss, muscle building, or improved endurance. Clear goals will keep you motivated and help tailor your workouts.\r\n\r\n2. Start Slow and Build Gradually\r\nDon’t rush into heavy lifting or intense workouts. Start with lighter weights and shorter sessions, focusing on proper form to prevent injuries.\r\n\r\n3. Warm Up Properly\r\nAlways warm up before exercising to prepare your muscles and joints. Simple activities like jogging or dynamic stretches for 5–10 minutes can reduce the risk of injuries.\r\n\r\n', 'uploads/blogs/1.jpg', '2025-01-18 09:18:45'),
(2, 'Post-Workout Meals to Boost Recovery', 'Refueling your body after a workout is essential for muscle recovery, replenishing energy stores, and promoting overall health. A good post-workout meal should include a balance of protein, carbohydrates, and healthy fats. Here are some great options:\r\n1. Grilled Chicken with Sweet Potato\r\nWhy it’s great: Packed with lean protein for muscle repair and complex carbs to restore glycogen levels.\r\nTip: Add steamed veggies like broccoli or spinach for extra nutrients.\r\n2. Greek Yogurt and Fresh Fruit\r\nWhy it’s great: Greek yogurt provides high-quality protein, while fruits like berries or bananas offer quick-digesting carbs.\r\nTip: Sprinkle some chia seeds or granola for added fiber and omega-3s.', 'uploads/blogs/3.jpg', '2025-01-18 09:39:45'),
(3, 'kjks', 'ma dkas\r\n,mwa dwdj w\r\ndasndkjwndjawdasnm sb ejndkjsnjfes\r\nsebfehjbhjbjehesoskjfefe\r\nenmfbesjfbeshfbesf\r\nesjnfjesfbfjsbfhfbf\r\neskjheiuifhefjfiuhjfiuefih4', '', '2025-01-22 16:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `gym_images`
--

CREATE TABLE `gym_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_images`
--

INSERT INTO `gym_images` (`id`, `image_path`, `uploaded_at`) VALUES
(7, 'uploads/9.jpg', '2025-01-18 08:00:35'),
(15, 'uploads/blog-1-square.jpg', '2025-01-28 18:04:04'),
(16, 'uploads/blur.jpg', '2025-01-28 18:04:23'),
(17, 'uploads/1.jpg', '2025-01-28 18:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  `services` varchar(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `paid_date` date NOT NULL,
  `p_year` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `attendance_count` int(100) NOT NULL,
  `ini_weight` int(100) NOT NULL DEFAULT 0,
  `curr_weight` int(100) NOT NULL DEFAULT 0,
  `ini_bodytype` varchar(50) NOT NULL,
  `curr_bodytype` varchar(50) NOT NULL,
  `progress_date` date NOT NULL,
  `reminder` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `fullname`, `username`, `password`, `gender`, `dor`, `services`, `amount`, `paid_date`, `p_year`, `plan`, `address`, `contact`, `status`, `attendance_count`, `ini_weight`, `curr_weight`, `ini_bodytype`, `curr_bodytype`, `progress_date`, `reminder`) VALUES
(26, 'Mattie F. Maher', 'mattie', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '1995-05-18', 'Sauna', 420, '2022-06-01', 2022, '12', '73 Settlers Lane', '9995554444', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(27, 'Justin C. Lusk', 'justin', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '1995-12-12', 'Cardio', 40, '2022-05-30', 2022, '1', '45 Bell Street', '3545785540', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(29, 'Kathy J. Glennon', 'kathy', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2022-06-02', 'Fitness', 330, '2022-06-02', 0, '6', '87 Harry Place', '7896587458', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(30, 'avadh', '@avadh', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'Male', '2025-01-11', 'Fitness', 0, '0000-00-00', 0, '1', 'puga', '985632147', 'Pending', 0, 0, 0, '', '', '0000-00-00', 0),
(31, 'het', 'het123', '202cb962ac59075b964b07152d234b70', 'Male', '2025-01-11', 'Cardio', 0, '0000-00-00', 0, '1', 'punagam', '9852361470', 'Pending', 0, 0, 0, '', '', '0000-00-00', 0),
(32, 'ram', 'ram123', '6a557ed1005dddd940595b8fc6ed47b2', 'Male', '1991-02-05', 'Cardio', 40, '2025-01-11', 2025, '1', 'ayodhya', '6589742789', 'Active', 0, 0, 0, '', '', '0000-00-00', 1),
(33, 'avadh joshi ', 'ava123', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'Male', '2025-01-16', 'Fitness', 55, '2025-01-16', 2025, '1', '123 shiv society ,su', '6589742789', 'Active', 0, 0, 0, '', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'Duration in days',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `features` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `plan_name`, `duration`, `price`, `image`, `features`, `created_at`) VALUES
(1, 'Basic Plan', 30, 999.00, 'photo-1716307035615-1c6465a32ef2.jpeg', '<p>Access to gym floor</p>\r\n\r\n<p>Free locker facility</p>\r\n\r\n<p>No personal trainer</p>\r\n\r\n<p>Timing: 6 AM - 10 PM</p>\r\n\r\n<p><s>Unlimited access to gym floor</s></p>\r\n\r\n<p><s>Free locker facility</s></p>\r\n\r\n<p><s>Dedicated personal trainer</s></p>\r\n\r\n<p><s>Free access to group classes (yoga, Zumba, CrossFit)</s></p>\r\n', '2025-01-22 06:27:01'),
(2, 'Standard Plan', 90, 2499.00, 'photo-1716307035615-1c6465a32ef2.jpeg', '<p>Access to gym floor</p>\r\n\r\n<p>Free locker facility</p>\r\n\r\n<p>2 personal trainer sessions per month</p>\r\n\r\n<p>Free diet consultation (once per month)</p>\r\n\r\n<p>Timing: 6 AM - 10 PM</p>\r\n\r\n<p><s>Unlimited diet consultations</s></p>\r\n\r\n<p><s>Free access to group classes (yoga, Zumba, CrossFit)</s></p>\r\n\r\n<p><s>Complimentary gym kit (t-shirt, shaker)</s></p>\r\n', '2025-01-22 06:40:19'),
(4, 'Premium Plan', 180, 4999.00, 'photo-1716307035615-1c6465a32ef2.jpeg', '<p>Access to gym floor</p>\r\n\r\n<p>Free locker facility</p>\r\n\r\n<p>Timing: 24/7 access</p>\r\n\r\n<p>&nbsp;personal trainer sessions per month</p>\r\n\r\n<p>Free diet consultation (twice per month)</p>\r\n\r\n<p>Complimentary gym kit (t-shirt, shaker)</p>\r\n\r\n<p><s>Access to group classes (yoga, Zumba)</s></p>\r\n\r\n<p><s>Free access to group classes (yoga, Zumba, CrossFit)</s></p>\r\n', '2025-01-22 07:41:21'),
(5, 'Elite Plan', 365, 9999.00, 'photo-1716307035615-1c6465a32ef2.jpeg', '<ul>\r\n	<li>Unlimited access to gym floor</li>\r\n	<li>Free locker facility</li>\r\n	<li>Dedicated personal trainer</li>\r\n	<li>Unlimited diet consultations</li>\r\n	<li>Free access to group classes (yoga, Zumba, CrossFit)</li>\r\n	<li>Complimentary gym kit (t-shirt, shaker, etc.)</li>\r\n	<li>Timing: 24/7 access</li>\r\n</ul>\r\n', '2025-01-22 07:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `member_plans`
--

CREATE TABLE `member_plans` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive','expired') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` mediumtext NOT NULL,
  `pincode` int(200) NOT NULL,
  `total_price` int(200) NOT NULL,
  `pyment_method` varchar(200) NOT NULL,
  `pyment_id` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(300) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `pyment_method`, `pyment_id`, `status`, `comments`, `create_at`, `delivery`) VALUES
(8, '104425147423', 21, 'avadh Radadiya ajaybhai', 'avadh@gmail.com', '09085647123', '129 sarita society , punagam , surat', 390004, 57998, 'COD', NULL, 0, NULL, '2025-01-29 17:36:51', 0),
(9, '666526916747', 21, 'ayush mangukiya k.', 'ayush123@gmail.com', '9856320147', '125 rachana society , kapodara surat', 390004, 112000, 'COD', NULL, 0, NULL, '2025-01-30 16:46:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(200) NOT NULL,
  `product_id` int(200) NOT NULL,
  `qty` int(200) NOT NULL,
  `price` int(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`) VALUES
(6, 8, 2, 2, 12999, '2025-01-29 17:36:51'),
(7, 8, 9, 1, 32000, '2025-01-29 17:36:51'),
(8, 9, 9, 2, 32000, '2025-01-30 16:46:57'),
(9, 9, 3, 2, 24000, '2025-01-30 16:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `product_views` varchar(1000) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category_id`, `quantity`, `product_views`, `status`) VALUES
(1, 'Fitkit FT100 Series (3.25HP Peak) DC-Motorized Treadmill (Inclination: Manual, Max Weight: 110 Kg) with Free At Home Installation and Connected Live Interactive Sessions by Onefitplus', '61TLvvUdPWL._AC_SR160,134_QL64_.jpg', '<p>Brand Fitkit Colour Black Product Grade Home Product Dimensions 161.5D x 68W x 127H Centimeters Item Weight 57 Kilograms About this item Free Personal Dietitian (3 Months) and Personal Training Video Session along with Doctor Consultation for all Fitkit Treadmill users. In-Box Contents: 1 treadmill, toolkit, user manual and warranty card. Treadmill connects with the Fitplus App available on Android &amp; IOS platforms &ndash; It helps you track your daily workout and compiles all your data in one place. Fitplus App can also connect with the following Industry leading app - Apple Health, Fitbit, Google Fit, Amazon Alexa. 12 preset workout programs for efficient workout and changeable modes, to create a customized routine of exercises It is equipped with a powerful 1.75HP (Continuous) and 3.25HP (Peak) efficient DC Motor, 3 level manual inclination, Manual Lubrication for easy maintenance , a Speed Range of 0.8-14.8 km/hr, 1240*420 mm Wide Spacious anti-skid running board and can also be folded when not in use.It comes with a massager. LCD display showing speed, time, distance, calories burned and heart rate monitoring via heart rate sensor. It also comes with a safety key. Maximum user weight capacity - 110 kg, note: always choose a Treadmill that has user weight capacity at least 20 Kgs more than your current weight since the impact weight increases during running ,Warranty: 1 Year Warranty on Motor and Manufacturing Defect, 3 Years Warranty on Frame. Suggested to use a proper stabilizer. Easy folding &amp; Un-folding for more space saving &amp; easy mobility.</p>\r\n', 24999.00, 3, '5', '2', 1),
(2, 'Fitkit by Cult FT98 Carbon (2HP Peak, Max Speed - 14km/hr) Brushless Motorized Treadmill for Home Gym Fitness with 1 Year Warranty', '51H-UdRV2cL._AC_SR230,210_QL64_.jpg', '<p>Brand Fitkit Colour Black Product Grade Home Product Dimensions 147.3D x 70.4W x 109.4H Centimeters Item Weight 31 Kilograms About this item Motor horsepower: 1.25HP, Motor type: DC-Motorised, Belt size: 47.24&quot; X 16.53&quot;, Max Weight support: 90 Kilograms, Lubrication: Easy Lubrication. Always choose a treadmill that can support at least 20 more kilograms of weight than your current weight. LED display showing speed, time, distance, calories burned. You are advised to buy/install a voltage stabilizer with the treadmill to protect the motor from power fluctuations and ensure its long life. Additionally, please connect the product to a power point with adequate earthing to ensure discharge of extra current. Warranty details: 1 Year manufacturer warranty on Motor and Manufacturing Defect, 3 Year Warranty on Frame. Note: Fitkit Brand is a part of Cult. Active post-sales and customer support &ndash; After delivery please contact us us for installation support (Working hours: Monday to Sunday from 9am to 6pm) to register your installation. (Note: Service schedule varies by location). For safety reasons, wearing proper athletic shoes on the treadmill is mandatory, instead of going Barefoot</p>\r\n', 12999.00, 3, '6', '', 1),
(3, 'The Ohio Bar - Black Zinc', 'RA0539-BLBR-TH_rylohr.png', '<h2>THE OHIO BAR - CERAKOTE</h2>\r\n\r\n<p>MEN&#39;S 20KG MULTI-PURPOSE BARBELL</p>\r\n\r\n<p>Designed as an all-purpose barbell, the Ohio Bar excels in every movement&mdash;from the bench, squat, and deadlift to the clean, snatch, and everything in between. &nbsp;There is a reason that this barbell has been used at every CrossFit Games since its introduction in 2013 and is found in functional fitness gyms across the globe. &nbsp;Whether you&#39;re searching for the best barbell for your home gym or outfitting a facility, the Ohio Bar has you covered and is backed by a lifetime warranty.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>CRAFTED FOR EXCELLENCE IN COLUMBUS, OH</p>\r\n\r\n<p>Every Ohio Bar is meticulously machined and assembled in Columbus, OH using US steel that strikes the perfect balance between whip for Olympic lifts and rigidity for heavy Powerlifting. The 190,000 PSI tensile strength shaft features dual knurl marks for Olympic Weightlifting (IWF) and Powerlifting (IPF), and our signature Ohio knurling pattern that is carefully refined for a solid yet non-abrasive grip suitable for multi-purpose strength training.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 24000.00, 5, '5', '', 1),
(6, 'Durafit Strong 4.5 HP Peak DC Motorized Treadmill with Max Speed 14 Km/Hr, Max User Weight 120 Kg, Manual Incline, Free Installation Assistance', '6795efd150da21.07350754.jpg', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Brand</td>\r\n			<td>Durafit - Sturdy, Stable and Strong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Colour</td>\r\n			<td>Black</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Product Dimensions</td>\r\n			<td>136D x 62W x 114H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Item Weight</td>\r\n			<td>34 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Material</td>\r\n			<td>Alloy Steel</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<h1>About this item</h1>\r\n\r\n<ul>\r\n	<li>Motor Power &amp; User Weight: Experience smooth and efficient performance with a powerful 4.5 HP Peak motor, ideal for walking and running exercises. Our powerful motors are built to support a maximum user weight of 120 kg, ensuring a stable and safe workout environment for all users, regardless of weight.</li>\r\n	<li>Speed Range: Our treadmill offers a versatile speed range from 1 to 14 km/h. It is designed to cater to a broad spectrum of fitness levels and workout intensities. Our treadmill features a spacious 1100x400 mm runnning belt, making it comfortable for older users and convenient for long distance or high speed running by our younger users as well.</li>\r\n	<li>Display: Stay motivated with your workout information on LCD Display, displaying time, speed, distance, and calories burned. Enjoy 3 level manual Incline for varied workouts and 12 preset programs to do your workouts on cruise mode.</li>\r\n	<li>Foldability and Control: Our treadmill features hydraulic folding for effortless storage in home gyms with limited space. The deck smoothly lifts with a simple push, saving valuable floor space, occupying just 3.5 sqft of your home. Enjoy hassle-free accessibility without compromising on performance. Our treadmill allows for effortless start, Stop &amp; Speed adjustments via handrail controls, providing seamless customization during workouts.</li>\r\n	<li>Manufacturer Warranty: Rest assured with a 1-year manufacturer warranty, ensuring peace of mind and reliable support for your treadmill investment.</li>\r\n</ul>\r\n', 23999.00, 3, '10', '', 1),
(7, 'The Bella Bar 2.0 - Black Zinc', '6795f2534d17c3.65838140.jpeg', '<p>WOMEN&#39;S 15KG MULTI-PURPOSE BARBELL</p>\r\n\r\n<p>The Bella Bar is Rogue&#39;s go-to multipurpose 15KG barbell for female athletes. Fully machined and assembled in the USA, this versatile ladies bar is uniquely optimized for Olympic weightlifting, powerlifting, and/or a CrossFit WOD.</p>\r\n\r\n<p>Built with as much attention to detail as any bar in the Rogue family, the Bella Bar is a women&rsquo;s weightlifting bar forged on equal ground.</p>\r\n\r\n<p>A staple of women&rsquo;s CrossFit competitions-- including events at the CrossFit Games-- the 25MM Bella Bar has no center knurl and features the same Rogue signature dual knurl marks and 190,000 PSI tensile strength as our flagship 20KG Ohio Bar. The hybrid knurling pattern itself offers a firm but comfortable grip on both power lifts and Olympic lifts, while quality U.S. steel and snap-ring bronze bushings produce the perfect balance of spin and stability.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>CRAFTED FOR EXCELLENCE IN COLUMBUS, OH</p>\r\n\r\n<p>As with all Rogue Bella Bars, the black zinc variant undergoes meticulous machining and assembly in Columbus, Ohio. It features a 190,000 PSI tensile strength steel shaft providing the ideal amount of whip, dual knurl marks without a center knurl, and bright zinc sleeves. The hybrid knurling pattern ensures a secure yet comfortable grip, while premium bronze bushings contribute to the ideal balance for both power and Oly lifts.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ENHANCED FEATURES</p>\r\n\r\n<p><strong>Best In Class Durability</strong>: &nbsp;Engineered to withstand the increased demands that functional movements and Olympic lifts place on barbells today through overhead drops. &nbsp;Read more&nbsp;<a href=\"https://www.roguefitness.com/theindex/article/f-scale-overview\">here</a>.</p>\r\n\r\n<p><strong>2X Quieter Performance</strong>: Refined with even stricter tolerances, precision-machined bronze bushings fit tighter around the shaft, and improved internal sleeve tolerances dampen sound and eliminate unwanted movement, ensuring a smoother and more stable lift.</p>\r\n', 16000.00, 5, '10', '5', 1),
(8, 'Rogue 45LB Ohio Power Bar - Stainless / Black', '6795f3ddf3b1d0.43009220.jpeg', '<p>MEN&#39;S 45LB POWERLIFTING BARBELL</p>\r\n\r\n<p>Crafted to stand out as the ultimate powerlifting barbell, the Ohio Power Bar shines in the squat, bench press, and deadlift. The 29MM shaft provides minimal flex for maximum stability under heavy loads and is paired with a deep knurl designed for a sticky grip. Left uncoated, the knurl will feel just as it was intended, while the stainless shaft maintains the highest level of oxidation resistance. From the home gym to the commercial facility, the Ohio Power Bar is your go-to for the big three lifts or any accessory requiring a barbell.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>PRECISION MEETS POWER</strong></p>\r\n\r\n<p>Every Ohio Power Bar is precisely machined and assembled in Columbus, OH using US steel that is proven ideal for heavy powerlifting. We combine a 200,000 PSI tensile strength, low flexion shaft, IPF powerlifting knurl marks and our signature Ohio Power Bar knurling. The knurling is machined in a pattern that is deep and coarse, providing an ideal surface for heavy pulls without being sharp or abrasive. Additionally, it features a matching center knurl that adheres to your back when you need it most.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ENHANCED FEATURES</p>\r\n\r\n<p><strong>Best In Class Durability</strong>: Rogue manufactures the world&#39;s most durable barbells, and the Ohio Power Bar is no exception. This bar has been engineered to withstand the heavy demands required from the home gym to the commercial facility. Read more&nbsp;<a href=\"https://www.roguefitness.com/theindex/article/f-scale-overview\">here</a>.</p>\r\n\r\n<p><strong>2X Quieter Performance:</strong>&nbsp;Refined with even stricter tolerances, precision-machined bronze bushings fit tighter around the shaft, and improved internal sleeve tolerances dampen sound and eliminate unwanted movement, ensuring a smoother and more stable lift.</p>\r\n\r\n<p><strong>Low Profile Sleeve Design:&nbsp;</strong>The sleeves are now machined using a new low-profile sleeve design that allows for easier than ever loading and unloading of plates.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 5400.00, 5, '19', '', 1),
(9, 'RML-490C Power Rack 3.0', '6795f449c79306.22722864.jpeg', '<h2>&nbsp;RML-490C POWER RACK 3.0</h2>\r\n\r\n<p>Originally developed to combine the 3x3&rdquo; 11-gauge steel construction of the&nbsp;<a href=\"https://www.roguefitness.com/rogue-rm-4-bolt-together-monster-rack-2-0\">RM-4 Monster Rack</a>&nbsp;with the 5/8&rdquo; hardware of the&nbsp;<a href=\"https://www.roguefitness.com/rogue-r-4-power-rack\">Infinity R-4</a>, our latest versatile RML-490C Monster Lite Rack now also includes: a wide range of custom color finish options, a new stabilizing back-nameplate,&nbsp;<a href=\"https://www.roguefitness.com/rogue-monster-lite-slinger\">Slinger</a>-compatible crossmembers, and your choice of either numbered or unnumbered uprights.</p>\r\n\r\n<p>As with all past models, Version 3.0 of the RML-490C Rack is manufactured in Columbus, Ohio, and features 90&rdquo; tall uprights with laser-cut holes in the Westside pattern (1&rdquo; through bench and clean pull zone, 2&rdquo; spacing above and below). A full line-up of accessories also come standard with the 43&rdquo; depth unit, including a set of Monster Lite J-Cups, Pin/Pipe Safeties, Band Pegs, and a 43&rdquo; Single Pull-Up Bar. An optional stabilizer (in a matte black powdercoat finish) can be added to an order via the dropdown menu.</p>\r\n', 32000.00, 6, '10', '4', 1),
(10, 'Treadmil', '679655a6c7abe5.90775948.webp', '<p>,mnsjkdnsjcks</p>\r\n', 65210.00, 3, '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `image`, `status`) VALUES
(3, 'Treadmil', '51H-UdRV2cL._AC_SR230,210_QL64_.jpg', 1),
(4, 'Elliptical machine', '41hPMIYqjsL._AC_SR250,250_QL65_.jpg', 1),
(5, 'Barbells', 'RA0586-TH_hjxjsm.jpeg', 1),
(6, 'Rigs & Racks', 'Functional-Trainer-Red_zcupyf.jpeg', 1),
(15, 'Hand Gripper', '6794ade157fa56.99422929.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `charge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `name`, `charge`) VALUES
(1, 'Fitness', '55'),
(2, 'Sauna', '35'),
(3, 'Cardio', '40');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `name`, `message`, `status`, `date`, `user_id`) VALUES
(12, 'staff', 'asd', 'unread', '2020-04-16 22:39:59', 0),
(13, 'staff', 'asdasdas', 'unread', '2020-04-16 22:40:49', 0),
(14, 'staff', 'ASasA', 'unread', '2020-04-16 22:41:59', 0),
(15, 'staff', 'asdasdasd', 'unread', '2020-04-16 22:42:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`user_id`, `username`, `password`, `email`, `fullname`, `address`, `designation`, `gender`, `contact`) VALUES
(1, 'bruno', 'cac29d7a34687eb14b37068ee4708e7b', 'brunoden@mail.com', 'Bruno Den', '26 Morris Street', 'Cashier', 'Male', 852028120),
(2, 'michelle', 'cac29d7a34687eb14b37068ee4708e7b', 'michelle@mail.com', 'Michelle R. Lane', '61 Stone Lane', 'Trainer', 'Female', 2147483647),
(3, 'james', 'cac29d7a34687eb14b37068ee4708e7b', 'jamesb@mail.com', 'James Brown', '12 Deer Ridge Drive', 'Trainer', 'Male', 2147483647),
(4, 'bruce', 'cac29d7a34687eb14b37068ee4708e7b', 'bruce@mail.com', 'Bruce H. Klaus', '68 Lake Floyd Circle', 'Manager', 'Male', 1458887788),
(5, 'ava123', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'ava@gmail.com', 'ava joy', 'surat', 'Cashier', 'Male', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `task_status` varchar(50) NOT NULL,
  `task_desc` varchar(30) NOT NULL,
  `user_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `task_status`, `task_desc`, `user_id`) VALUES
(20, 'In Progress', 'Test Completed', 14),
(21, 'Pending', 'Mastering Crunches', 6),
(22, 'In Progress', 'Standing Workouts For Flat Abs', 6),
(23, 'In Progress', 'Triceps Buildup - 3 set', 14),
(24, 'Pending', 'Decline dumbbell bench press', 6),
(27, 'Pending', 'dddd', 0),
(28, 'In Progress', 'Test 1', 23),
(30, 'In Progress', 'jnfjsj', 32),
(32, 'Pending', 'jnfjsj', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `current_plan` varchar(50) NOT NULL,
  `trainer_name` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `join_date` date DEFAULT curdate(),
  `code` text NOT NULL,
  `code_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `createtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `name`, `email`, `mobile`, `password`, `gender`, `address`, `image`, `current_plan`, `trainer_name`, `batch`, `payment_status`, `join_date`, `code`, `code_status`, `createtime`) VALUES
(1, '', 'avadh', 'temopo7514@wirelay.com', '', '7ef605fc8dba5425d6965fbd4c8fbe1f', '', '', '', '', '', '', '', '2025-01-19', '9371a4967fbe6218eb5118e6798a01b1', 0, '2025-01-09 06:24:12'),
(9, '', 'cagov', 'cagov93237@sfxeur.com', '', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '2025-01-19', '6aafd8028cb5a78eb031b77fbe985639', 1, '2025-01-09 12:37:25'),
(17, '', 'hita', 'peyogog417@suggets.com', '', 'ffaefbcd0a902d22db7e03cf5b51c275', '', '', '', '', '', '', '', '2025-01-19', '9a5506d16a4397b5318c476ea89b1570', 1, '2025-01-16 09:37:16'),
(21, 'Josy kalu', 'kalu', 'mofivo9318@halbov.com', '9856321470', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'male', '263 sivay society, puna', '', '', '', '', '', '2025-01-19', '', 1, '2025-01-19 09:20:44'),
(22, '', 'Keval', 'direya4166@halbov.com', '', '9445676904c4c57181bf262426988083', '', '', '', '', '', '', '', '2025-01-20', '058b1b59139ab772c42f24325a443aed', 1, '2025-01-20 17:01:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_blogs`
--
ALTER TABLE `gym_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_images`
--
ALTER TABLE `gym_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_plans`
--
ALTER TABLE `member_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gym_blogs`
--
ALTER TABLE `gym_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gym_images`
--
ALTER TABLE `gym_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_plans`
--
ALTER TABLE `member_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member_plans`
--
ALTER TABLE `member_plans`
  ADD CONSTRAINT `member_plans_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`user_id`),
  ADD CONSTRAINT `member_plans_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
