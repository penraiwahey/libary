-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 06:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `br`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowreturn_dtl`
--

CREATE TABLE `borrowreturn_dtl` (
  `id` int(11) NOT NULL,
  `hdr` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL COMMENT 'เบิก / ยืม / คืน สินค้าอะไร',
  `qty` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'เบิก / ยืม / คืน',
  `date` datetime DEFAULT NULL COMMENT 'วันที่ เบิก / ยืม ',
  `borrow` varchar(20) DEFAULT NULL COMMENT 'ต้องคืน / ไม่ต้องคืน',
  `remain` int(11) DEFAULT NULL COMMENT 'คงเหลือที่ต้องคืน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowreturn_dtl`
--

INSERT INTO `borrowreturn_dtl` (`id`, `hdr`, `user`, `item`, `qty`, `status`, `date`, `borrow`, `remain`) VALUES
(283, 81, 1, 20, 3, '2', '2021-11-22 23:20:52', 'true', 0),
(284, 81, 1, 19, 2, '2', '2021-11-22 23:20:52', 'true', 0),
(285, 82, 1, 17, 3, '2', '2021-11-22 23:21:44', 'true', 0),
(286, 82, 1, 16, 2, '2', '2021-11-22 23:21:44', 'true', 0),
(287, 83, 1, 20, 3, '2', '2021-11-22 23:24:17', 'true', 3),
(288, 83, 1, 14, 2, '2', '2021-11-22 23:24:17', 'true', 2),
(289, 83, 1, 19, 2, '2', '2021-11-22 23:24:17', 'true', 2),
(290, 84, 1, 20, 3, '2', '2021-11-22 23:52:02', 'true', 1),
(291, 84, 1, 17, 1, '2', '2021-11-22 23:52:02', 'true', 1),
(292, 84, 1, 16, 2, '2', '2021-11-22 23:52:02', 'true', 0),
(293, 85, 1, 20, 6, '2', '2021-11-22 23:59:30', 'true', 3),
(294, 85, 1, 19, 3, '2', '2021-11-22 23:59:30', 'true', 2);

-- --------------------------------------------------------

--
-- Table structure for table `borrowreturn_hdr`
--

CREATE TABLE `borrowreturn_hdr` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `y` varchar(2) DEFAULT NULL,
  `m` varchar(2) DEFAULT NULL,
  `running` varchar(3) DEFAULT NULL,
  `docno` varchar(7) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'เบิก / ยืม / คืน',
  `date` datetime DEFAULT NULL,
  `action_by` int(11) DEFAULT NULL COMMENT 'คนที่อนุมัติ',
  `action_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `returned_by` int(11) DEFAULT NULL,
  `returned_date` datetime DEFAULT NULL COMMENT 'วันที่คืน',
  `exp_date` datetime DEFAULT NULL,
  `fine` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowreturn_hdr`
--

INSERT INTO `borrowreturn_hdr` (`id`, `user`, `y`, `m`, `running`, `docno`, `status`, `date`, `action_by`, `action_date`, `returned_by`, `returned_date`, `exp_date`, `fine`) VALUES
(81, 1, '64', '11', '002', '6411002', 'รับคืน', '2021-11-22 23:20:52', NULL, NULL, 1, '2021-11-22 23:23:46', '2021-12-06 23:20:52', 0),
(82, 1, '64', '11', '003', '6411003', 'รับคืน', '2021-11-22 23:21:44', NULL, NULL, 1, '2021-11-22 23:24:01', '2021-12-06 23:21:44', 0),
(83, 1, '64', '11', '004', '6411004', 'รับคืน', '2021-11-22 23:24:17', NULL, NULL, 1, '2021-11-22 23:51:40', '2021-12-06 23:24:17', 0),
(84, 1, '64', '11', '005', '6411005', 'รับคืน', '2021-11-22 23:52:02', NULL, NULL, 1, '2021-11-22 23:57:47', '2021-12-06 23:52:02', 0),
(85, 1, '64', '11', '006', '6411006', 'รับคืน', '2021-11-22 23:59:30', NULL, NULL, 1, '2021-11-23 00:05:14', '2021-12-06 23:59:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `id` int(11) NOT NULL,
  `fine` double DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`id`, `fine`, `remark`) VALUES
(1, 20, 'ค่าปรับ'),
(2, 14, 'หลังกี่วันถึงเสียค่าปรับ');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `item_qty` int(11) NOT NULL,
  `use_qty` int(11) NOT NULL,
  `lend_qty` int(11) NOT NULL,
  `pending_qty` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `img`, `item_id`, `item_name`, `price`, `item_qty`, `use_qty`, `lend_qty`, `pending_qty`, `total_qty`) VALUES
(14, '16334558780079.png', 'Iw3IFtbYSL', 'lBKIupc1Rq', 66254, 5, 0, 0, 0, 5),
(15, '16334551846991.png', 'cKKcyQQUNc', 'n0sBMS9F0L', 1234, 10, 0, 0, 0, 10),
(16, 'no.jpg', 'lfNEyvDezS', 'qvpjHzrpOi', 468427, 15, 0, 0, 0, 15),
(17, 'no.jpg', 'qO9vze2Qhe', '6b6Cju70nA', 927223, 20, 0, 0, 0, 20),
(19, 'no.jpg', 'Y3An8EOk3C', 'RF2BH4peSS', 486505, 25, 0, 0, 0, 25),
(20, 'no.jpg', 'ByOU8ms8MR', 'PDPt71WMAA', 458520, 30, 0, 0, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `id` int(11) NOT NULL,
  `line` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `line`
--

INSERT INTO `line` (`id`, `line`) VALUES
(1, 'OarU6FA0in7HId7W5wummFRcIt6cYU6eBGDTqbwhc50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emp_id` varchar(20) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `line` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `dont_delete` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `emp_id`, `emp_name`, `line`, `role`, `department`, `position`, `dont_delete`) VALUES
(11, 'aa', '$2y$10$JXahHh7etMEPnPa/dhba5OTHPS.w6QUztQibdr4hlMn2mkHl0M5S.', '002', 'mmmm', 'OarU6FA0in7HId7W5wummFRcIt6cYU6eBGDTqbwhc50', 'ผู้ดูแล', 'aa', 'aaa', ''),
(1, 'admin', '$2y$10$JXahHh7etMEPnPa/dhba5OTHPS.w6QUztQibdr4hlMn2mkHl0M5S.', '0001', 'This is a Admin', 'OarU6FA0in7HId7W5wummFRcIt6cYU6eBGDTqbwhc50', 'ผู้ดูแล', 'Manager', 'Admin', 'Yes'),
(13, 'mmm', '$2y$10$kRHtZAIyEIjHq9CrGgRrxuzDRPiIaRXHM4Zj52Yb2imtQiR3.nqkG', 'mmm', 'mmm', '', 'ผู้ใช้งาน', 'mmm', 'mmm', ''),
(12, 'qqq', '$2y$10$S8mElQREANO8GNUmNO2Ce.On3WOf9rUgU1QEFE3YkQxJb7VbnrLjm', 't9r3qZnLoo', 'yXMwgdKZcS', '', 'ผู้ใช้งาน', '1eghertheth', 'f2OCdmwXA7', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_borrowreturn_dtl`
-- (See below for the actual view)
--
CREATE TABLE `view_borrowreturn_dtl` (
`id` int(11)
,`hdr` int(11)
,`user` int(11)
,`item` int(11)
,`qty` int(11)
,`remain` int(11)
,`status` varchar(10)
,`date` datetime
,`borrow` varchar(20)
,`emp_name` varchar(255)
,`item_id` varchar(50)
,`item_name` varchar(255)
,`img` varchar(255)
,`status_hdr` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_borrowreturn_hdr`
-- (See below for the actual view)
--
CREATE TABLE `view_borrowreturn_hdr` (
`id` int(11)
,`user` int(11)
,`y` varchar(2)
,`m` varchar(2)
,`running` varchar(3)
,`docno` varchar(7)
,`status` varchar(10)
,`date` datetime
,`action_by` int(11)
,`action_date` datetime
,`returned_by` int(11)
,`returned_date` datetime
,`by_name` varchar(255)
,`action_by_name` varchar(255)
,`return_name` varchar(255)
,`exp_date` datetime
,`fine` double
);

-- --------------------------------------------------------

--
-- Structure for view `view_borrowreturn_dtl`
--
DROP TABLE IF EXISTS `view_borrowreturn_dtl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_borrowreturn_dtl`  AS SELECT `a`.`id` AS `id`, `a`.`hdr` AS `hdr`, `a`.`user` AS `user`, `a`.`item` AS `item`, `a`.`qty` AS `qty`, `a`.`remain` AS `remain`, `a`.`status` AS `status`, `a`.`date` AS `date`, `a`.`borrow` AS `borrow`, `b`.`emp_name` AS `emp_name`, `c`.`item_id` AS `item_id`, `c`.`item_name` AS `item_name`, `c`.`img` AS `img`, `d`.`status` AS `status_hdr` FROM (((`borrowreturn_dtl` `a` left join `user` `b` on(`b`.`id` = `a`.`user`)) left join `item` `c` on(`c`.`id` = `a`.`item`)) left join `borrowreturn_hdr` `d` on(`d`.`id` = `a`.`hdr`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_borrowreturn_hdr`
--
DROP TABLE IF EXISTS `view_borrowreturn_hdr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_borrowreturn_hdr`  AS SELECT `a`.`id` AS `id`, `a`.`user` AS `user`, `a`.`y` AS `y`, `a`.`m` AS `m`, `a`.`running` AS `running`, `a`.`docno` AS `docno`, `a`.`status` AS `status`, `a`.`date` AS `date`, `a`.`action_by` AS `action_by`, `a`.`action_date` AS `action_date`, `a`.`returned_by` AS `returned_by`, `a`.`returned_date` AS `returned_date`, `b`.`emp_name` AS `by_name`, `c`.`emp_name` AS `action_by_name`, `d`.`emp_name` AS `return_name`, `a`.`exp_date` AS `exp_date`, `a`.`fine` AS `fine` FROM (((`borrowreturn_hdr` `a` left join `user` `b` on(`b`.`id` = `a`.`user`)) left join `user` `c` on(`c`.`id` = `a`.`action_by`)) left join `user` `d` on(`d`.`id` = `a`.`returned_by`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowreturn_dtl`
--
ALTER TABLE `borrowreturn_dtl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_borrowreturn_dtl_user` (`user`),
  ADD KEY `FK_borrowreturn_dtl_item` (`item`);

--
-- Indexes for table `borrowreturn_hdr`
--
ALTER TABLE `borrowreturn_hdr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_borrowreturn_hdr_user` (`user`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowreturn_dtl`
--
ALTER TABLE `borrowreturn_dtl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `borrowreturn_hdr`
--
ALTER TABLE `borrowreturn_hdr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `line`
--
ALTER TABLE `line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowreturn_dtl`
--
ALTER TABLE `borrowreturn_dtl`
  ADD CONSTRAINT `FK_borrowreturn_dtl_item` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_borrowreturn_dtl_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `borrowreturn_hdr`
--
ALTER TABLE `borrowreturn_hdr`
  ADD CONSTRAINT `FK_borrowreturn_hdr_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
