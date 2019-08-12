-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2019 at 06:28 PM
-- Server version: 5.7.19
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssmediastaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `topic_id`, `user_id`, `stage_id`) VALUES
(3, 8, 5, 2),
(4, 9, 5, 2),
(5, 10, 5, 2),
(8, 10, 8, 3),
(11, 10, 8, 3),
(12, 10, 10, 4),
(13, 11, 5, 2),
(14, 10, 8, 3),
(15, 10, 10, 4),
(16, 12, 12, 2),
(17, 12, 13, 3),
(18, 12, 14, 4),
(19, 0, 5, 2),
(20, 10, 5, 2),
(21, 4, 5, 2),
(22, 16, 12, 2),
(23, 17, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_at` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `is_reserved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`id`, `topic_id`, `submitted_by`, `submitted_at`, `approved`, `is_reserved`) VALUES
(1, 10, 8, 1563320216, 1, 0),
(2, 10, 30, 1563320216, 1, 0),
(3, 12, 13, 1564062672, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `path` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`id`, `name`, `path`, `created_at`) VALUES
(2, '21/07/2019 00:11:25', 'uploads/backups/21/07/2019 00:11:25.zip', 1563667885);

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `created_by`, `created_at`) VALUES
(1, 'Success Secrets TV', 1, 1563418113),
(2, 'Under40 TV', 1, 1563419056),
(3, 'Inspiration Channel', 1, 1563419618),
(5, 'ABC TV', 1, 1563419705),
(6, 'Success Secrets 360', 1, 1564059271);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_from` int(11) NOT NULL,
  `media_type` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Administrator'),
(2, 'Writer', 'Text content creators'),
(3, 'Voice Artist', 'Records audio for written scripts'),
(4, 'Video Editor', 'Edits videos from scripts and voice overs');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `send_to` int(11) NOT NULL,
  `send_from` int(11) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0',
  `send_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `send_to`, `send_from`, `subject`, `body`, `read_status`, `send_at`) VALUES
(1, 5, 1, 'Corrects on your scripts', 'Hello John, Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird\r\n                  on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical\r\n                  master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack\r\n                  gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon\r\n                  asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu\r\n                  blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American\r\n                  Apparel.</p>\r\n\r\n                <p>Raw denim McSweeney\'s bicycle rights, iPhone trust fund quinoa Neutra VHS kale chips vegan PBR&amp;B\r\n                  literally Thundercats +1. Forage tilde four dollar toast, banjo health goth paleo butcher. Four dollar\r\n                  toast Brooklyn pour-over American Apparel sustainable, lumbersexual listicle gluten-free health goth\r\n                  umami hoodie. Synth Echo Park bicycle rights DIY farm-to-table, retro kogi sriracha dreamcatcher PBR&amp;B\r\n                  flannel hashtag irony Wes Anderson. Lumbersexual Williamsburg Helvetica next level. Cold-pressed\r\n                  slow-carb pop-up normcore Thundercats Portland, cardigan literally meditation lumbersexual crucifix.\r\n                  Wayfarers raw denim paleo Bushwick, keytar Helvetica scenester keffiyeh 8-bit irony mumblecore\r\n                  whatever viral Truffaut.</p>\r\n\r\n                <p>Post-ironic shabby chic VHS, Marfa keytar flannel lomo try-hard keffiyeh cray. Actually fap fanny\r\n                  pack yr artisan trust fund. High Life dreamcatcher church-key gentrify. Tumblr stumptown four dollar\r\n                  toast vinyl, cold-pressed try-hard blog authentic keffiyeh Helvetica lo-fi tilde Intelligentsia. Lomo\r\n                  locavore salvia bespoke, twee fixie paleo cliche brunch Schlitz blog McSweeney\'s messenger bag swag\r\n                  slow-carb. Odd Future photo booth pork belly, you probably haven\'t heard of them actually tofu ennui\r\n                  keffiyeh lo-fi Truffaut health goth. Narwhal sustainable retro disrupt.</p>\r\n\r\n                <p>Skateboard artisan letterpress before they sold out High Life messenger bag. Bitters chambray\r\n                  leggings listicle, drinking vinegar chillwave synth. Fanny pack hoodie American Apparel twee. American\r\n                  Apparel PBR listicle, salvia aesthetic occupy sustainable Neutra kogi. Organic synth Tumblr viral\r\n                  plaid, shabby chic single-origin coffee Etsy 3 wolf moon slow-carb Schlitz roof party tousled squid\r\n                  vinyl. Readymade next level literally trust fund. Distillery master cleanse migas, Vice sriracha\r\n                  flannel chambray chia cronut.</p>\r\n\r\n                <p>Thanks,<br>Jane</p>', 1, 1562945496),
(2, 1, 5, 'Subject here', '<p>Simple message</p>', 1, 1562978213),
(3, 5, 5, 'Test Message', '<h1><u>A few Test Message right here</u></h1>', 1, 1562985763),
(4, 0, 5, 'Done Recording Audio', '<p>I have recorded my audio should i forward to editor?</p>', 0, 1563238204);

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE `message_thread` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `send_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20190701195104);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `send_to` int(11) NOT NULL,
  `body` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `send_to`, `body`, `read_status`, `created_at`) VALUES
(1, 5, 'You have been assigned a new topic to write a script on by Admin/CEO.', 1, 1562945496),
(2, 1, 'submitted a script for review', 1, 1563197027),
(3, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 1, 1563237113),
(4, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563296210),
(5, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563296293),
(6, 8, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563296294),
(7, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563312924),
(8, 8, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563312924),
(9, 1, 'samuel submitted an <strong>audio</strong> for for your review, approval or decline.', 1, 1563320216),
(10, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563324913),
(11, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563324917),
(12, 9, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563324918),
(13, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563330104),
(14, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563330137),
(15, 8, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563330138),
(16, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563330159),
(17, 8, 'Response from Admin. Check to see admin\'s response to the audio you submitted.', 1, 1563330635),
(18, 5, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 0, 1563330697),
(19, 8, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563330697),
(20, 8, 'Response from Admin. Check to see admin\'s response to the audio you submitted.', 1, 1563330723),
(21, 10, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1563330724),
(22, 1, 'olayinka submitted a <strong>video </strong> for for your review, approval or decline.', 1, 1563332762),
(23, 10, 'Response from Admin. Check to see admin\'s response to the video you submitted.', 0, 1563425629),
(24, 5, 'You have been assigned a new topic to write a script on by Admin/CEO.', 0, 1563426854),
(25, 8, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 0, 1563432047),
(26, 10, 'You have been assigned a new voice-over by Admin. Use it to create voice-over.', 0, 1563432371),
(27, 12, 'You have been assigned a new topic to write a script on by Admin/CEO.', 1, 1564060231),
(28, 1, 'writer1 submitted a <strong>script</strong> for your review, approval or decline.', 1, 1564061090),
(29, 12, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 1, 1564062260),
(30, 13, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 1, 1564062577),
(31, 1, 'artist2 submitted an <strong>audio</strong> for for your review, approval or decline.', 1, 1564062673),
(32, 13, 'Response from Admin. Check to see admin\'s response to the audio you submitted.', 0, 1564062795),
(33, 14, 'You have been assigned a new voice-over by Admin. Use it to create voice-over.', 0, 1564062859),
(34, 1, 'editor3 submitted a <strong>video </strong> for for your review, approval or decline.', 1, 1564062912),
(35, 14, 'Response from Admin. Check to see admin\'s response to the video you submitted.', 0, 1564063043),
(36, 5, 'You have been assigned a new script by Admin. You are to create voice-over for it.', 0, 1564872409),
(37, 5, 'You have been assigned a new topic to write a script on by Admin/CEO.', 0, 1564876551),
(38, 5, 'You have been assigned a new topic to write a script on by Admin/CEO.', 0, 1564876655),
(39, 12, 'You have been assigned a new topic to write a script on by Admin/CEO.', 1, 1565310720),
(40, 12, 'You have been assigned a new topic to write a script on by Admin/CEO.', 1, 1565420718),
(41, 1, 'writer1 submitted a <strong>script</strong> for your review, approval or decline.', 1, 1565422022),
(42, 12, 'Response from Admin. Check to see admin\'s response to the script you submitted.', 1, 1565444914),
(43, 1, 'writer1 submitted a <strong>script</strong> for your review, approval or decline.', 0, 1565450134),
(44, 1, 'writer1 submitted a <strong>script</strong> for your review, approval or decline.', 0, 1565450168);

-- --------------------------------------------------------

--
-- Table structure for table `notifications_templates`
--

CREATE TABLE `notifications_templates` (
  `id` int(11) NOT NULL,
  `user_stage` int(11) NOT NULL,
  `notification_type` varchar(128) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications_templates`
--

INSERT INTO `notifications_templates` (`id`, `user_stage`, `notification_type`, `message`) VALUES
(13, 2, 'new_topic', 'You have been assigned a new topic to write a script on by Admin/CEO.'),
(14, 2, 'script_declined', 'Your script has been declined, kindly check your message box for corrections, guidance or contact Admin/CEO'),
(15, 2, 'script_approved', 'Your script has been approved by Admin/CEO'),
(16, 3, 'new_script', 'You have been assigned a new script by Admin. You are to create voice-over for it.'),
(17, 3, 'audio_declined', 'Your voice-over has been declined, kindly check your message box for corrections, guidance or contact Admin.'),
(18, 3, 'audio_approved', 'Your voice-over has been approved by Admin.'),
(19, 4, 'new_audio', 'You have been assigned a new voice-over by Admin. Use it to create voice-over.'),
(20, 4, 'video_declined', 'Your video-edit has been declined, kindly check your message box for corrections, guidance or contact Admin.'),
(21, 4, 'video_approved', 'Your video-edit has been approved by Admin'),
(22, 5, 'script_submitted', 'submitted a <strong>script</strong> for your review, approval or decline.'),
(23, 5, 'audio_submitted', 'submitted an <strong>audio</strong> for for your review, approval or decline.'),
(24, 5, 'video_submitted', 'submitted a <strong>video </strong> for for your review, approval or decline.'),
(25, 2, 'admin_response_script', 'Response from Admin. Check to see admin\'s response to the script you submitted.'),
(26, 3, 'admin_response_audio', 'Response from Admin. Check to see admin\'s response to the audio you submitted.'),
(27, 4, 'admin_response_video', 'Response from Admin. Check to see admin\'s response to the video you submitted.');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rater_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `rater_id`, `rating`, `comment`) VALUES
(1, 13, NULL, 3, NULL),
(2, 9, NULL, 3, NULL),
(3, 9, NULL, 2, NULL),
(4, 9, NULL, 5, NULL),
(5, 5, NULL, 3, NULL),
(6, 14, NULL, 4, NULL),
(7, 10, NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scripts`
--

CREATE TABLE `scripts` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_at` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `is_reserved` int(11) NOT NULL DEFAULT '0',
  `is_edited` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scripts`
--

INSERT INTO `scripts` (`id`, `topic_id`, `submitted_by`, `submitted_at`, `approved`, `is_reserved`, `is_edited`) VALUES
(1, 10, 5, 1563197027, 1, 0, 0),
(2, 12, 12, 1564061090, 1, 0, 0),
(3, 16, 12, 1565422022, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name_prefix` varchar(16) NOT NULL,
  `system_name` varchar(256) NOT NULL DEFAULT 'MediaStaff',
  `header` varchar(256) NOT NULL DEFAULT 'Success Secrets TV',
  `footer` varchar(300) NOT NULL DEFAULT 'Success Secrets Media Staff',
  `tagline` varchar(256) DEFAULT NULL,
  `app_mode` int(11) NOT NULL DEFAULT '1',
  `delete_docs_in` int(11) NOT NULL DEFAULT '30',
  `delete_audios_in` int(11) NOT NULL DEFAULT '30',
  `delete_videos_in` int(11) NOT NULL DEFAULT '30',
  `backup_in` int(11) NOT NULL DEFAULT '30',
  `delete_notifications_in` int(11) NOT NULL DEFAULT '30',
  `software_version` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name_prefix`, `system_name`, `header`, `footer`, `tagline`, `app_mode`, `delete_docs_in`, `delete_audios_in`, `delete_videos_in`, `backup_in`, `delete_notifications_in`, `software_version`) VALUES
(1, 'MediaStaff', 'TV', 'Success Secrets TV', 'Success Secrets Media Staff', 'ABC Media Software', 1, 0, 30, 30, 30, 0, '1.1.0');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`) VALUES
(1, 'Reserve'),
(2, 'Writing'),
(3, 'Voice over'),
(4, 'Video Editing'),
(5, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic` varchar(300) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  `user3_id` int(11) DEFAULT NULL,
  `assigned` int(11) NOT NULL DEFAULT '1',
  `script` text,
  `doc` varchar(300) DEFAULT NULL,
  `audio` varchar(300) DEFAULT NULL,
  `video` varchar(300) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `is_reserved` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `channel_id`, `stage_id`, `user_id`, `user2_id`, `user3_id`, `assigned`, `script`, `doc`, `audio`, `video`, `created_by`, `created_at`, `is_reserved`) VALUES
(1, 'How to build income autopilot', 1, 1, 5, NULL, NULL, 0, '', '', '', '', 5, 1562632752, 1),
(4, '7 Success Secrets of Henry Ford\'s', 1, 2, 5, NULL, NULL, 0, '', '', '', '', 5, 1562635958, 1),
(6, 'The 3 LIES Most People Believe about Money', 1, 2, 1, NULL, NULL, 0, '', '', '', '', 1, 1562858463, 1),
(10, '4 Real Ways to Make Money Online', 1, 1, 5, 8, 10, 0, '', 'uploads/documents/5d2c7e62e54f9.docx', 'uploads/audios/5d2e5f97aa9ec.mp3', 'uploads/videos/5d2e90963b75c.mp4', 5, 1562945496, 1),
(11, 'How to Raise Money Without Banks', 1, 2, 5, NULL, NULL, 1, '', '', '', '', 1, 1563426853, 1),
(12, 'The 3 things you should do before starting a business', 6, 5, 12, 13, 14, 1, '', 'uploads/documents/5d4edfb80ef0d.docx', 'uploads/audios/5d39b3d057b16.mp3', 'uploads/videos/5d39b4c04a272.mp4', 1, 1564060231, 1),
(16, 'This is what the Rich are hiding', 6, 2, 12, NULL, NULL, 1, NULL, 'uploads/documents/5d4e71c646d2a.docx', NULL, NULL, 1, 1565310720, 0),
(17, 'Contagious: why things catch on', 6, 2, 12, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1565420718, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `job_title` varchar(256) DEFAULT NULL,
  `job_describtion` text,
  `employed_on` int(16) DEFAULT NULL,
  `salary` decimal(16,0) NOT NULL,
  `tasks_completed` int(11) NOT NULL DEFAULT '0',
  `dob` varchar(16) NOT NULL,
  `photo` varchar(300) DEFAULT 'uploads/users/noimage.png',
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `usertype` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `on_project` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `job_title`, `job_describtion`, `employed_on`, `salary`, `tasks_completed`, `dob`, `photo`, `company`, `phone`, `usertype`, `channel_id`, `on_project`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$0TIUfRZfr8.3Uqt6V2t3POva9kfjfctJVkjisBks0/pJjk3pF2RQa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1565620060, 1, 'Faith', 'Philemon', NULL, NULL, 1, '0', 7, '01/01/1970', 'uploads/users/5d27d56f416c8.jpg', 'ADMIN', '08100801004', 1, 0, 0),
(5, '127.0.0.1', 'alimuhammed', '$2y$10$lN94pJrnXNZ0lC1GQ7KSsOS/Tv04AR0SlxWrB2wHD0r3vPB5V6LF2', 'ali@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1562455605, 1563246029, 1, 'Muhammed', 'Ali', 'Writer', NULL, 1562867864, '35000', 0, '01/01/1970', 'uploads/users/5d22a4e68f916.jpg', NULL, '08039884476', 2, 1, 1),
(8, '127.0.0.1', 'samuel', '$2y$10$Yiuzu2hLYuaF5SaUEag27utQ26mu9ni.jDB2eCusgcgzay2r9jhEy', 'sam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1563241415, 1564020486, 1, 'Samuel', 'Peters', 'Voice Artist', '', 1, '40000', 0, '01/01/1970', 'uploads/users/5d2d350866abb.jpg', NULL, '', 3, 0, 1),
(9, '127.0.0.1', 'olamide', '$2y$10$OhIQH4cI66/dYAYeI34R0u8K0FG7ZJoYkYI98XiBo6ES/i7u7tQem', 'olamide@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1563295969, 1563430490, 1, 'Olmide', 'Rotimi', 'Voice Artist', '', 1, '25000', 0, '01/01/1970', 'uploads/users/5d2e01a088ae5.jpg', NULL, '09077365524', 3, 0, 1),
(10, '127.0.0.1', 'olayinka', '$2y$10$kpa1pFkNunkXbxcJ2ezoMey0N7M.fvI1q1E2VmM.Ur.EQ.rbRMoSm', 'yinka@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1563325989, 1563432381, 1, 'Olanre', 'Yinka', 'Video Editor', NULL, 1, '40000', 0, '01/01/1970', 'uploads/users/5d2e78d09b7ad.jpg', NULL, '', 4, 2, 0),
(12, '127.0.0.1', 'writer1', '$2y$10$0n8r1HLMWKNE2L7gRGPZK.JiMNB1j3ihPEHfjnkEgbfK924/3s42.', 'writer1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1564059315, 1565620615, 1, 'Writer', 'One', 'Writer', '', 1, '200094', 0, '01/01/1970', 'uploads/users/5d39ad4507d7f.jpg', NULL, '', 2, 6, 1),
(13, '127.0.0.1', 'artist2', '$2y$10$QSwshL4rWia8d9tyWphvWuHEVkjwJJu.hVteK.1Kb1n7JcrcXFxfS', 'artist2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1564059352, 1564363582, 1, NULL, NULL, 'Voice Artist', '', NULL, '3000094', 0, '', 'uploads/users/noimage.png', NULL, NULL, 3, 6, 0),
(14, '127.0.0.1', 'editor3', '$2y$10$opSiCwUg2gNIwiKN52w4Ye9fJ88ChKl4QozDLNB/1PZ1J3XCmXDNW', 'editor3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1564059388, 1564366665, 1, NULL, NULL, 'Video Editor', '', NULL, '30009958', 0, '', 'uploads/users/noimage.png', NULL, NULL, 4, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 5, 2),
(3, 8, 3),
(4, 9, 3),
(5, 10, 4),
(7, 12, 2),
(8, 13, 3),
(9, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_at` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `is_reserved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `topic_id`, `submitted_by`, `submitted_at`, `approved`, `is_reserved`) VALUES
(1, 10, 10, 1563332761, 1, 0),
(2, 12, 14, 1564062912, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_thread`
--
ALTER TABLE `message_thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_templates`
--
ALTER TABLE `notifications_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scripts`
--
ALTER TABLE `scripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_thread`
--
ALTER TABLE `message_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications_templates`
--
ALTER TABLE `notifications_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scripts`
--
ALTER TABLE `scripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
