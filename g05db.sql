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

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
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
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `jobref`, `fname`, `lname`, `dob`, `gender`, `street`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `otherskills`, `status`) VALUES
(1, 'ABC123', 'John', 'Smith', '2000-05-15', 'Male', '10 Example Street', 'Melbourne', 'VIC', '3000', 'john@example.com', '0412345678', 'Event Planning, Community Engagement', 'First Aid', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

INSERT INTO `jobs` (
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



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
