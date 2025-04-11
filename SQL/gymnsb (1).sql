-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 05:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(9, 'Nihal', 'ukaninihal@gmail.com', 'Male', '4a48db6397a59b7aa1ed297337a5aea4', '9723538158', 'Manadev Chowk', 'surat', 'Gujarat', ''),
(10, 'Avadh', 'avadhradadiya43@gmail.com', 'Male', '7ef605fc8dba5425d6965fbd4c8fbe1f', '9737261547', 'Punagam', 'Surat', 'Gujarat', '307421'),
(11, 'Ayush', 'ayushmangukiya007@gmail.com', 'Male', '691c720c3152c8686e0ff812a767c552', '9016478486', 'Rachhana society', 'surat', 'gujarat', ''),
(12, 'jenish', 'jenishpipala146@gmail.com', 'Male', '17c1eb805f782ec09e6ba5af68e29312', '9104798240', 'rachaana society', 'surat', 'gujarat', '');

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
(10, 'This is a demo announcement from admin', '2022-06-03'),
(11, 'hi everyone', '2025-01-20'),
(12, 'hi every one this your Admin i would like to inform about fitness club is going to celebrate the hol', '2025-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `Age` int(50) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `fitness_level` varchar(100) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(100) NOT NULL,
  `status` enum('scheduled','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `trainer_id`, `appointment_date`, `appointment_time`, `fullname`, `email`, `contact`, `Age`, `service_type`, `amount`, `description`, `fitness_level`, `payment_id`, `payment_status`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(49, 46, 4, '2025-04-23', '11:00:00', 'avadh radadiya', 'avadhradadiya43@gmail.com', '9856321047', 21, 'workout', '800', 'qwertyuiolkjhgfdsazxcvbnm', 'intermediate', 49, 1, 'credit_card', 'completed', '2025-03-30 10:50:50', '2025-03-30 10:55:24'),
(50, 47, 1, '2025-04-04', '06:00:00', 'ava joy', 'xereyib470@macho3.com', '0085647123', 21, 'Yoga', '400', 'poiuytrewahjk,mnbvc', 'advanced', 0, 0, 'pay_at_gym', 'scheduled', '2025-03-31 06:51:18', '2025-03-31 06:51:18');

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
(9, 'white paguses', 'whitehack880@gmail.coom', '884866151398', ' mcs djasdhabdhdbawhdbawhjdbwhjdfbhj', '', '2025-01-22 10:00:41', 1),
(10, 'ava joy', 'wotor30234@arensus.com', '09085647123', ' msmdmdscs', '', '2025-03-06 12:20:48', 1),
(11, 'ava joy', 'yitejay730@doishy.com', '09085647123', 'kjhgfewqhhdsshcyhdsc', '', '2025-03-17 03:58:13', 1);

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
(1, 'Essential Tips for food Beginners at the Gym', '                                    Starting your fitness journey at the gym can feel overwhelming, but with the right approach, you can set yourself up for success. Here are 10 essential tips for beginners:\r\n1. Set Clear Goals\r\nBefore stepping into the gym, decide what you want to achieve: weight loss, muscle building, or improved endurance. Clear goals will keep you motivated and help tailor your workouts.\r\n\r\n2. Start Slow and Build Gradually\r\nDon’t rush into heavy lifting or intense workouts. Start with lighter weights and shorter sessions, focusing on proper form to prevent injuries.\r\n\r\n3. Warm Up Properly\r\nAlways warm up before exercising to prepare your muscles and joints. Simple activities like jogging or dynamic stretches for 5–10 minutes can reduce the risk of injuries.\r\n                                        ', 'uploads/blogs/1.jpg', '2025-01-18 09:18:45'),
(2, 'Post-Workout Meals to Boost Recovery', '                                    Refueling your body after a workout is essential for muscle recovery, replenishing energy stores, and promoting overall health. A good post-workout meal should include a balance of protein, carbohydrates, and healthy fats. Here are some great options:\r\n1. Grilled Chicken with Sweet Potato\r\nWhy it’s great: Packed with lean protein for muscle repair and complex carbs to restore glycogen levels.\r\nTip: Add steamed veggies like broccoli or spinach for extra nutrients.\r\n2. Greek Yogurt and Fresh Fruit\r\nWhy it’s great: Greek yogurt provides high-quality protein, while fruits like berries or bananas offer quick-digesting carbs.\r\nTip: Sprinkle some chia seeds or granola for added fiber and omega-3s.\r\n                                        ', 'uploads/blogs/3.jpg', '2025-01-18 09:39:45'),
(5, 'The Importance of Physical Therapy Internships for Career Growth', '                                    <p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">If you’re studying to become a physical therapist, you already know how rewarding this career can be. You get to help people move, feel, and live better. But here’s the thing—theoretical knowledge alone won’t get you where you want to be. To truly grow in the physical therapy field, you need hands-on experience. &nbsp;</p><p data-slot-rendered-content=\"true\" style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Physical therapy internships allow you to apply what you’ve learned in real-world settings, work with actual patients, and learn from seasoned professionals. Whether you’re just starting or looking to specialize, internships can be a game-changer for your physical therapy career.&nbsp;&nbsp;</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Real-world applications can turn classroom knowledge into valuable clinical skills. While textbooks and lectures teach you the basics, nothing prepares you better than working with real patients.&nbsp;<a href=\"https://medicalaid.org/internships/physical-therapy/\" target=\"_blank\" rel=\"noopener\" data-lasso-id=\"6609\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">Physical therapy internships</a>&nbsp;allow you to apply what you’ve learned while experienced professionals guide you through the process.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">During this time, you get to assess patients, develop treatment plans, and adjust techniques as needed. Practicing stretches, exercises, and mobility treatments can also build your confidence, sharpen your physical therapy skills, and prepare you for the demands of the job.</p>\r\n                                        ', 'uploads/blogs/6052386-G16-2.jpg', '2025-03-04 10:58:36'),
(6, 'IO Need To Knows For Your First Spin Class', '                                    <p data-slot-rendered-content=\"true\" style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">It’s literally been over a decade since I qualified as an indoor cycling instructor, 10 years since I originally wrote this blog post and around 7 years since I took part in spin classes aka indoor cycling classes regularly.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">I’m not sure what prompted me to follow through with leading indoor cycling classes, but it’s been on my radar and my vision board for a couple of years now. So I recently took the opportunity to re-qualify, get some teaching experience under my belt, and get on the podium!</p><div><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">I’d once come across someone asking if indoor cycling classes would benefit them when cycling outdoors. To be honest, this is a valid question and some years ago, I honestly thought there was no value in indoor cycling for “actual” (lol) cyclists.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Back in 2014, when I got a bike for&nbsp;<a href=\"https://www.keepitsimpelle.com/improving-fitness-to-cycle-to-work/\" data-lasso-id=\"5855\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">commuting to work</a>, I was sure there was no point to me riding a bike indoors and taking part in spin classes. Why would I cycle to a studio, cycle on a stationary bike, and then cycle home?!</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Then&nbsp; decided to&nbsp;<a href=\"https://www.keepitsimpelle.com/the-london-duathlon-2014-mymoments/\" data-lasso-id=\"5856\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">take on a duathlon</a>&nbsp;and realised that my casual cycle commute was not gonna be enough to get me race ready. In that situation, it then made sense for me to add a spin class or two to my workout schedule in addition to cycle commuting.</p></div><div><br></div>\r\n                                        ', 'uploads/blogs/Launch-Event-48-1MB-1440x960.jpg', '2025-03-04 11:03:42'),
(8, 'Perfect Form: How to Do a Kettlebell Press & Progressions', '<p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">I find something oddly satisfying about pressing weight overhead. It’s not just about strength; it’s about control, precision, and the confidence of moving a load into a position of power. But here’s the thing: not all presses are created equal.</p><p data-slot-rendered-content=\"true\" style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">While barbells and dumbbells dominate gym floors, the kettlebell brings a whole different challenge to the game. Whether you’ve dabbled in kettlebell training or are just curious about what makes these oddly shaped weights so special, I’m going to show you how kettlebell presses can revolutionize your shoulder sessions.</p><h3 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 36px; padding-top: 40px; background-color: rgb(255, 255, 255);\">Different Angle from Dumbbells and Barbell Press</h3><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">With the weight’s centre of mass sitting below the handle, the kb creates a natural arc during pressing. This changes the mechanics of the lift, engaging muscles differently to barbells and dumbbells. The off-centre load also challenges your grip and wrist strength.</p><h3 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 36px; padding-top: 40px; background-color: rgb(255, 255, 255);\">Multiple Variations</h3><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Kettlebell presses come in many forms, such as the strict press, push press, bottoms-up press, and even the&nbsp;<a href=\"https://www.keepitsimpelle.com/i-like-to-move-it-kettlebell-swing/\" data-lasso-id=\"6444\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">kettlebell Swing</a>. Each variation targets slightly different muscle groups and requires varied levels of coordination and power.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">For example, the bottoms-up press demands extreme focus on grip and wrist stability, while the push press allows for greater load by incorporating the legs.</p><h3 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 36px; padding-top: 40px; background-color: rgb(255, 255, 255);\">Body Alignment</h3><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Pressing a kb naturally encourages better body alignment. The design of the kettlebell requires you to maintain a strong, stacked position, where the wrist, elbow, shoulder, and torso align properly.</p>\r\n                                        ', 'uploads/blogs/how-to-d-a-kettlebell-press.jpg', '2025-03-04 11:55:40'),
(9, 'Gymboss HIIT Interval Timer Review', '                                    <p class=\"disclouser\" style=\"box-sizing: border-box; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; letter-spacing: 0.5px; background-color: rgb(255, 255, 255); margin-bottom: 35px !important; padding-left: 15px !important; font-size: 14px !important; line-height: 22px !important; border-left: 6px solid rgb(232, 236, 239) !important;\"><span style=\"font-size: 18px;\">I’ve used this Gymboss HIIT interval timer for 10 years now &amp; changed the batteries just once. It’s actually wild!</span></p><div class=\"entry-content\" data-content-ads-inserted=\"true\" style=\"box-sizing: border-box; counter-reset: footnotes 0; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">Years and years… and years ago on the blog, I posted a review and hosted a give-away for a&nbsp;<a href=\"https://www.amazon.co.uk/Gymboss-Interval-Timer-Stopwatch-Coating/dp/B00CO8HO6O/ref=as_li_ss_tl?tag=keepitsimpe-21&amp;s=gateway&amp;linkCode=sl1&amp;linkId=ab3cb0cda30b13531c3af187beb5411f\" target=\"_blank\" rel=\"nofollow sponsored noopener\" data-lasso-id=\"5690\" data-lasso-name=\"Gymboss Interval Timer and Stopwatch Soft Coating Black/Blue\" data-lasso-link=\"https://go.lasso.link/amazon?url=https%3A%2F%2Fwww.amazon.co.uk%2FGymboss-Interval-Timer-Stopwatch-Coating%2Fdp%2FB00CO8HO6O%2Fref%3Das_li_ss_tl%3Ftag%3Dkeepitsimpe-21%26s%3Dgateway%26linkCode%3Dsl1%26linkId%3Dab3cb0cda30b13531c3af187beb5411f\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">Gymboss Interval Timer &amp; Stopwatch</a>. My memory fails me, but I’m pretty sure I was sent the product and back then, this would have been epic!</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">I had never heard of Gymboss Timers before but, [now] 10 years after writing my original post, I’m still using&nbsp;<span style=\"box-sizing: border-box; font-weight: 800;\">the exact</span>&nbsp;same timer as I did then… and I’ve only had to change the batteries for this HIIT interval timer once!</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\"><em style=\"box-sizing: border-box;\">It started like this…</em></p><div style=\"box-sizing: border-box; padding: 1em; max-width: 45em; margin: 1em 0px; border: 1px solid rgb(205, 80, 124);\"><span style=\"box-sizing: border-box; font-weight: 800;\">*My stopwatch broke<br style=\"box-sizing: border-box;\">*I learnt to time drills without a stopwatch<br style=\"box-sizing: border-box;\">*My timing became akin to Transport for London (how long can 1 min really be?!)</span></div><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">I quickly became renowned for unspecific timing especially when distracted with conversation while teaching. But then, I started running my sessions literally like a BOSS! …although it seem’s more like all the peeps in my sessions were running them as they could see the time on my waistband.</p><h2 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 42px; padding-top: 40px;\">What Is A Gymboss Timer?</h2><p data-slot-rendered-content=\"true\" style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">Gymboss&nbsp;Timers are programmable interval timers perfect for timing a single interval, or multiple intervals, and repeating them once or as many times as you wish. The interval timer mode allows timing of any one interval, or two different intervals insequence. These intervals can then be repeated once, or as many times as you select, up to 99 times.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">So the timing couldn’t have been more perfect… pun intended! A HIIT interval timer that you can set the intervals in advance, with various notification alarms (vibrate, beep) that I could choose. Or even choose to have it as non audible? I was onto a winner and didn’t even know it at the time.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">I’m pretty sure I have a second one still in its packaging somewhere which I was gonna use to take photos for this post but I couldn’t find it. So I used my battered (but still beautiful) orange version.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px;\">It’s missing the clip on the back, but gah, we can’t see that in a picture. It probably would be handy to have though ‘cos the amount of times I roam around class, put down my Gymboss, and then can’t remember where I left it… are countless</p></div>\r\n                                        ', 'uploads/blogs/191119-annarachelphotography-lowres-72709-1440x962.jpg', '2025-03-04 12:01:11'),
(10, 'Home Gym Storage Ideas For Small Spaces', '<p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">It’s been a few years now since I started delivering online fitness from the living room of my one bedroom flat. As time has gone on, I’ve had to come up with good home gym storage ideas as the amount of equipment I own has increased!</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Let’s be honest, one of the biggest challenges of working out at home, especially when you live in a smaller place, is finding a way to store all of your equipment (<a href=\"https://www.keepitsimpelle.com/bike-storage-for-small-spaces/\" data-lasso-id=\"5343\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">and also bikes for me</a>). I’m personally trying not to let all my weights and other gear take up all the valuable space in my living room.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">If you’re struggling to find a way to store your home gym equipment, don’t worry. There are a number of creative and affordable storage solutions available. Here are a few ideas to get you started:</p><h2 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 42px; padding-top: 40px; background-color: rgb(255, 255, 255);\">1. Use Your Wall Space</h2><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">One of the best ways to save space in a small home gym is to use wall space for storage. You can hang dumbbells, kettlebells, and other heavy equipment on hooks or racks, providing your walls are strong enough.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">You can also use wall-mounted&nbsp;<a href=\"https://www.bigdug.co.uk/shelving-c4505\" target=\"_blank\" rel=\"sponsored\" data-lasso-id=\"5344\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">shelving</a>*&nbsp;to store smaller items like resistance bands, yoga mats, and water bottles.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">This doesn’t have to be a wall in one of your main spaces either… if you’ve got a storage cupboard in your home, you can increase the capacity by using the wall space in there. I’ve got shelves up in my storage cupboard.</p><h2 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 42px; padding-top: 40px; background-color: rgb(255, 255, 255);\">2. Invest In A Storage Cabinet</h2><p data-slot-rendered-content=\"true\" style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">A storage cabinet is a great way to keep your home gym equipment organised and out of sight. If like you, you have a pretty sizeable hallway, that’s a great place to put it so it can also store things like shoes and umbrellas.There are loads of different types of storage cabinets available, like freestanding cabinets and or even cabinets that can be mounted under a desk or table. I’m a huge fan of the old school ‘locker’ style cabinets… in a bright colour to add some character.</p><h2 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 42px; padding-top: 40px; background-color: rgb(255, 255, 255);\">3. Use A Bench, Baskets Or Bins</h2><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Baskets and bins are a great way to store smaller items, such as resistance bands, foam rollers, and water bottles. You can either store baskets and bins on shelves or on the floor.</p><h2 class=\"wp-block-heading\" style=\"box-sizing: border-box; font-family: Italiana, Didot, serif; font-weight: normal; line-height: 1.3; margin-top: 0px; margin-bottom: 24px; color: rgb(69, 75, 89); letter-spacing: 0px; font-size: 42px; padding-top: 40px; background-color: rgb(255, 255, 255);\">4. Get Creative With Storage</h2><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\">Getting one of those beds that lifts up and turns into a full rack might be out of budget, but there can be more affordable storage solutions if you get creative.</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\"><a href=\"https://www.pinterest.co.uk/\" target=\"_blank\" rel=\"noopener\" data-lasso-id=\"5345\" style=\"box-sizing: border-box; background: transparent; transition: 0.2s ease-in-out; cursor: pointer; color: rgb(242, 148, 116);\">Pinterest</a>&nbsp;is always a good place to start when looking for creative ideas, right?!</p><p style=\"box-sizing: border-box; margin-bottom: 22px; padding: 0px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\"><em style=\"box-sizing: border-box;\">Here’s some of the ideas I’ve used:</em></p><ul class=\"wp-block-list\" style=\"box-sizing: border-box; margin-bottom: 30px; margin-left: 40px; color: rgb(17, 17, 17); font-family: &quot;Open Sans&quot;; font-size: 18px; letter-spacing: 0.5px; background-color: rgb(255, 255, 255);\"><li style=\"box-sizing: border-box; list-style-type: disc;\">fitness equipment stored under my TV stand</li><li style=\"box-sizing: border-box; list-style-type: disc;\">my bar fits nicely behind the living room door</li><li style=\"box-sizing: border-box; list-style-type: disc;\">dumbbells under a coffee table</li><li style=\"box-sizing: border-box; list-style-type: disc;\">walkpad next to a wall in the hallway</li><li></li></ul>\r\n                                        ', 'uploads/blogs/Home-Gym-Storage-Ideas-600x600.png', '2025-03-04 12:06:33'),
(11, 'Calories and Weight Loss - What You Need To Know', '<div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">If you\'re looking to lose weight, the huge number of diet plans and nutritional guidance available can seem overwhelming, with many competing ideas and eating styles on offer. However, a good starting point for any weight control plan is to gain an understanding of calories, and what they mean for your body.&nbsp;</p><p style=\"box-sizing: border-box;\">In this guide, we explain what calories are and how many you should be eating if your goal is to lose weight. Read on for more</p></div><h2 class=\"heading__Heading-sc-5w1f6q-0 headingBlock__StyledHeading-sc-qxn2b7-0 etSuB KnaxQ\" style=\"box-sizing: border-box; margin-block-end: 18px; font-family: URWDINCondensed, URWDINCondensedLocalFallback, sans-serif; line-height: 1.125; color: rgb(0, 128, 131); text-transform: uppercase; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);\">Is An Understanding of Calories Essential For Weight Loss?</h2><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">Here at PureGym we’re keen to support you in your health and fitness journey. If your goal is working towards losing weight, we believe it’s best to approach this a gradual and sustainable way, combining healthy diet changes and exercise to keep your body in tip top shape. While very low calorie ‘crash’ diets may seem appealing if you’re hoping to achieve your goal quickly, it’s almost always more effective in the long term to work on healthy lifestyle changes that will have positive, sustainable benefits to your physical and mental wellbeing. This means gradual changes to your calorie consumption and making healthy, micronutrient-rich food choices rather than extreme changes that could have a negative impact on your health.&nbsp;</p><p style=\"box-sizing: border-box;\">While a calorie-tracking approach to nutrition can help build an understanding of which types of food may be best for achieving healthy weight loss goals, it may not suit everyone. If you’re overly concerned about your weight, speak to your doctor, a dietician or a nutritionist who may be able to work up a meal plan that suits your body type.</p></div><h2 class=\"heading__Heading-sc-5w1f6q-0 headingBlock__StyledHeading-sc-qxn2b7-0 etSuB KnaxQ\" style=\"box-sizing: border-box; margin-block-end: 18px; font-family: URWDINCondensed, URWDINCondensedLocalFallback, sans-serif; line-height: 1.125; color: rgb(0, 128, 131); text-transform: uppercase; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);\">What Are Calories?</h2><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Calories are a&nbsp; measure of the energy that food and drink provide to our bodies, and are vital fuel that we need to function, from our brain to our biceps. Food is made up of macronutrients known as protein, carbohydrates and fats - which all play a different role within your body. They all have different energy values which influence how many calories of energy we get when we consume them.</p></div><h2 class=\"heading__Heading-sc-5w1f6q-0 headingBlock__StyledHeading-sc-qxn2b7-0 etSuB KnaxQ\" style=\"box-sizing: border-box; margin-block-end: 18px; font-family: URWDINCondensed, URWDINCondensedLocalFallback, sans-serif; line-height: 1.125; color: rgb(0, 128, 131); text-transform: uppercase; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);\">How Do Calories Affect Weight Loss?</h2><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">If we regularly consume more calories than we burn, our body will store those additional calories as fat. A repeated excess of around 500+ calories over your daily burn number is likely to lead to gradual weight gain. Likewise, cutting your calories to around 500 calories below your daily burn amount is likely to lead to a healthy and steady amount of weight loss. However do bear in mind, these numbers are a guideline figure only and will differ depending on your current build, health and genetic make up.&nbsp;</p><p style=\"box-sizing: border-box;\">The first step in determining how many calories you may want to aim towards for weight loss is understanding your BMR and TDEE - read on to find out more</p></div>\r\n                                        ', 'uploads/blogs/salmon.jpg', '2025-03-04 12:11:20'),
(12, 'The Best Gym Workout Plan For Gaining Muscle', '<div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\"><em style=\"box-sizing: border-box;\">Spencer Cartwright</em>&nbsp;is&nbsp;<em style=\"box-sizing: border-box;\">a personal trainer at</em>&nbsp;<a href=\"https://www.puregym.com/gyms/bristol-brislington/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\"><em style=\"box-sizing: border-box;\">PureGym Bristol Brislington</em></a><em style=\"box-sizing: border-box;\">. Here, he shares his top advice for creating the perfect muscle-gaining workout routine.</em></p><p style=\"box-sizing: border-box;\">So, you want to build those muscles? That\'s great! Building muscle requires a person to commit to regular strength training for a long period of time, with no shortcuts unfortunately. However, you can make this process more efficient with the right nutrition and workouts. If you want to avoid wasting hours in the gym, keep reading.</p><p style=\"box-sizing: border-box;\">While most people want to build muscle for aesthetic reasons, there are so many health benefits too, including:</p></div><ul class=\"list__List-sc-ysyucw-0 listBlock__StyledList-sc-11jmbq6-0 diksWn\" style=\"box-sizing: border-box; width: 957.724px; margin-bottom: 0px; margin-left: 0px; padding-inline-start: 1.5em; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><li class=\"list__ListItem-sc-ysyucw-1 listBlock__StyledListItem-sc-11jmbq6-1 dDalJC\" style=\"box-sizing: border-box; padding: 0px;\"><div class=\"listBlock__ListItemWrapper-sc-11jmbq6-2 lmMRqM\" style=\"box-sizing: border-box; position: relative; display: flex; flex-wrap: wrap; -webkit-box-align: center; align-items: center;\"><div class=\"listBlock__SubTextWrapper-sc-11jmbq6-3 wVJXN\" style=\"box-sizing: border-box; display: flex; flex-basis: 100%; -webkit-box-align: center; align-items: center;\"><div style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Increasing lean muscle mass, which means you’ll burn more calories at rest</p></div></div></div></li><li class=\"list__ListItem-sc-ysyucw-1 listBlock__StyledListItem-sc-11jmbq6-1 dDalJC\" style=\"box-sizing: border-box; padding: 0px;\"><div class=\"listBlock__ListItemWrapper-sc-11jmbq6-2 lmMRqM\" style=\"box-sizing: border-box; position: relative; display: flex; flex-wrap: wrap; -webkit-box-align: center; align-items: center;\"><div class=\"listBlock__SubTextWrapper-sc-11jmbq6-3 wVJXN\" style=\"box-sizing: border-box; display: flex; flex-basis: 100%; -webkit-box-align: center; align-items: center;\"><div style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Addressing strength imbalances which can improve postural issues</p></div></div></div></li><li class=\"list__ListItem-sc-ysyucw-1 listBlock__StyledListItem-sc-11jmbq6-1 dDalJC\" style=\"box-sizing: border-box; padding: 0px;\"><div class=\"listBlock__ListItemWrapper-sc-11jmbq6-2 lmMRqM\" style=\"box-sizing: border-box; position: relative; display: flex; flex-wrap: wrap; -webkit-box-align: center; align-items: center;\"><div class=\"listBlock__SubTextWrapper-sc-11jmbq6-3 wVJXN\" style=\"box-sizing: border-box; display: flex; flex-basis: 100%; -webkit-box-align: center; align-items: center;\"><div style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Improve overall strength, coordination, and balance</p></div></div></div></li><li class=\"list__ListItem-sc-ysyucw-1 listBlock__StyledListItem-sc-11jmbq6-1 dDalJC\" style=\"box-sizing: border-box; padding: 0px;\"><div class=\"listBlock__ListItemWrapper-sc-11jmbq6-2 lmMRqM\" style=\"box-sizing: border-box; position: relative; display: flex; flex-wrap: wrap; -webkit-box-align: center; align-items: center;\"><div class=\"listBlock__SubTextWrapper-sc-11jmbq6-3 wVJXN\" style=\"box-sizing: border-box; display: flex; flex-basis: 100%; -webkit-box-align: center; align-items: center;\"><div style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Improve bone density and slow down bone loss</p></div></div></div></li></ul><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">You can learn more about&nbsp;<a href=\"https://www.puregym.com/blog/what-are-strength-training-exercises-and-why-do-them/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">the benefits of strength training here</a>.</p><p style=\"box-sizing: border-box;\">Gaining muscle, known as muscular hypertrophy, requires some serious strength training. Strength training causes microscopic tears in the muscle fibres, which sounds scary but is actually a prerequisite of growth. As the body repairs these tissues, they get bigger, and when this is repeated again and again this results in visibly bigger muscles.</p><p style=\"box-sizing: border-box;\">While all strength training will help to increase strength, there are certain ways to train that will maximise muscular hypertrophy. Read on to learn how to shape a strengthening workout plan that will help you to gain muscle, as well as some of the different approaches you could take. You can also click here to jump straight to the example workout plan for gaining muscle.</p></div><div id=\"how-often\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><h4 style=\"box-sizing: border-box;\"><span style=\"font-weight: bolder; box-sizing: border-box;\">How often and how much should you work out to gain muscle?</span></h4><p style=\"box-sizing: border-box;\">There are a few factors to consider when designing a workout plan aimed at building muscle: frequency, volume, weight, and progressive overload.</p><p style=\"box-sizing: border-box;\"><em style=\"box-sizing: border-box;\"><span style=\"font-weight: bolder; box-sizing: border-box;\">Frequency of workouts</span></em></p><p style=\"box-sizing: border-box;\">Most scientific studies on the matter conclude that a muscle needs to be worked at least&nbsp;<span style=\"font-weight: bolder; box-sizing: border-box;\">two or three times a week</span>&nbsp;in order to see it change and grow. This means you should aim to gym at least two times a week, up to a maximum of six times. It may be tempting to gym every day, but&nbsp;<a href=\"https://www.puregym.com/blog/why-rest-days-are-important/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">rest days</a>&nbsp;are actually crucial when it comes to build muscle.</p><p style=\"box-sizing: border-box;\"><em style=\"box-sizing: border-box;\"><span style=\"font-weight: bolder; box-sizing: border-box;\">Volume</span></em></p><p style=\"box-sizing: border-box;\">The ideal workout volume (the number of reps and sets you do) changes depending on whether your goal is strength, endurance, or hypertrophy. For muscular&nbsp;<a href=\"https://www.puregym.com/blog/hypertrophy-vs-strength/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">hypertrophy</a>, 3-4 sets of 8-12 reps per exercise is considered the best approach.&nbsp;</p><p style=\"box-sizing: border-box;\"><em style=\"box-sizing: border-box;\"><span style=\"font-weight: bolder; box-sizing: border-box;\">Weight</span></em></p><p style=\"box-sizing: border-box;\">Your workouts need to challenge the muscles enough to create change, which means choosing weights that are heavy enough that the last couple of repetitions are challenging but not impossible, but you would be unable to complete another rep with good form (or at all).</p><p style=\"box-sizing: border-box;\"><em style=\"box-sizing: border-box;\"><span style=\"font-weight: bolder; box-sizing: border-box;\">Progressive overload</span></em></p><p style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/progressive-overload/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">Progressive overload</a>&nbsp;is one of the most important principles of strength training. Our bodies are great at adapting to stimulus, so if we repeatedly do the same number of reps and sets with the same weight, we will plateau. Progressive overload involves increasing the difficulty of an exercise over time, either by increasing the weight, reps, depth, or intensity (by slowing down the tempo, for example).</p><p style=\"box-sizing: border-box;\">For hypertrophy, what this might look like is doing 10kg for 3 sets of 8 reps one week, 10 reps, the week after, and 12 reps the week after, and then increasing to a weight you can only manage for 8 reps and repeating the process.</p><div><br></div></div><div id=\"free-weights-machines\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"></div>\r\n                                        ', 'uploads/blogs/gym-workout-plan-for-gaining-muscle_header.jpg', '2025-03-04 12:15:09'),
(13, 'One Hour Gym Workouts', '<div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">Sticking to short, high-intensity sessions may be tempting when time is tight. But if you have specific goals in mind, carving out an hour to exercise brings with it fitness benefits that micro workouts just can\'t replicate.</p><p style=\"box-sizing: border-box;\">Even if gyms are closed, or you\'d just rather work out at home, an hour gives you plenty of time for a well-rounded routine with a proper warm-up and cool down. You could do a&nbsp;<a href=\"https://www.puregym.com/exercises/full-body/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">full body workout</a>,&nbsp;<a href=\"https://www.puregym.com/exercises/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">target specific areas</a>&nbsp;or work on your&nbsp;<a href=\"https://www.puregym.com/blog/best-types-of-cardio/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">cardiovascular endurance</a>. Plus, having 60 minutes lets you build the intensity over the course of your workout session.</p><p style=\"box-sizing: border-box;\">Whether you\'re prepping for a triathlon or an obstacle race, regular one hour exercise sessions at the gym are an excellent step in the right direction. Longer sessions are perfect for honing specific techniques to get you over the finish line, letting you work on foot strike, breathing patterns, pedal rhythm or pull-ups, for example.</p></div><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box;\">But for maximum return on your time investment, having a solid workout plan in place is key. Pre-planning lets you move around the gym with purpose, without wasting precious time wondering what to do next.&nbsp;</p><p style=\"box-sizing: border-box;\">In this article we\'ll be covering:&nbsp;</p><ol style=\"box-sizing: border-box;\"><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-1\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">What are the benefits of a one hour workout?</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-2\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">How many calories can you burn in one hour at the gym?&nbsp;</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-3\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">How many one hour workouts should I do per week?</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-4\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">Is one hour at the gym enough to get fit?&nbsp;</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-5\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">Is a 60 minute workout better than a HIIT session for cardio?</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-6\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">Can I do an hour gym workout everyday?</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-7\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">What if I don\'t have time for a one hour workout?</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-8\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">1 hour full body workout plan</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-9\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">1 hour HIIT workout plan</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-10\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">1 hour cardio workout plan</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-11\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">1 hour strength workout plan</a></li><li style=\"box-sizing: border-box;\"><a href=\"https://www.puregym.com/blog/1-hour-gym-workouts/#anchor-12\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">1 hour kettlebell workout plan</a></li></ol></div><div style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><p style=\"box-sizing: border-box; margin-bottom: 0px;\">Our 1 hour workout ideas below make a great starting point. But to get the most out of every minute, download the&nbsp;<a href=\"https://www.puregym.com/app/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">PureGym app</a>. Totally free of charge even for non-members, the app lets you tailor your plan to both your goals and current level of fitness, from absolute beginners looking to build muscle, to athletes needing more variation.</p></div><div id=\"anchor-1\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); font-family: AbelPro, AbelProLocalFallback, system-ui, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\"><h3 style=\"box-sizing: border-box;\">What are the benefits of a one hour workout?</h3><p style=\"box-sizing: border-box;\">Whether squeezed into your lunch break or tacked onto your commute, one hour workouts can have huge benefits on your physical and&nbsp;<a href=\"https://www.puregym.com/blog/mental-health-the-gym/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">mental wellbeing</a>. Regular sessions that include both aerobic and resistance elements will put you well on your way to achieving (and even exceeding) the minimum amount of activity needed for good health.</p><p style=\"box-sizing: border-box;\"><a href=\"https://www.gov.uk/government/publications/physical-activity-guidelines-uk-chief-medical-officers-report\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">Official recommendations from Public Health England</a>&nbsp;state that adults should accumulate at least 150 minutes of moderate-intensity activity (like brisk walking or cycling) per week or 75 minutes of vigorous-intensity activity (such as running). In addition, the PHE suggests we do resistance training on two days per week, to develop and maintain strength in all the major muscle groups.</p><p style=\"box-sizing: border-box;\">According to the&nbsp;<a href=\"https://assets.publishing.service.gov.uk/government/uploads/system/uploads/attachment_data/file/832868/uk-chief-medical-officers-physical-activity-guidelines.pdf\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">government\'s own report</a>, achieving this amount of exercise is associated with&nbsp;<a href=\"https://www.puregym.com/blog/mental-health-the-gym/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">better mental health</a>&nbsp;and cardiovascular fitness, can contribute to a healthy weight status and can also have a protective effect on chronic conditions including coronary heart disease, obesity and type 2 diabetes.</p><p style=\"box-sizing: border-box;\">Sixty minute sessions also allow time for a short stretching routine, helping you work on the third (and often overlooked) pillar of health after muscular strength and cardiovascular fitness:&nbsp;<a href=\"https://www.puregym.com/blog/how-can-i-improve-my-flexibility/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">flexibility</a>. From sprinters to bodybuilders, joint mobility is vital to athletic performance as it reduces the risk of injury and soreness. But it\'s also important when it comes to maintaining posture and balance as we age, something that can&nbsp;<a href=\"https://sites.psu.edu/kinescfw/health-education/exercise-articles/the-importance-of-flexibility-and-mobility/#:~:text=Being%20flexible%20and%20having%20full,form%20being%20lower%20back%20pain.\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(0, 153, 157); transition: 330ms;\">significantly increase our quality of life</a></p></div>\r\n                                        ', 'uploads/blogs/kimberley_blog.jpg', '2025-03-04 12:16:09');

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
(17, 'uploads/1.jpg', '2025-01-28 18:05:42'),
(18, 'uploads/big_img_1.jpg', '2025-03-06 03:37:45'),
(19, 'uploads/4.jpg', '2025-03-06 03:38:02'),
(20, 'uploads/img_3.jpg', '2025-03-06 03:38:13'),
(21, 'uploads/pic-6.jpg', '2025-03-06 03:38:22'),
(22, 'uploads/image1.jpg', '2025-03-06 03:38:38'),
(23, 'uploads/gym11.jpg', '2025-03-06 03:38:51'),
(24, 'uploads/zumba.jpg', '2025-03-06 03:57:55'),
(25, 'uploads/dumbbell-940375_1280.jpg', '2025-03-06 04:00:23'),
(26, 'uploads/fitness-studio-3675225_1280.jpg', '2025-03-06 04:00:31'),
(27, 'uploads/zumba-4308761_1280.jpg', '2025-03-06 04:00:39'),
(28, 'uploads/zumba-4308708_1280.jpg', '2025-03-06 04:00:50'),
(29, 'uploads/treadmill-5030966_1280.jpg', '2025-03-06 04:00:58'),
(30, 'uploads/man-7847245_1280.jpg', '2025-03-06 04:01:05'),
(31, 'uploads/physiotherapy-595529_1280 (1).jpg', '2025-03-06 04:01:12');

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
(26, 'Mattie F. Maher', 'mattie', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '1995-05-18', 'Sauna', 420, '2022-06-01', 2022, '12', '73 Settlers Lane', '9995554444', 'Active', 0, 0, 0, '', '', '0000-00-00', 1),
(27, 'Justin C. Lusk', 'justin', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '1995-12-12', 'Cardio', 40, '2022-05-30', 2022, '1', '45 Bell Street', '3545785540', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(29, 'Kathy J. Glennon', 'kathy', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2022-06-02', 'Fitness', 330, '2022-06-02', 0, '6', '87 Harry Place', '7896587458', 'Active', 0, 0, 0, '', '', '0000-00-00', 1),
(30, 'avadh', '@avadh', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'Male', '2025-01-11', 'Fitness', 0, '0000-00-00', 0, '1', 'puga', '985632147', 'Pending', 0, 0, 0, '', '', '0000-00-00', 0),
(31, 'het', 'het123', '202cb962ac59075b964b07152d234b70', 'Male', '2025-01-11', 'Cardio', 0, '0000-00-00', 0, '1', 'punagam', '9852361470', 'Pending', 0, 0, 0, '', '', '0000-00-00', 0),
(32, 'ram', 'ram123', '6a557ed1005dddd940595b8fc6ed47b2', 'Male', '1991-02-05', 'Cardio', 40, '2025-01-11', 2025, '1', 'ayodhya', '6589742789', 'Active', 0, 0, 0, '', '', '0000-00-00', 1),
(33, 'avadh joshi ', 'ava123', '7ef605fc8dba5425d6965fbd4c8fbe1f', 'Male', '2025-01-16', 'Fitness', 55, '2025-01-16', 2025, '1', '123 shiv society ,su', '6589742789', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(34, 'Jay Joshikay K.', '', 'd41d8cd98f00b204e9800998ecf8427e', 'Male', '2025-02-28', '', 0, '2025-02-28', 2025, '', '', '9856320147', 'Active', 0, 0, 0, '', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'Duration in days',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `features` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `plan_name`, `type`, `duration`, `price`, `image`, `features`, `created_at`) VALUES
(10, 'Basic Plan', '', 30, 999.00, '', '                                    <div>Access to gym floor</div><div>Free locker facility</div><div>No personal trainer</div><div>Timing: 6 AM - 10 PM</div><div><strike>Unlimited access to gym floor</strike></div><div><strike>Dedicated personal trainer</strike></div><div><strike>Free access to group classes (yoga, Zumba, CrossFit)</strike></div>\r\n                                        ', '2025-02-24 11:40:43'),
(11, 'Standard Plan', '', 90, 2400.00, '', '                                    <div>Access to gym floor</div><div>Free locker facility</div><div>2 personal trainer sessions per month</div><div>Free diet consultation&nbsp;</div><div>Timing: 6 AM - 10 PM</div><div><strike>Unlimited diet consultations</strike></div><div><strike>Free access to group classes (yoga, Zumba, CrossFit)</strike></div><div><strike>Complimentary gym kit (t-shirt, shaker)</strike></div>\r\n                                        ', '2025-02-24 11:45:09'),
(12, 'Premium Plan', '', 180, 4999.00, '', '                        <div>Access to gym floor</div><div>Free locker facility</div><div>Timing: 24/7 access</div><div>&nbsp;personal trainer sessions per month</div><div>Free diet consultation (twice per month)</div><div>Complimentary gym kit (t-shirt, shaker)</div><div><strike>Access to group classes (yoga, Zumba)</strike></div><div><strike>Free access to group classes (yoga, Zumba, CrossFit)</strike></div>\n                                        ', '2025-02-24 11:47:13'),
(13, 'Elite Plan', 'personal', 90, 2999.00, '', '                                    <div>Unlimited access to gym floor</div><div>Free locker facility</div><div>Dedicated personal trainer</div><div>Unlimited diet consultations</div><div>Free access to group classes (yoga, Zumba, CrossFit)</div><div>Timing: 24/7 access</div><div>Free Chat Support</div>\r\n                                        ', '2025-02-24 11:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `member_plans`
--

CREATE TABLE `member_plans` (
  `id` int(11) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) DEFAULT 0,
  `payment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_plans`
--

INSERT INTO `member_plans` (`id`, `member_id`, `plan_id`, `start_date`, `end_date`, `status`, `payment_id`, `created_at`) VALUES
(9, '6e37116788aa', 10, '2025-02-02', '2025-03-29', 0, 24, '2025-02-27 17:16:00'),
(10, 'abb4a0a08f7d', 10, '2025-02-01', '2025-03-26', 0, 25, '2025-02-27 17:51:58'),
(11, '0098472b9f9a', 13, '2025-03-03', '2025-06-01', 1, 26, '2025-03-03 11:17:23'),
(13, '45a4e7837d86', 11, '2025-03-28', '2025-06-26', 1, 44, '2025-03-28 09:35:57'),
(14, '729393e0bd07', 10, '2025-03-30', '2025-04-29', 1, 47, '2025-03-30 09:44:38');

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
  `payment_method` varchar(200) NOT NULL,
  `payment_id` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(300) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_method`, `payment_id`, `status`, `comments`, `create_at`, `delivery`) VALUES
(27, '502593215236', 40, 'avadh Radadiya ajaybhai', 'sutax8081@gmail.com', '9767451236', '283 Plana plaza, punagam, surat, gujarat', 395010, 76000, 'Visa Card', '41', 1, NULL, '2025-03-27 05:09:57', 0),
(29, '123180886958', 40, 'Ayush Mangukiya K.', 'gihic39423@evluence.com', '9764310258', '175 Rachana Society, Kapodara, Surat, Gujarat', 395010, 64000, 'Visa Card', '43', 1, NULL, '2025-03-27 05:42:26', 1),
(31, '755148843223', 46, 'ava joy', 'avadhradadiya43@gmail.com', '09085647123', 'surat\r\nsurat', 390004, 37400, 'Visa Card', '50', 1, NULL, '2025-03-30 11:02:24', 0),
(32, '57305320123', 47, 'ava joy', 'sutax102@gmail.com', '09085647123', 'surat\r\nsurat', 390004, 12999, 'Visa Card', '51', 1, NULL, '2025-03-31 06:43:36', 0);

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
(28, 27, 9, 1, 32000, '2025-03-27 05:09:57'),
(29, 27, 7, 1, 16000, '2025-03-27 05:09:57'),
(30, 27, 15, 1, 28000, '2025-03-27 05:09:57'),
(32, 29, 9, 2, 32000, '2025-03-27 05:42:26'),
(35, 31, 7, 2, 16000, '2025-03-30 11:02:24'),
(36, 31, 8, 1, 5400, '2025-03-30 11:02:24'),
(37, 32, 2, 1, 12999, '2025-03-31 06:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `member_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `payment_status` int(10) NOT NULL DEFAULT 0,
  `payment_type` enum('membership','product','appointment') DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `member_id`, `amount`, `payment_date`, `payment_method`, `transaction_id`, `plan_id`, `payment_status`, `payment_type`, `order_id`, `appointment_id`, `invoice_number`, `notes`, `created_at`, `user_id`) VALUES
(24, '6e37116788aa', 999.00, '2025-02-27 18:16:00', 'Visa Card', 'txn_3QxAgqPx6HkKfodW0cWTQUfw', 10, 1, 'membership', NULL, NULL, NULL, NULL, '2025-02-27 17:16:00', 31),
(25, 'abb4a0a08f7d', 999.00, '2025-02-27 18:51:58', 'Visa Card', 'txn_3QxBFdPx6HkKfodW1m7CgEyB', 10, 1, 'membership', NULL, NULL, NULL, NULL, '2025-02-27 17:51:58', 39),
(26, '0098472b9f9a', 2999.00, '2025-03-03 12:17:23', 'Visa Card', 'txn_3QyX01Px6HkKfodW23k6z21h', 13, 1, 'membership', NULL, NULL, NULL, NULL, '2025-03-03 11:17:23', 40),
(41, NULL, 76000.00, '2025-03-27 06:09:57', 'Visa Card', 'txn_3R78hUPx6HkKfodW2Ib0qFxg', NULL, 1, 'product', 27, NULL, NULL, NULL, '2025-03-27 05:09:57', 40),
(43, NULL, 64000.00, '2025-03-27 06:42:26', 'Visa Card', 'txn_3R79CwPx6HkKfodW1yXOOImx', NULL, 1, 'product', 29, NULL, NULL, NULL, '2025-03-27 05:42:26', 40),
(44, '45a4e7837d86', 2400.00, '2025-03-28 10:35:57', 'Visa Card', 'txn_3R7ZKUPx6HkKfodW0NverVmZ', 11, 1, 'membership', NULL, NULL, NULL, NULL, '2025-03-28 09:35:57', 45),
(47, '729393e0bd07', 999.00, '2025-03-30 11:44:38', 'Visa Card', 'txn_3R8IQ0Px6HkKfodW0TwOh9wS', 10, 1, 'membership', NULL, NULL, NULL, NULL, '2025-03-30 09:44:38', 46),
(49, NULL, 800.00, '2025-03-30 12:51:26', 'credit_card', 'txn_3R8JSePx6HkKfodW2AH76Hwq', NULL, 1, 'appointment', NULL, 49, NULL, NULL, '2025-03-30 10:51:26', 46),
(50, NULL, 37400.00, '2025-03-30 13:02:24', 'Visa Card', 'txn_3R8JdHPx6HkKfodW21oXEJuV', NULL, 1, 'product', 31, NULL, NULL, NULL, '2025-03-30 11:02:24', 46),
(51, NULL, 12999.00, '2025-03-31 08:43:36', 'Visa Card', 'txn_3R8c4KPx6HkKfodW1UZtkn8c', NULL, 1, 'product', 32, NULL, NULL, NULL, '2025-03-31 06:43:36', 47);

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
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category_id`, `quantity`, `product_views`, `status`, `created_at`) VALUES
(1, 'Fitkit FT100 Series (3.25HP Peak) DC-Motorized Treadmill (Inclination: Manual, Max Weight: 110 Kg) with Free At Home Installation and Connected Live Interactive Sessions by Onefitplus', '61TLvvUdPWL._AC_SR160,134_QL64_.jpg', '<p>Brand Fitkit Colour Black Product Grade Home Product Dimensions 161.5D x 68W x 127H Centimeters Item Weight 57 Kilograms About this item Free Personal Dietitian (3 Months) and Personal Training Video Session along with Doctor Consultation for all Fitkit Treadmill users. In-Box Contents: 1 treadmill, toolkit, user manual and warranty card. Treadmill connects with the Fitplus App available on Android &amp; IOS platforms &ndash; It helps you track your daily workout and compiles all your data in one place. Fitplus App can also connect with the following Industry leading app - Apple Health, Fitbit, Google Fit, Amazon Alexa. 12 preset workout programs for efficient workout and changeable modes, to create a customized routine of exercises It is equipped with a powerful 1.75HP (Continuous) and 3.25HP (Peak) efficient DC Motor, 3 level manual inclination, Manual Lubrication for easy maintenance , a Speed Range of 0.8-14.8 km/hr, 1240*420 mm Wide Spacious anti-skid running board and can also be folded when not in use.It comes with a massager. LCD display showing speed, time, distance, calories burned and heart rate monitoring via heart rate sensor. It also comes with a safety key. Maximum user weight capacity - 110 kg, note: always choose a Treadmill that has user weight capacity at least 20 Kgs more than your current weight since the impact weight increases during running ,Warranty: 1 Year Warranty on Motor and Manufacturing Defect, 3 Years Warranty on Frame. Suggested to use a proper stabilizer. Easy folding &amp; Un-folding for more space saving &amp; easy mobility.</p>\r\n', 24999.00, 3, '10', '2', 1, '2025-03-08 03:09:32'),
(2, 'Fitkit by Cult FT98 Carbon (2HP Peak, Max Speed - 14km/hr) Brushless Motorized Treadmill for Home Gym Fitness with 1 Year Warranty', '51H-UdRV2cL._AC_SR230,210_QL64_.jpg', '<p>Brand Fitkit Colour Black Product Grade Home Product Dimensions 147.3D x 70.4W x 109.4H Centimeters Item Weight 31 Kilograms About this item Motor horsepower: 1.25HP, Motor type: DC-Motorised, Belt size: 47.24&quot; X 16.53&quot;, Max Weight support: 90 Kilograms, Lubrication: Easy Lubrication. Always choose a treadmill that can support at least 20 more kilograms of weight than your current weight. LED display showing speed, time, distance, calories burned. You are advised to buy/install a voltage stabilizer with the treadmill to protect the motor from power fluctuations and ensure its long life. Additionally, please connect the product to a power point with adequate earthing to ensure discharge of extra current. Warranty details: 1 Year manufacturer warranty on Motor and Manufacturing Defect, 3 Year Warranty on Frame. Note: Fitkit Brand is a part of Cult. Active post-sales and customer support &ndash; After delivery please contact us us for installation support (Working hours: Monday to Sunday from 9am to 6pm) to register your installation. (Note: Service schedule varies by location). For safety reasons, wearing proper athletic shoes on the treadmill is mandatory, instead of going Barefoot</p>\r\n', 12999.00, 3, '5', '', 1, '2025-03-08 03:09:32'),
(3, 'The Ohio Bar - Black Zinc', 'RA0539-BLBR-TH_rylohr.png', '<h2>THE OHIO BAR - CERAKOTE</h2>\r\n\r\n<p>MEN&#39;S 20KG MULTI-PURPOSE BARBELL</p>\r\n\r\n<p>Designed as an all-purpose barbell, the Ohio Bar excels in every movement&mdash;from the bench, squat, and deadlift to the clean, snatch, and everything in between. &nbsp;There is a reason that this barbell has been used at every CrossFit Games since its introduction in 2013 and is found in functional fitness gyms across the globe. &nbsp;Whether you&#39;re searching for the best barbell for your home gym or outfitting a facility, the Ohio Bar has you covered and is backed by a lifetime warranty.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>CRAFTED FOR EXCELLENCE IN COLUMBUS, OH</p>\r\n\r\n<p>Every Ohio Bar is meticulously machined and assembled in Columbus, OH using US steel that strikes the perfect balance between whip for Olympic lifts and rigidity for heavy Powerlifting. The 190,000 PSI tensile strength shaft features dual knurl marks for Olympic Weightlifting (IWF) and Powerlifting (IPF), and our signature Ohio knurling pattern that is carefully refined for a solid yet non-abrasive grip suitable for multi-purpose strength training.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 24000.00, 5, '5', '', 1, '2025-03-08 03:09:32'),
(6, 'Durafit Strong 4.5 HP Peak DC Motorized Treadmill with Max Speed 14 Km/Hr, Max User Weight 120 Kg, Manual Incline, Free Installation Assistance', '6795efd150da21.07350754.jpg', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Brand</td>\r\n			<td>Durafit - Sturdy, Stable and Strong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Colour</td>\r\n			<td>Black</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Product Dimensions</td>\r\n			<td>136D x 62W x 114H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Item Weight</td>\r\n			<td>34 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Material</td>\r\n			<td>Alloy Steel</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<h1>About this item</h1>\r\n\r\n<ul>\r\n	<li>Motor Power &amp; User Weight: Experience smooth and efficient performance with a powerful 4.5 HP Peak motor, ideal for walking and running exercises. Our powerful motors are built to support a maximum user weight of 120 kg, ensuring a stable and safe workout environment for all users, regardless of weight.</li>\r\n	<li>Speed Range: Our treadmill offers a versatile speed range from 1 to 14 km/h. It is designed to cater to a broad spectrum of fitness levels and workout intensities. Our treadmill features a spacious 1100x400 mm runnning belt, making it comfortable for older users and convenient for long distance or high speed running by our younger users as well.</li>\r\n	<li>Display: Stay motivated with your workout information on LCD Display, displaying time, speed, distance, and calories burned. Enjoy 3 level manual Incline for varied workouts and 12 preset programs to do your workouts on cruise mode.</li>\r\n	<li>Foldability and Control: Our treadmill features hydraulic folding for effortless storage in home gyms with limited space. The deck smoothly lifts with a simple push, saving valuable floor space, occupying just 3.5 sqft of your home. Enjoy hassle-free accessibility without compromising on performance. Our treadmill allows for effortless start, Stop &amp; Speed adjustments via handrail controls, providing seamless customization during workouts.</li>\r\n	<li>Manufacturer Warranty: Rest assured with a 1-year manufacturer warranty, ensuring peace of mind and reliable support for your treadmill investment.</li>\r\n</ul>\r\n', 23999.00, 3, '10', '', 1, '2025-03-08 03:09:32'),
(7, 'The Bella Bar 2.0 - Black Zinc', '6795f2534d17c3.65838140.jpeg', '<p>WOMEN&#39;S 15KG MULTI-PURPOSE BARBELL</p>\r\n\r\n<p>The Bella Bar is Rogue&#39;s go-to multipurpose 15KG barbell for female athletes. Fully machined and assembled in the USA, this versatile ladies bar is uniquely optimized for Olympic weightlifting, powerlifting, and/or a CrossFit WOD.</p>\r\n\r\n<p>Built with as much attention to detail as any bar in the Rogue family, the Bella Bar is a women&rsquo;s weightlifting bar forged on equal ground.</p>\r\n\r\n<p>A staple of women&rsquo;s CrossFit competitions-- including events at the CrossFit Games-- the 25MM Bella Bar has no center knurl and features the same Rogue signature dual knurl marks and 190,000 PSI tensile strength as our flagship 20KG Ohio Bar. The hybrid knurling pattern itself offers a firm but comfortable grip on both power lifts and Olympic lifts, while quality U.S. steel and snap-ring bronze bushings produce the perfect balance of spin and stability.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>CRAFTED FOR EXCELLENCE IN COLUMBUS, OH</p>\r\n\r\n<p>As with all Rogue Bella Bars, the black zinc variant undergoes meticulous machining and assembly in Columbus, Ohio. It features a 190,000 PSI tensile strength steel shaft providing the ideal amount of whip, dual knurl marks without a center knurl, and bright zinc sleeves. The hybrid knurling pattern ensures a secure yet comfortable grip, while premium bronze bushings contribute to the ideal balance for both power and Oly lifts.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ENHANCED FEATURES</p>\r\n\r\n<p><strong>Best In Class Durability</strong>: &nbsp;Engineered to withstand the increased demands that functional movements and Olympic lifts place on barbells today through overhead drops. &nbsp;Read more&nbsp;<a href=\"https://www.roguefitness.com/theindex/article/f-scale-overview\">here</a>.</p>\r\n\r\n<p><strong>2X Quieter Performance</strong>: Refined with even stricter tolerances, precision-machined bronze bushings fit tighter around the shaft, and improved internal sleeve tolerances dampen sound and eliminate unwanted movement, ensuring a smoother and more stable lift.</p>\r\n', 16000.00, 5, '10', '5', 1, '2025-03-08 03:09:32'),
(8, 'Rogue 45LB Ohio Power Bar - Stainless / Black', '6795f3ddf3b1d0.43009220.jpeg', '<p>MEN&#39;S 45LB POWERLIFTING BARBELL</p>\r\n\r\n<p>Crafted to stand out as the ultimate powerlifting barbell, the Ohio Power Bar shines in the squat, bench press, and deadlift. The 29MM shaft provides minimal flex for maximum stability under heavy loads and is paired with a deep knurl designed for a sticky grip. Left uncoated, the knurl will feel just as it was intended, while the stainless shaft maintains the highest level of oxidation resistance. From the home gym to the commercial facility, the Ohio Power Bar is your go-to for the big three lifts or any accessory requiring a barbell.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>PRECISION MEETS POWER</strong></p>\r\n\r\n<p>Every Ohio Power Bar is precisely machined and assembled in Columbus, OH using US steel that is proven ideal for heavy powerlifting. We combine a 200,000 PSI tensile strength, low flexion shaft, IPF powerlifting knurl marks and our signature Ohio Power Bar knurling. The knurling is machined in a pattern that is deep and coarse, providing an ideal surface for heavy pulls without being sharp or abrasive. Additionally, it features a matching center knurl that adheres to your back when you need it most.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ENHANCED FEATURES</p>\r\n\r\n<p><strong>Best In Class Durability</strong>: Rogue manufactures the world&#39;s most durable barbells, and the Ohio Power Bar is no exception. This bar has been engineered to withstand the heavy demands required from the home gym to the commercial facility. Read more&nbsp;<a href=\"https://www.roguefitness.com/theindex/article/f-scale-overview\">here</a>.</p>\r\n\r\n<p><strong>2X Quieter Performance:</strong>&nbsp;Refined with even stricter tolerances, precision-machined bronze bushings fit tighter around the shaft, and improved internal sleeve tolerances dampen sound and eliminate unwanted movement, ensuring a smoother and more stable lift.</p>\r\n\r\n<p><strong>Low Profile Sleeve Design:&nbsp;</strong>The sleeves are now machined using a new low-profile sleeve design that allows for easier than ever loading and unloading of plates.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 5400.00, 5, '19', '', 1, '2025-03-08 03:09:32'),
(9, 'RML-490C Power Rack 3.0', '6795f449c79306.22722864.jpeg', '<h2>&nbsp;RML-490C POWER RACK 3.0</h2>\r\n\r\n<p>Originally developed to combine the 3x3&rdquo; 11-gauge steel construction of the&nbsp;<a href=\"https://www.roguefitness.com/rogue-rm-4-bolt-together-monster-rack-2-0\">RM-4 Monster Rack</a>&nbsp;with the 5/8&rdquo; hardware of the&nbsp;<a href=\"https://www.roguefitness.com/rogue-r-4-power-rack\">Infinity R-4</a>, our latest versatile RML-490C Monster Lite Rack now also includes: a wide range of custom color finish options, a new stabilizing back-nameplate,&nbsp;<a href=\"https://www.roguefitness.com/rogue-monster-lite-slinger\">Slinger</a>-compatible crossmembers, and your choice of either numbered or unnumbered uprights.</p>\r\n\r\n<p>As with all past models, Version 3.0 of the RML-490C Rack is manufactured in Columbus, Ohio, and features 90&rdquo; tall uprights with laser-cut holes in the Westside pattern (1&rdquo; through bench and clean pull zone, 2&rdquo; spacing above and below). A full line-up of accessories also come standard with the 43&rdquo; depth unit, including a set of Monster Lite J-Cups, Pin/Pipe Safeties, Band Pegs, and a 43&rdquo; Single Pull-Up Bar. An optional stabilizer (in a matte black powdercoat finish) can be added to an order via the dropdown menu.</p>\r\n', 32000.00, 6, '10', '4', 1, '2025-03-08 03:09:32'),
(11, 'Flexnest 4.5HP Peak Smart Auto Incline Treadmill, Max Speed 15km/h with 500+ Classes and Virtual Walks for Home Walking and Running with in-Built Bluetooth Speaker - Black (Flextread Hike)', '67b49d2004b0c7.61306474.jpg', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<h2>Product information</h2>\r\n\r\n			<h1>Technical Details</h1>\r\n\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<th>Brand</th>\r\n						<td>&lrm;Flexnest</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Colour</th>\r\n						<td>&lrm;Black</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Product Grade</th>\r\n						<td>&lrm;Replacement Parts</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Product Dimensions</th>\r\n						<td>&lrm;127D x 115W x 675H Centimeters</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Item Weight</th>\r\n						<td>&lrm;40.8 Kilograms</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Material</th>\r\n						<td>&lrm;Alloy Steel</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Maximum Speed</th>\r\n						<td>&lrm;15 Kilometers per Hour</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Special Feature</th>\r\n						<td>&lrm;Built-In Speaker</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Target Audience</th>\r\n						<td>&lrm;Adult</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Maximum Horsepower</th>\r\n						<td>&lrm;4.5 Horsepower</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Maximum Incline Percentage</th>\r\n						<td>&lrm;15</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Included Components</th>\r\n						<td>&lrm;User Manual, Remote Control, Tool Kit</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Maximum Weight Recommendation</th>\r\n						<td>&lrm;120 Kilograms</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Model Name</th>\r\n						<td>&lrm;Flextread</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Manufacturer</th>\r\n						<td>&lrm;Flexnest</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Item model number</th>\r\n						<td>&lrm;Flextread Hike</td>\r\n					</tr>\r\n					<tr>\r\n						<th>ASIN</th>\r\n						<td>&lrm;B0DL657ZNB</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<h1>Additional Information</h1>\r\n\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<th>Manufacturer</th>\r\n						<td>Flexnest</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Packer</th>\r\n						<td>Melrose Brands Private Limited, Melrose Brands Private Limited, B9, Infocity 1, Sector - 34, Gurgaon, Haryana, India - 122001</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Importer</th>\r\n						<td>Melrose Brands Private Limited, Melrose Brands Private Limited, B9, Infocity 1, Sector - 34, Gurgaon, Haryana, India - 122001</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Item Weight</th>\r\n						<td>40 kg 800 g</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Net Quantity</th>\r\n						<td>1 Count</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Included Components</th>\r\n						<td>User Manual, Remote Control, Tool Kit</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Generic Name</th>\r\n						<td>Treadmill</td>\r\n					</tr>\r\n					<tr>\r\n						<th>Best Sellers Rank</th>\r\n						<td>#3,199 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n						#17 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404687031/ref=pd_zg_hrsr_sports\">Treadmills</a></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 32999.00, 3, '10', '', 1, '2025-03-08 03:09:32'),
(12, 'PowerMax Fitness TDM-97 1HP (2HP Peak) Motorized Treadmill with DIY and Virtual Assistance, Home Use & Automatic BMI Calc.', '67b49fcb98b2d9.35470414.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;PowerMax Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Grade</th>\r\n			<td>&lrm;DC Motor Treadmill can work efficiently for 30 minutes continuously, but after that, it needs a break of about 20 minutes.</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;143D x 63.5W x 106.5H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;34 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Speed</th>\r\n			<td>&lrm;12 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special Feature</th>\r\n			<td>&lrm;Foldable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Recommended Uses For Product</th>\r\n			<td>&lrm;Jogging Walking Running</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Target Audience</th>\r\n			<td>&lrm;Youth, Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Horsepower</th>\r\n			<td>&lrm;4 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Assembly Required</th>\r\n			<td>&lrm;No</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;LED</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Corded Electric</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Programmes</th>\r\n			<td>&lrm;12</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Technology</th>\r\n			<td>&lrm;Auxiliary</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;1 x Treadmill</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Metrics Measured</th>\r\n			<td>&lrm;Speed, Heart Rate, Calories Burned, Time, Distance</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Benefits</th>\r\n			<td>&lrm;Weight Loss Support, Improve Muscle Strength, Improve Bone Strength</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;100 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Length</th>\r\n			<td>&lrm;43.3 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Width</th>\r\n			<td>&lrm;15.7 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Frame Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speed Rating</th>\r\n			<td>&lrm;12 Kilometers per hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Folded Size</th>\r\n			<td>&lrm;24.003 CM x 50 CM x70 CM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Size</th>\r\n			<td>&lrm;15.7 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Input Power</th>\r\n			<td>&lrm;4 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Minimum Speed</th>\r\n			<td>&lrm;1 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Global Trade Identification Number</th>\r\n			<td>&lrm;08904335100478</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;TDM-97【4HP Peak】</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Powermax Fitness (I) Pvt. Ltd., 808- Lotus Trade Center, New Link Rd. Andheri (W), Mumbai - 400053, MH, IN Contact: +91-8080-269-269 / +91-8080-206-206 customersupport@powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Powermax Fitness (I) Pvt. Ltd.</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;PMTDM-97</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B06VVB5XCT</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd., 808- Lotus Trade Center, New Link Rd. Andheri (W), Mumbai - 400053, MH, IN Contact: +91-8080-269-269 / +91-8080-206-206 customersupport@powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd. 808- Lotus Trade Center, New Link Rd. Andheri (W), Mumbai - 400053, MH, IN Contact: +91-8080-269-269 / +91-8080-206-206 customersupport@powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd.Contact: +91-8080-269-269 / +91-8080-206-206 Email: customersupport@powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>34 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.0 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 x Treadmill</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Treadmill</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 20999.00, 3, '6', '', 1, '2025-03-08 03:09:32'),
(13, 'PowerMax Fitness TD-A1 (4 HP Peak) Motorised Foldable Treadmill for Home User Wt. 115kg 15 Lvl Auto-Incline Running Machine for Max Pro workout, Top Speed 14 km/ph, Speaker, Aux, LCD Disp., Bluetooth', '67b4a079298de4.74735861.jpg', '<h2>Product information</h2>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;PowerMax Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Grade</th>\r\n			<td>&lrm;DC Motor Treadmill can work efficiently for 30 minutes continuously, but after that, it needs a break of about 20 minutes.</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;159.7D x 74.3W x 126.6H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;48 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Speed</th>\r\n			<td>&lrm;14 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special Feature</th>\r\n			<td>&lrm;Foldable, Compact Design</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Recommended Uses For Product</th>\r\n			<td>&lrm;Jogging Walking Running</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Target Audience</th>\r\n			<td>&lrm;Adult, Youth</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Horsepower</th>\r\n			<td>&lrm;4 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Incline Percentage</th>\r\n			<td>&lrm;15</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Assembly Required</th>\r\n			<td>&lrm;No</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;LCD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Corded Electric</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Programmes</th>\r\n			<td>&lrm;12</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Technology</th>\r\n			<td>&lrm;Auxiliary</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Control Program Name</th>\r\n			<td>&lrm;Fitness Test</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;1 x Assembly Tool kit, 1 x User Manual, 1 x Treadmill Machine, 1 x Warranty Card, 1 x Lubrication Oil (30ml)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Metrics Measured</th>\r\n			<td>&lrm;Speed, Calories Burned, Time, Distance</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Benefits</th>\r\n			<td>&lrm;Weight Loss Support, Improve Muscle Strength, Improve Bone Strength</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;100 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Length</th>\r\n			<td>&lrm;47.6 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Width</th>\r\n			<td>&lrm;15.7 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Frame Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speed Rating</th>\r\n			<td>&lrm;14 Kilometers per hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Folded Size</th>\r\n			<td>&lrm;162 CM x 76 CM x29 CM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Size</th>\r\n			<td>&lrm;10 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Input Power</th>\r\n			<td>&lrm;4 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Minimum Speed</th>\r\n			<td>&lrm;1 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Global Trade Identification Number</th>\r\n			<td>&lrm;08904335102670</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;Motorised Treadmill for Home Use</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Powermax Fitness (I) Pvt. Ltd., Contact: +91-8080-206-206, WhatsApp: +91-8080-269-269, Email: support@powermaxfitness.net, Support or Ticket: support.powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Powermax Fitness (I) Pvt. Ltd.</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;PMTD-A1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B08TC5QSHG</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd., Contact: +91-8080-206-206, WhatsApp: +91-8080-269-269, Email: support@powermaxfitness.net, Support or Ticket: support.powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd., Contact: +91-8080-206-206, WhatsApp: +91-8080-269-269, Email: support@powermaxfitness.net, Support or Ticket: support.powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Powermax Fitness (I) Pvt. Ltd., Contact: +91-8080-206-206, WhatsApp: +91-8080-269-269, Email: support@powermaxfitness.net, Support or Ticket: support.powermaxfitness.net</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>48 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 x Assembly Tool kit, 1 x User Manual, 1 x Treadmill Machine, 1 x Warranty Card, 1 x Lubrication Oil (30ml)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Motorised Treadmill</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 29214.00, 3, '20', '', 1, '2025-03-08 03:09:32'),
(14, 'SPARNOD FITNESS STH-4100 (4.5HP Peak) Automatic and Foldable Treadmill with Auto-Incline for Home Use (Free Installation Service)', '67b4a132553292.37387220.jpg', '<h2>Product information</h2>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;SPARNOD FITNESS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Grade</th>\r\n			<td>&lrm;Home</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;149D x 72.9W x 116H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;38 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Speed</th>\r\n			<td>&lrm;14 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special Feature</th>\r\n			<td>&lrm;Foldable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Target Audience</th>\r\n			<td>&lrm;Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Horsepower</th>\r\n			<td>&lrm;4.5 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Incline Percentage</th>\r\n			<td>&lrm;15</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Assembly Required</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;LCD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Corded Electric</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Programmes</th>\r\n			<td>&lrm;12</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Technology</th>\r\n			<td>&lrm;Power cord</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;Safety Key</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Metrics Measured</th>\r\n			<td>&lrm;Heart Rate, Speed, Distance, Calories Burned</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;115 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Frame Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speed Rating</th>\r\n			<td>&lrm;14 kilometers_per_hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Size</th>\r\n			<td>&lrm;3 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Input Power</th>\r\n			<td>&lrm;4.5 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Minimum Speed</th>\r\n			<td>&lrm;0.8 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;STH-4100</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;SPARNOD FITNESS, Sparnod Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;SPARNOD FITNESS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;4HP Peak with 12 Pre-Set Programs</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B092W11D15</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>SPARNOD FITNESS, Sparnod Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Sparnod Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Sparnod Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>38 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>Safety Key</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Treadmill</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 35000.00, 3, '21', '', 1, '2025-03-08 03:09:32'),
(15, 'LETS PLAY LP-20106 4HP Peak DC Motor Manual Incline Foldable Treadmill for Running, Walking, Jogging with 12 Programs, Top Speed 12 Km/Hr, 110Kg User Weight, BT Speaker, Pulse Sensor, Black', '67b4a1db8ba724.69290838.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;LET&#39;S PLAY</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Grade</th>\r\n			<td>&lrm;Home Treadmill</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;174.5D x 75.8W x 129H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;28 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Stainless Steel, Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Speed</th>\r\n			<td>&lrm;12 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special Feature</th>\r\n			<td>&lrm;Built-In Speaker, Manual Incline, Foldable, Wheeled, Heart Rate Monitor</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Recommended Uses For Product</th>\r\n			<td>&lrm;Walking, Power Walk, Incline Walk, Running, Cadio Workout, Jogging</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Target Audience</th>\r\n			<td>&lrm;Adult, Youth</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Horsepower</th>\r\n			<td>&lrm;4 Horsepower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Incline Percentage</th>\r\n			<td>&lrm;15.0</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Assembly Required</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;LCD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Corded Electric</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Programmes</th>\r\n			<td>&lrm;12</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Technology</th>\r\n			<td>&lrm;Bluetooth, Aux, USB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Control Program Name</th>\r\n			<td>&lrm;Manual</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;User Manual, Safety Key, Treadmill</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Metrics Measured</th>\r\n			<td>&lrm;Heart Rate, Speed, Calories Burned, Time, Distance</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Benefits</th>\r\n			<td>&lrm;Reduce Stress and Improve Mood, Weight Loss Support, Improves Sleep Quality, Improve Muscle Strength, Improve Bone Strength, Improve Heart Health</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;110 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Length</th>\r\n			<td>&lrm;110 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Deck Width</th>\r\n			<td>&lrm;40 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Frame Material</th>\r\n			<td>&lrm;Stainless Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speed Rating</th>\r\n			<td>&lrm;1 - 12 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Folded Size</th>\r\n			<td>&lrm;60 x 75.8 x 140 cm (approx)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Minimum Speed</th>\r\n			<td>&lrm;1 Kilometers per Hour</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;LP-20106N (4HP DC MOTOR)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;LET&#39;S PLAY, LETS PLAY, Sector 6 Dwarka, Palam Vihar, New Delhi - 110075, Contact: +91 85879 02343</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;LET&#39;S PLAY</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;LP-20106N (4HP DC MOTOR)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0CQNT7H87</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>LET&#39;S PLAY, LETS PLAY, Sector 6 Dwarka, Palam Vihar, New Delhi - 110075, Contact: +91 85879 02343</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>LETS PLAY, Sector 6 Dwarka, Palam Vihar, New Delhi - 110075, Contact: +91 85879 02343</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>LETS PLAY, Sector 6 Dwarka, Palam Vihar, New Delhi - 110075, Contact: +91 85879 02343</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>28 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.0 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>User Manual, Safety Key, Treadmill</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Manual Treadmill for Home</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 28000.00, 3, '21', '', 1, '2025-03-08 03:09:32'),
(17, 'Cult.Sport smartcross Bern Elliptical Cross Trainer | Adjustable Seat | Max Weight: 120kg for Home Gym Fitness with 6 Months Warranty', '67e7a1db81a435.96368323.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;smartcross Bern</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;CULTSPORT</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;123D x 63.5W x 155H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resistance Mechanism</th>\r\n			<td>&lrm;Magnetic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;120 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;29000 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Resistance Levels</th>\r\n			<td>&lrm;8</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Cultgear Pvt. Ltd., CULTGEAR PVT LTD DC GANDHI WAREHOUSE NO - 116, ORAKKADU ROAD, SHOLAVARAM, CHENNAI, THIRUVALLUR, TAMIL NADU 600067</td>\r\n		</tr>\r\n		<tr>\r\n			<th>UPC</th>\r\n			<td>&lrm;789554535045</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Cultgear Pvt. Ltd.</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;0524-01-023</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0CBKRQ56M</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Cultgear Pvt. Ltd., CULTGEAR PVT LTD DC GANDHI WAREHOUSE NO - 116, ORAKKADU ROAD, SHOLAVARAM, CHENNAI, THIRUVALLUR, TAMIL NADU 600067</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>CULTGEAR PVT LTD DC GANDHI WAREHOUSE NO - 116, ORAKKADU ROAD, SHOLAVARAM, CHENNAI, THIRUVALLUR, TAMIL NADU 600067</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>CULTGEAR PVT LTD DC GANDHI WAREHOUSE NO - 116, ORAKKADU ROAD, SHOLAVARAM, CHENNAI, THIRUVALLUR, TAMIL NADU 600067</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>29 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Piece</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 Elliptical, Tool Kit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Elliptical Cross Trainer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#1,750 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#1 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 15000.00, 4, '10', '', 1, '2025-03-29 07:31:39'),
(18, 'Cockatoo Trainer-X 5Kg Fly-Wheel Elliptical Cross Trainer for Home, with 8 Levels of Resistance Exercise Equipment for Home, Max User Weight 120 Kg (Free Installation Assistance', '67e7a2a8149712.93108238.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;Trainer-X</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Cockatoo</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;115D x 63.5W x 155H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resistance Mechanism</th>\r\n			<td>&lrm;Magnetic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;120 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Stride Length</th>\r\n			<td>&lrm;18 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;27 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Resistance Levels</th>\r\n			<td>&lrm;8</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Cockatoo, Cockatoo Sports Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Cockatoo</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;Trainer-X</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0DDHNX5W4</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Cockatoo, Cockatoo Sports Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Cockatoo Sports Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Cockatoo Sports Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>27 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Piece</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 Cross Trainer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Cross Trainer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#3,310 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#4 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 15990.00, 4, '20', '', 1, '2025-03-29 07:35:04'),
(19, 'Welcare WC6044 Elliptical Cross Trainer for Home use with Adjustable seat, Free Diet Plan,Hand Pulse Sensor, Anti Slip Pedal, LCD Monitor, Adjustable Resistance Magnetic Exercise Cycle for Home Gym', '67e7a38154f038.61803406.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;90 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Controls Type</th>\r\n			<td>&lrm;Push Button, Dial</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;LCD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Stride Length</th>\r\n			<td>&lrm;14 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Resistance Levels</th>\r\n			<td>&lrm;8</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operation Mode</th>\r\n			<td>&lrm;Manual</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Corded Electric</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;WELCARE</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;WC6044</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B07BXPHHH6</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>WELCARE</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>S AND T WELCARE EQUIPMENTS P LTD, INDIA, CONTATC - 9842993755</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>S AND T WELCARE EQUIPMENTS P LTD, INDIA, CONTATC - 9842993755</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>31 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Dimensions LxWxH</th>\r\n			<td>125 x 61 x 151 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.00 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 x Elliptical Trainer, 1 x User Manual, 1 x Assembly Kit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Exercise &amp; Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#2,105 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#2 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 16999.00, 4, '15', '', 1, '2025-03-29 07:38:41'),
(20, 'Lifelong Elliptical Cross Trainer Bike for Home Use | Cycling Machine | Exercise Machine with Touch LED Screen Display, Adjustable Seat |6kg Flywheel|Magnetic Adjustable Resistance & iPad Holder-white', '67e7a48bd9e276.90327391.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;Elliptical Trainers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Lifelong</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;White</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;100D x 48W x 75H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resistance Mechanism</th>\r\n			<td>&lrm;Magnetic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Stride Length</th>\r\n			<td>&lrm;14 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Size</th>\r\n			<td>&lrm;6 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;29000 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Resistance Levels</th>\r\n			<td>&lrm;16</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Imp and Mktd By Lifelong Online Retail Pvt Ltd, Imported and Marketed by Lifelong Online Retail Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Imp and Mktd By Lifelong Online Retail Pvt Ltd</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;LLETM29</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0DMSLDTJL</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Imp and Mktd By Lifelong Online Retail Pvt Ltd, Imported and Marketed by Lifelong Online Retail Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Imported and Marketed by Lifelong Online Retail Private Limited, 5th Floor, Unit No. 508, DLF South Court, Saket District Center, Saket New Delhi, India - 110017 Tel: +91 9711558877, Email: customercare@lifelongonline.com</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Lifelong Online Retail Private Limited, 5th Floor, Unit No. 508, DLF South Court, Saket District Center, Saket New Delhi, India &ndash; 110017 Tel: +91 9711558877, Email: customercare@lifelongonline.com</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>29 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 N Exercise Bike, 1 N Manual, 1 Toolkit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Exercise Bike</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#15,510 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#8 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 15999.00, 4, '5', '', 1, '2025-03-29 07:43:07'),
(21, 'Flexnest Flextrainer EZ Smart, Seated Elliptical Cross Trainer, Max Weight: 120kg for Home Gym Workout with 1 Year Warranty and in-Built Display', '611tsGRPkOL._SL1500_.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;FLX087</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Flexnest</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;117D x 59W x 152H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Iron</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resistance Mechanism</th>\r\n			<td>&lrm;Magnetic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Weight Recommendation</th>\r\n			<td>&lrm;160 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;37 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Melrose Brands Private Limited, Melrose Brands Private Limited, Melrose Brands Private Limited, B9, Infocity 1, Sector - 34, Gurgaon, Haryana, India - 122001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Department</th>\r\n			<td>&lrm;Unisex-Adult</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Melrose Brands Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;FLX087</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0D5B3KMGR</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Melrose Brands Private Limited, Melrose Brands Private Limited, Melrose Brands Private Limited, B9, Infocity 1, Sector - 34, Gurgaon, Haryana, India - 122001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Melrose Brands Private Limited, Melrose Brands Private Limited, B9, Infocity 1, Sector - 34, Gurgaon, Haryana, India - 122001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Melrose Brands Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>37 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.00 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>Warranty Card, Flextrainer, User Mnaual</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Elliptical Cross Trainer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#14,617 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#7 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 16000.00, 4, '10', '', 1, '2025-03-29 07:46:10');
INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category_id`, `quantity`, `product_views`, `status`, `created_at`) VALUES
(22, 'Leikefitness Rowing Machine Foldable for Home Use Hydraulic Rowing Machine with LCD Monitor for Full Body Exercise Cardio Workout', '67e7a6be2a3639.13471632.jpg', '<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;Elliptical Trainers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Lifelong</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;White</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;100D x 48W x 75H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resistance Mechanism</th>\r\n			<td>&lrm;Magnetic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Stride Length</th>\r\n			<td>&lrm;14 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Size</th>\r\n			<td>&lrm;6 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;29000 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Resistance Levels</th>\r\n			<td>&lrm;16</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Imp and Mktd By Lifelong Online Retail Pvt Ltd, Imported and Marketed by Lifelong Online Retail Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Imp and Mktd By Lifelong Online Retail Pvt Ltd</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;LLETM29</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0DMSLDTJL</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Imp and Mktd By Lifelong Online Retail Pvt Ltd, Imported and Marketed by Lifelong Online Retail Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Imported and Marketed by Lifelong Online Retail Private Limited, 5th Floor, Unit No. 508, DLF South Court, Saket District Center, Saket New Delhi, India - 110017 Tel: +91 9711558877, Email: customercare@lifelongonline.com</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Lifelong Online Retail Private Limited, 5th Floor, Unit No. 508, DLF South Court, Saket District Center, Saket New Delhi, India &ndash; 110017 Tel: +91 9711558877, Email: customercare@lifelongonline.com</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>29 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>1 N Exercise Bike, 1 N Manual, 1 Toolkit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Exercise Bike</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#15,510 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#8 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404681031/ref=pd_zg_hrsr_sports\">Exercise &amp; Fitness Elliptical Trainers</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 20000.00, 4, '15', '', 1, '2025-03-29 07:52:30'),
(23, 'BULLAR olympic barbell 7 feet 20kg, barbell rod, olympic rod for powerlifting, olympic bar for weight lifting, with spring or clamps locks (7 feet with spring lock)', '67e7a78d6da0c7.93661085.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;BULLAR</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;12 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Type</th>\r\n			<td>&lrm;Knurled</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;78L x 4W Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speaker Cutout Diameter or Length</th>\r\n			<td>&lrm;50 Millimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Shaft Diameter</th>\r\n			<td>&lrm;30 Millimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Shaft Length</th>\r\n			<td>&lrm;53.5 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Size</th>\r\n			<td>&lrm;10</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;140 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Finish Type</th>\r\n			<td>&lrm;Chrome</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Sleeve Length</th>\r\n			<td>&lrm;3 Feet</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Shellman industries, Shellman Industries, Plot No. 122, Transport Nagar, Jalandhar, Punjab, 144012</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Shellman industries</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;olympic barbell</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0B24L3817</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Shellman industries, Shellman Industries, Plot No. 122, Transport Nagar, Jalandhar, Punjab, 144012</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Shellman Industries , 1, Hargobind Nagar, Opp. Reru Pind, JALANDHAR, PUNJAB, IN, 144012</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>12 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Set</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>BARBELL</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#2,766 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#14 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404713031/ref=pd_zg_hrsr_sports\">Strength Training Bars</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 25000.00, 5, '4', '', 1, '2025-03-29 07:55:57'),
(24, 'LUMA FIT YOUTH FITNESS 5Ft Weightlifting Bar Solid Olympic Bar Barbell Rod Olympic Curl Bar Straight Barbell for Cross Training Weight Lifting Powerlifting, 120 KG Capacity', '67e7a8223ce491.18163186.jpg', '<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;LUMA FIT</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Type</th>\r\n			<td>&lrm;Knurled</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speaker Cutout Diameter or Length</th>\r\n			<td>&lrm;2 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Size</th>\r\n			<td>&lrm;1.1 inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;120 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Finish Type</th>\r\n			<td>&lrm;Chrome</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Kashaf Enterprises</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;RD-003</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0C4Z5CG6W</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1000.00, 5, '20', '', 1, '2025-03-29 07:58:26'),
(25, 'LEEWAY Alloy Steel Olympic Barbell Bar 7 Feet|Weight Bar For Weightlifting,Powerlifting,Crossfit,Gym Home Exercises Rod(49Mm Outer Diameter)For 2\" Plates With Barbell Clamps(Olympic Barbell -Black)', '67e7a901408368.25363020.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;LEEWAY</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;16 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Type</th>\r\n			<td>&lrm;Knurled</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;2.2L x 0.05W Meters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speaker Cutout Diameter or Length</th>\r\n			<td>&lrm;2 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Size</th>\r\n			<td>&lrm;1.1&#39;&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;440 Pounds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Finish Type</th>\r\n			<td>&lrm;Black Oxide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Sleeve Length</th>\r\n			<td>&lrm;14 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Leeway, Leeway, 01214304345</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Leeway</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;Olympic Barbell Bar 7 feet</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B09CL8T9ZY</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Leeway, Leeway, 01214304345</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Leeway Fitness| 01214304345</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>16 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.00 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Olympic Barbell Bar 7 feet</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 500.00, 5, '20', '', 1, '2025-03-29 08:02:09'),
(26, 'Konark Fitness 4 Feet Curling Olympic Barbell Rod Bench Press, Deadlift, Powerlifting, CrossFit Training (28 mm Internal Dia and 50mm Outer Dia) with Two PVC Collar', '67e7a9549c3216.78726093.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel with Chrome Sleeves</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Konark</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;5 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Type</th>\r\n			<td>&lrm;Knurled</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;70L x 5W Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Grip Size</th>\r\n			<td>&lrm;1&quot;</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;200 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Finish Type</th>\r\n			<td>&lrm;Black Zinc</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Sleeve Length</th>\r\n			<td>&lrm;8 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Konark Enterprises</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;4FT EZ Olympic Barbell Zink</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0CJ9TZQSL</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Konark Enterprises</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Konark Enterprises</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>5 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.00 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Olympic Barbell</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#11,827 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#79 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404713031/ref=pd_zg_hrsr_sports\">Strength Training Bars</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 5400.00, 5, '10', '', 1, '2025-03-29 08:03:32'),
(27, 'Power Rack Commercial Package PR-09 Pro with Adjustable Bench AB-201 for Home Gym Workout | Heavy Duty Power Rack with Laser Cutting Panels | 4 x 2 Inches 12 Gauge Frame | Home Gym', '67e7ac09c23976.96600421.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;GAMMA FITNESS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;122D x 122W x 210H Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;Modern</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;140 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;800 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Gamma Fitness, Gamma Industries, JRC Tower, Tagore Nagar, Jalandhar, Punjab, 144002. Customer Care 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;Adjustable Bench AB-201, Power Rack PR-09 Pro</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material Type</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Season</th>\r\n			<td>&lrm;year round</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Team</th>\r\n			<td>&lrm;home</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Gamma Fitness</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>B0BYKJJ94L</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#1,189,410 in Home &amp; Kitchen (<a href=\"https://www.amazon.in/gp/bestsellers/kitchen/ref=pd_zg_ts_kitchen\">See Top 100 in Home &amp; Kitchen</a>)<br />\r\n			#7,260 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/kitchen/4339323031/ref=pd_zg_hrsr_kitchen\">Dish Racks (Home &amp; Kitchen)</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th>Date First Available</th>\r\n			<td>15 March 2023</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Gamma Fitness, Gamma Industries, JRC Tower, Tagore Nagar, Jalandhar, Punjab, 144002. Customer Care 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Gamma Industries, JRC Tower, Tagore Nagar, Jalandhar, Punjab, 144002. Customer Care 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Gamma Industries, JRC Tower, Tagore Nagar, Jalandhar, Punjab, 144002. Customer Care 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>140 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Power Rack Combo</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 26000.00, 6, '20', '', 1, '2025-03-29 08:15:05'),
(28, 'AMMA FITNESS Commercial Grade Power Steel Squat Rack PR- 42 with LATS Pull Down and Rowing', '67e7acc1e86768.01486890.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;GAMMA FITNESS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Alloy Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;Modern</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Racks</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Weight Limit</th>\r\n			<td>&lrm;500 Kilograms</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Frame Type</th>\r\n			<td>&lrm;Rectangular Frame</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;GAMMA FITNESS, Gamma Industries, 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;GAMMA FITNESS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;PR-42</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0935F82HB</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>GAMMA FITNESS, Gamma Industries, 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Gamma Industries, Customer Care: 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Gamma Industries, Customer Care: 9501189896</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>200 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Dimensions LxWxH</th>\r\n			<td>147.3 x 121.9 x 229 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>Power Rack Attachments, Power Rack Frames, Weight Stack Plates</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Power Squat Rack</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#71,275 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#13 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404725031/ref=pd_zg_hrsr_sports\">Power Cages</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 50000.00, 6, '25', '', 1, '2025-03-29 08:18:09'),
(29, 'Leosportz Hand Grip Strength Trainer (100 kgs) - Forearm Strength Trainer Adjustable Gripper | New Improved Design for Heavy Strength Training (100 kgs, Orange)', '67e7ad8d94f557.25518721.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Orange</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Metal</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Leosportz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;H - shape</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Tension Level</th>\r\n			<td>&lrm;100 kgs</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Shape</th>\r\n			<td>&lrm;Oval</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Leosportz, support@serveuttam.com https:leosportz.in</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Leosportz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;LE-HS-260624</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0D83NMK9V</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Leosportz, support@serveuttam.com https:leosportz.in</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>serveuttam</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>430 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Dimensions LxWxH</th>\r\n			<td>18 x 10 x 5 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#974 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#24 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404718031/ref=pd_zg_hrsr_sports\">Strength Training Grip Strengtheners</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 15000.00, 15, '10', '', 1, '2025-03-29 08:21:33'),
(30, 'Wearslim Adjustable Hand Grip Strengthener With Resistance (10KG - 100KG), Hand Gripper Forearm Exercise Finger Exercise Power Gripper for Men & Women for Gym Workout With Counter - Assorted Color', '67e7ae26c8b0b6.75322303.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Hand Grip With Counter (10 -100Kg)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Thermoplastic Elastomers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Wearslim</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;235 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;Grip Strength Trainer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Tension Level</th>\r\n			<td>&lrm;22-220lbs(10-100kg)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;17L x 13W Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Shape</th>\r\n			<td>&lrm;Cylinder</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Wearslim, Iorder Enterprises Private Limited, Delhi, India, 8920559548. E-mail :- support@galacy.in</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Wearslim</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;W_Hand_Grip_Counter_2306_03</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0CVJTTHWF</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Wearslim, Iorder Enterprises Private Limited, Delhi, India, 8920559548. E-mail :- support@galacy.in</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Iorder Enterprises Private Limited, Delhi, India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Iorder Enterprises Private Limited, Delhi, India, 8920559548. E-mail :- support@galacy.in</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>235 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1.00 count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>&lrm;Hand Grip With Counter (10 to 100Kg)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#434 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#13 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404718031/ref=pd_zg_hrsr_sports\">Strength Training Grip Strengtheners</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 15500.00, 15, '30', '', 1, '2025-03-29 08:24:06'),
(31, 'PRO365 Power Hand Gripper with Counter Meter (5KG-100KG) for Muscle Building & Rehabilitation For Men & Women Home Gym Workout', '67e7aeaed0af18.29199052.jpg', '<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Counter Hand Gripper</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Plastic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;PRO365</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;170 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;Counter Hand Gripper</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;17L x 11W Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Zenith Solutions</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item part number</th>\r\n			<td>&lrm;PRO-321 ( Hand Strengthener)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0F1TF32PJ</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Zenith Solutions</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>PRO365, Gurugram</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>170 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>Adjustable hand gripper with counter meter</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#106 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#5 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404718031/ref=pd_zg_hrsr_sports\">Strength Training Grip Strengtheners</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1000.00, 15, '20', '', 1, '2025-03-29 08:26:22'),
(32, 'Zenitrain Adjustable Hand Grip Strengthener with Counter (5-100 Kg) | Power Gripper for Men & Women | Forearm, Finger & Wrist Exercise | Ideal for Gym Workouts, Home Use & Rehabilitation', '67e7af9d5b8ce1.07167836.jpg', '<h2>Product information</h2>\r\n\r\n<h1>Technical Details</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Orange</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Material</th>\r\n			<td>&lrm;Plastic</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Boldfit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;230 Grams</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Style</th>\r\n			<td>&lrm;BlackOrange 120Kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Tension Level</th>\r\n			<td>&lrm;Heavy</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;17L x 13W Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Shape</th>\r\n			<td>&lrm;v-shape</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Boldfit, Boldfit, Bangalore, 560041,support@boldfit.in,08043702806</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Boldfit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;HeavyHandGripper</td>\r\n		</tr>\r\n		<tr>\r\n			<th>ASIN</th>\r\n			<td>&lrm;B0DCGDMFCW</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Additional Information</h1>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>Boldfit, Boldfit, Bangalore, 560041,support@boldfit.in,08043702806</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Packer</th>\r\n			<td>Boldfit, Bangalore, 560041,support@boldfit.in,08043702806</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Importer</th>\r\n			<td>Boldfit, Bangalore, 560041,support@boldfit.in,08043702806</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>230 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Net Quantity</th>\r\n			<td>1 Count</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Generic Name</th>\r\n			<td>HeavyHandGripper</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Best Sellers Rank</th>\r\n			<td>#21 in Sports, Fitness &amp; Outdoors (<a href=\"https://www.amazon.in/gp/bestsellers/sports/ref=pd_zg_ts_sports\">See Top 100 in Sports, Fitness &amp; Outdoors</a>)<br />\r\n			#2 in&nbsp;<a href=\"https://www.amazon.in/gp/bestsellers/sports/3404718031/ref=pd_zg_hrsr_sports\">Strength Training Grip Strengtheners</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1500.00, 15, '10', '', 1, '2025-03-29 08:30:21');

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
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `schedule_day` varchar(100) NOT NULL,
  `schedule_name` varchar(255) DEFAULT NULL,
  `trainer_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule_day`, `schedule_name`, `trainer_id`, `start_time`, `end_time`, `price`, `created_at`) VALUES
(70, 'Monday', 'Yoga', 1, '06:00:00', '07:30:00', '400', '2025-03-06 05:48:17'),
(71, 'Monday', 'Cardio', 3, '08:00:00', '10:00:00', '380', '2025-03-06 06:42:01'),
(72, 'Tuesday', 'Meditation', 5, '05:10:00', '06:15:00', '520', '2025-03-06 06:42:51'),
(73, 'Monday', 'Body Building', 2, '16:00:00', '18:00:00', '350', '2025-03-06 09:40:04'),
(74, 'Monday', 'Running', 6, '18:08:00', '20:15:00', '', '2025-03-06 09:40:34'),
(75, 'Tuesday', 'Zumba', 7, '06:20:00', '07:45:00', '401', '2025-03-06 09:43:22'),
(76, 'Tuesday', 'Dieting Class', 6, '09:15:00', '10:45:00', '250', '2025-03-06 09:48:55'),
(77, 'Wednesday', 'Heavyweight', 2, '08:15:00', '10:15:00', '350', '2025-03-06 09:59:23'),
(78, 'Thursday', 'Strength training for muscular endurance', 3, '09:00:00', '12:15:00', '200', '2025-03-06 10:00:29'),
(79, 'Wednesday', 'Yoga', 3, '11:15:00', '13:00:00', '300', '2025-03-06 10:01:55'),
(80, 'Wednesday', 'Running', 6, '16:00:00', '18:30:00', '601', '2025-03-06 10:02:33'),
(81, 'Thursday', 'Muscular strength', 4, '13:30:00', '15:00:00', '300', '2025-03-06 10:04:54'),
(82, 'Thursday', 'Light heavyweight', 2, '16:10:00', '18:50:00', '280', '2025-03-06 10:05:52'),
(83, 'Friday', 'Meditation', 5, '06:00:00', '07:30:00', '450', '2025-03-06 10:06:31'),
(84, 'Friday', 'Vinyasa Yoga', 1, '07:45:00', '09:30:00', '400', '2025-03-06 10:07:11'),
(85, 'Friday', 'Strength training for muscle power', 3, '09:45:00', '11:00:00', '500', '2025-03-06 10:07:52'),
(86, 'Friday', 'Body Composition', 4, '16:12:00', '18:00:00', '250', '2025-03-06 10:08:39'),
(87, 'Saturday', 'Zumba', 7, '06:30:00', '08:30:00', '250', '2025-03-06 10:09:07'),
(88, 'Saturday', 'Kundalini Yoga', 8, '09:00:00', '11:01:00', '400', '2025-03-06 10:09:53'),
(89, 'Sunday', 'Bodybuilding', 2, '09:10:00', '12:30:00', '500', '2025-03-06 10:12:30'),
(91, 'Sunday', 'workout', 4, '15:30:00', '18:30:00', '400', '2025-03-30 11:16:22');

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
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience` int(11) NOT NULL COMMENT 'Experience in years',
  `gender` enum('male','female','other') NOT NULL,
  `joining_date` date DEFAULT curdate(),
  `working_hours` varchar(50) NOT NULL COMMENT 'e.g. 6AM-10PM',
  `qualification` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `email`, `phone`, `specialization`, `experience`, `gender`, `joining_date`, `working_hours`, `qualification`, `image`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jay Joshikay Kalubhai', 'jay@gmail.ocm', '6589742789', 'Yoga', 3, 'male', '2025-02-28', '6-10', 'hlh060119feacertifiedmad-lo-1-1559629047.jpg', '1.jpg', 10000.00, 'active', '2025-02-28 14:54:12', '2025-02-28 16:20:21'),
(2, 'Rahul Bhardwaj M.', 'rahul123@gmail.com', '6589742309', 'Change Body Shape', 2, 'male', '2025-02-28', '6-9', 'product-jpeg (1).jpg', '2.jpg', 15000.00, 'active', '2025-02-28 16:24:25', '2025-02-28 16:41:59'),
(3, 'Venisharja Shoriya V.', 'shoriya@gmail.com', '9764310258', 'Cardio', 5, 'male', '2025-02-28', '6-5', 'Personal-Fitness-Trainer-Certificate-Template-edit-online.png', 'person_3.jpg', 25000.00, 'active', '2025-02-28 16:27:01', '2025-02-28 16:27:01'),
(4, 'Amiti Patil L.', 'amiti@gmail.com', '1398745620', 'Personal Instroctor', 5, 'female', '2025-02-28', '6-5', 'GGFI-Advanced-Personal-training-certificate-CC.jpg', 'trainer-2.jpg', 29500.00, 'active', '2025-02-28 16:29:34', '2025-02-28 16:34:53'),
(5, 'Vinata Kadam K.', 'vinata@gmail.com', '96320147852', 'Meditation', 5, 'female', '2025-02-28', '6-12', 'vinayak-personal-trainer-level-3-uk-certified-andheri-west-mumbai-personal-gym-trainers-v06zaskg76.jpg', 'trainer-5.jpg', 21000.00, 'active', '2025-02-28 16:32:42', '2025-02-28 16:41:38'),
(6, 'Anamika Varma A.', 'anamika@mail.com', '9874560123', 'Die Specialist ', 6, 'female', '2025-02-28', '6-2', 'QRW.jpg', 'test-2.jpg', 9000.00, 'active', '2025-02-28 16:37:14', '2025-03-28 15:14:59'),
(7, 'Neha Savaliya R.', 'neya@gmail.com', '9123578460', 'Zumba Instructor', 10, 'female', '2025-02-28', '6-4', 'CPT.jpg', 'test-3.jpg', 18500.00, 'active', '2025-02-28 16:40:06', '2025-02-28 16:40:06'),
(8, 'Beka Deniyal J', 'wotor30234@arensus.com', '6589742789', 'Yoga', 5, 'female', '2025-02-28', '6-10', 'images.jpeg', 'trainer-1.jpg', 15000.00, 'active', '2025-02-28 16:43:45', '2025-02-28 16:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `member_id` varchar(100) DEFAULT NULL,
  `full_name` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `Height` int(20) NOT NULL,
  `Weight` int(20) NOT NULL,
  `Age` int(20) NOT NULL,
  `current_plan_id` int(11) DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `trainer_id` int(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `plan_status` int(11) NOT NULL DEFAULT 0,
  `remainder` int(11) NOT NULL DEFAULT 0,
  `join_date` date DEFAULT curdate(),
  `code` text NOT NULL,
  `code_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `createtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'normal_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `member_id`, `full_name`, `name`, `email`, `mobile`, `password`, `gender`, `address`, `image`, `Height`, `Weight`, `Age`, `current_plan_id`, `occupation`, `trainer_id`, `batch`, `payment_status`, `plan_status`, `remainder`, `join_date`, `code`, `code_status`, `createtime`, `role`) VALUES
(31, '6e37116788aa', 'Ayush Mangukiya K.', 'ayush 123', 'xavixir832@envoes.com', '9085647123', '082b17c053274c462139ef53fe270780', 'Male', '84 Krishna Apartment, Surat, Gujarat 395010', '1741227207_person_2.jpg', 56, 60, 21, 10, 'IT Professional ', 0, '', 1, 0, 0, '2025-02-16', '', 0, '2025-03-30 09:48:24', 'member_user'),
(39, 'abb4a0a08f7d', 'Jenish Rambhai Pipaliya', 'jenish123', 'sutax102@gmail.com', '9085647123', 'a1af9d54efd2b16c6c0d2abcd67610e2', 'Male', '485 2nd floor krishna apartment,surat,gujarat .398040', 'hero.png', 56, 60, 22, 10, 'Diamond worker', 0, '', 1, 0, 1, '2025-02-27', '', 0, '2025-03-31 07:02:54', 'member_user'),
(40, '0098472b9f9a', 'Dipak Rameshbhain Shiyal', 'avadh-123', 'bihavow329@bnsteps.com', '9081939675', '831ccd5839331a317a353476d688a2cb', 'male', '12 House Number,In front of Kevat Society, Kargil chowk ,Surat, Gujarat 395010.', 'WhatsApp Image 2025-03-03 at 16.39.05_75938f632.jpg', 56, 60, 21, 13, 'Trader In BSE', 5, '', 1, 1, 0, '2025-03-03', 'e63ebe027a65d1d57fa65c46d1b2f0ca', 0, '2025-03-26 07:43:08', 'member_user'),
(45, '45a4e7837d86', 'Nihal Ukani K.', 'nihal', 'ukaninihal@gmail.com', '9856321401', '831ccd5839331a317a353476d688a2cb', 'Male', '123 Mahadev Society, Varachha, Surat, Gujarat', '1743154505_Screenshot 2025-03-28 150440.png', 0, 0, 0, 11, 'Web Developer', 0, '', 1, 1, 0, '2025-03-13', '27c9a2684568fb76b69ac0dc405945c1', 0, '2025-03-28 15:33:49', 'member_user'),
(46, '729393e0bd07', 'white paguses', 'avadh_150', 'avadhradadiya895@gmail.com', '9085647123', '831ccd5839331a317a353476d688a2cb', 'male', 'rajkot', '1743327714_image (5).jpg', 0, 0, 0, 10, 'IT Professional ', 0, '', 1, 1, 0, '2025-03-28', '05d0c1ed5d7b0baac607e29aed5a8fe0', 0, '2025-03-30 09:44:38', 'member_user'),
(47, NULL, '', 'Het123', 'xereyib470@macho3.com', '', 'df2714cb974f94733631816a4a0a0112', '', '', '1743404096_cooking-4872956_1280.jpg', 0, 0, 0, NULL, '', 0, '', 0, 0, 0, '2025-03-31', 'e618c0aa13e612ad3ce6b11efe8d4568', 0, '2025-03-31 06:57:10', 'normal_user');

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
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`id`),
  ADD KEY `trainer_id` (`id`),
  ADD KEY `appointments_ibfk_1` (`user_id`),
  ADD KEY `appointments_ibfk_2` (`trainer_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `order_id` (`order_id`);

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
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `trainer_id` (`trainer_id`);

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
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gym_blogs`
--
ALTER TABLE `gym_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gym_images`
--
ALTER TABLE `gym_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `member_plans`
--
ALTER TABLE `member_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);

--
-- Constraints for table `member_plans`
--
ALTER TABLE `member_plans`
  ADD CONSTRAINT `member_plans_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`id`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `trainer_id` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
