-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2026 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g05db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE IF NOT EXISTS `eoi` (
  `EOInumber` int(11) NOT NULL AUTO_INCREMENT,
  `jobref` char(6) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` char(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` text DEFAULT NULL,
  `otherskills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
PRIMARY KEY (`EOInumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT IGNORE INTO `eoi` (`EOInumber`, `jobref`, `fname`, `lname`, `dob`, `gender`, `street`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `otherskills`, `status`) VALUES
(1, 'ABC123', 'John', 'Smith', '2000-05-15', 'Male', '10 Example Street', 'Melbourne', 'VIC', '3000', 'john@example.com', '0412345678', 'Event Planning, Community Engagement', 'First Aid', 'New'),

(2, 'MARIO1', 'Mario', 'Mario', '1981-09-13', 'Male',
 '1 Mushroom Road', 'Mushroom Kingdom', 'VIC', '3000',
 'mario@example.com', '0400000001',
 'Plumbing, Jumping', 'Kart Racing', 'New'),

(3, 'MARIO2', 'Luigi', 'Mario', '1983-07-14', 'Male',
 '2 Mushroom Road', 'Mushroom Kingdom', 'VIC', '3000',
 'luigi@example.com', '0400000002',
 'Plumbing, Ghost Hunting', 'High Jumping', 'Current'),

(4, 'MARIO1', 'Peach', 'Toadstool', '1985-04-20', 'Female',
 '1 Castle Lane', 'Mushroom Kingdom', 'VIC', '3000',
 'peach@example.com', '0400000003',
 'Leadership, Diplomacy', 'Floating', 'Final'),

(5, 'MARIO2', 'Bowser', 'Koopa', '1978-02-05', 'Male',
 '1 Lava Castle', 'Koopa Kingdom', 'VIC', '3000',
 'bowser@example.com', '0400000004',
 'Leadership, Fire Breathing', 'Castle Management', 'New');
--
-- Indexes for dumped tables
--

--
-- -- Indexes for table `eoi`
-- --
-- ALTER TABLE `eoi`
--   ADD PRIMARY KEY (`EOInumber`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `eoi`
-- --
-- ALTER TABLE `eoi`
--   MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- --------------------------------------------------------
-- jobs table (part 5)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `jobs` (
    `job_id` INT NOT NULL AUTO_INCREMENT,
    `job_ref` CHAR(6) NOT NULL,
    `job_title` VARCHAR(100) NOT NULL,
    `salary` VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    `reporting_line` VARCHAR(150) NOT NULL,
    `responsibilities` TEXT NOT NULL,
    `essential_requirements` TEXT NOT NULL,
    `preferred_skills` TEXT NOT NULL,
    PRIMARY KEY (`job_id`),
    UNIQUE KEY `job_ref` (`job_ref`)
);

-- --------------------------------------------------------
-- Sample data for table `jobs`
-- --------------------------------------------------------

INSERT IGNORE INTO `jobs` (
    `job_ref`,
    `job_title`,
    `salary`,
    `description`,
    `reporting_line`,
    `responsibilities`,
    `essential_requirements`,
    `preferred_skills`
) VALUES
(
    'SCM482',
    'Social Media Manager',
    '$75,000 - $90,000 per year',
    'Manage the organisation''s online presence and promote environmental conservation projects, community campaigns, educational resources and volunteer opportunities.',
    'Communications and Marketing Manager',
    'Develop and manage social media content.\nCreate engaging posts, videos and graphics.\nManage the social media calendar.\nMonitor audience engagement.\nPromote volunteer opportunities and fundraising campaigns.\nTrack social media performance.\nWork with conservation staff.',
    'Relevant marketing or communications qualification or experience.\nExperience managing professional social media accounts.\nStrong communication skills.\nKnowledge of social media platforms.\nAbility to work independently and meet deadlines.\nInterest in environmental conservation.',
    'Experience in a not-for-profit organisation.\nPhotography, video editing or graphic design.\nKnowledge of social media analytics.\nExperience promoting fundraising campaigns.'
),
(
    'SUE719',
    'Sustainability Educator',
    '$70,000 - $85,000 per year',
    'Develop and deliver educational programs that help schools, community groups and the public understand sustainability and environmental protection.',
    'Education and Community Programs Manager',
    'Develop educational workshops.\nDeliver presentations to schools and community groups.\nTeach recycling, biodiversity and climate change.\nOrganise environmental awareness events.\nCreate educational materials.\nWork with teachers and conservation staff.\nEvaluate educational programs.',
    'Relevant environmental education or teaching qualification or experience.\nKnowledge of sustainability principles.\nExcellent presentation skills.\nAbility to explain environmental topics clearly.\nStrong organisational skills.\nAbility to work with schools and community groups.',
    'Teaching experience.\nExperience developing educational resources.\nKnowledge of Australian ecosystems.\nFirst aid certification.\nExperience working with children or community groups.'
),
(
    'VOC365',
    'Volunteer Opportunities Coordinator',
    '$65,000 - $78,000 per year',
    'Recruit, support and coordinate volunteers involved in conservation projects, community campaigns, environmental events and fundraising activities.',
    'Volunteer and Community Engagement Manager',
    'Recruit new volunteers.\nCoordinate volunteer opportunities.\nMaintain volunteer records and schedules.\nOrganise induction and training.\nCommunicate with volunteers.\nSupport conservation events.\nRecognise volunteer contributions.\nCollect feedback and improve programs.',
    'Experience in volunteer coordination or community engagement.\nExcellent interpersonal skills.\nStrong organisational and scheduling abilities.\nAbility to work with diverse people.\nGood computer and administrative skills.\nInterest in environmental conservation.',
    'Experience with environmental organisations.\nExperience coordinating community events.\nKnowledge of workplace health and safety.\nExperience with volunteer databases.\nFirst aid certification.'
);

-- --------------------------------------------------------
-- Users table (Task 6 - HR Management)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
);

-- Default administrator account (admin/admin).
-- Password is securely hashed using PHP password_hash().

INSERT IGNORE INTO `users` (`username`, `password_hash`) VALUES
('admin', '$2y$10$R9Z5g.jhv5yMnrC4EHdLHe9HAXSnzXdKTj72N/duTEvHeA8q40eme');


-- --------------------------------------------------------
-- Team contributions (Task 7)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `team_contributions` (
    `contribution_id` INT NOT NULL AUTO_INCREMENT,
    `member_name` VARCHAR(100) NOT NULL,
    `project_number` INT NOT NULL,
    `contribution_details` TEXT NOT NULL,
    PRIMARY KEY (`contribution_id`)
);

-- --------------------------------------------------------
-- Project 1/2 contributions
-- --------------------------------------------------------

INSERT IGNORE INTO `team_contributions` (
    `contribution_id`,
    `member_name`,
    `project_number`,
    `contribution_details`
) VALUES
(
    1,
    'Eddy Lemos',
    1,
    'Homepage, About Us HTML and CSS; header and footer HTML and CSS; Jira, GitHub repository, README and GitHub Pages setup; homepage images and background styling.'
),
(
    2,
    'Alisha Khokhar',
    1,
    'Created apply.php with the application form, required fields, validation patterns and fieldsets; fixed HTML structure; styled the form with Flexbox; resolved a Git merge conflict in styles.css.'
),
(
    3,
    'Cameron Yardy',
    1,
    'Created the jobs page and applied site-wide CSS themes and page-specific CSS.'
),
(
    4,
    'Eddy Lemos',
    2,
    'Created EOI and users database tables, login.php for admin authentication, and manage.php for searching, sorting, deleting and updating EOI records, with sessions restricting access to authorised users. Used AI to create an admin account setup script that generates and stores a hashed password and security features in manage.php.'
),
(
    5,
    'Alisha Khokhar',
    2,
    'Task 1: converted the pages to PHP and built the shared header.inc, nav.inc and footer.inc includes so every page uses one copy of the header, menu and footer. Task 4: built process_eoi.php, which validates and sanitises the application form on the server, checks the job reference against the jobs table, saves valid applications to the eoi table with a prepared statement and shows the EOI number. Also added small-screen and keyboard-focus styling for the application form.'
),
(
    6,
    'Cameron Yardy',
    2,
    'Created Settings.php, Created a dynamic jobs that retireves from the databse, configured the about.php file to make the contributions table dynamic and retrieve data from the database. Fixed mistakes from Part 1.'
);


-- --------------------------------------------------------
-- Team quotes (Task 7)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `team_quotes` (
    `quote_id` INT NOT NULL AUTO_INCREMENT,
    `member_name` VARCHAR(100) NOT NULL,
    `language` VARCHAR(50) NOT NULL,
    `quote_text` TEXT NOT NULL,
    `english_translation` TEXT NOT NULL,
    PRIMARY KEY (`quote_id`)
);

-- --------------------------------------------------------
-- Favourite non-English quotes
-- --------------------------------------------------------

INSERT IGNORE INTO `team_quotes` (
    `quote_id`,
    `member_name`,
    `language`,
    `quote_text`,
    `english_translation`
) VALUES
(
    1,
    'Eddy Lemos',
    'Roman',
    'Dum spiro spero',
    'While I breathe I hope'
),
(
    2,
    'Alisha Khokhar',
    'French',
    'L''esprit est toujours la dupe du cœur',
    'The intellect is always the fool of the heart'
),
(
    3,
    'Cam Yardy',
    'Irish',
    'Is fearr Gaeilge briste, ná Béarla clíste',
    'Better broken Irish than clever English'
);


-- --------------------------------------------------------
-- Team fun facts (Task 7)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `team_fun_facts` (
    `fact_id` INT NOT NULL AUTO_INCREMENT,
    `member_name` VARCHAR(100) NOT NULL,
    `fact_details` TEXT NOT NULL,
    PRIMARY KEY (`fact_id`)
);

-- --------------------------------------------------------
-- Fun facts about the team
-- --------------------------------------------------------

INSERT IGNORE INTO `team_fun_facts` (
    `fact_id`,
    `member_name`,
    `fact_details`
) VALUES
(
    1,
    'Eddy Lemos',
    'I have been playing guitar for 15 years'
),
(
    2,
    'Eddy Lemos',
    'I am a Japanese speaker and lived there for 3 years'
),
(
    3,
    'Eddy Lemos',
    'Canadian but moved to Aus at 18'
),
(
    4,
    'Eddy Lemos',
    'I also like cooking and weightlifting'
),
(
    5,
    'Eddy Lemos',
    'Favourite authors: Jules Verne, Yukio Mishima'
),
(
    6,
    'Eddy Lemos',
    'Favourite games: Halo, Bioshock, Portal'
),
(
    7,
    'Alisha Khokhar',
    'I love playing games, and my favourite game or game series is Resident Evil'
),
(
    8,
    'Cam Yardy',
    'Before going to Swinburne I did a gap year working the snow season at Mt Hotham'
);




COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
