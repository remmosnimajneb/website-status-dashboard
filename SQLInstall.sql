--/********************************
--* Project: Website Status Checker
--* Code Version: 1.0
--* Author: Benjamin Sommer
--* GitHub: https://github.com/remmosnimajneb
--* Theme Design by: Pixelarity [Pixelarity.com] - Theme `Transit`
--* Licensing Information: pixelarity.com/license
--***************************************************************************************/

--
-- Database: `webstatus`
--
CREATE DATABASE IF NOT EXISTS `webstatus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webstatus`;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `WebsiteID` int(9) NOT NULL,
  `domain` varchar(120) NOT NULL,
  `lastSeen` varchar(120) NOT NULL,
  `lastError` varchar(120) NOT NULL,
  `lastStatus` varchar(120) NOT NULL,
  `emailSent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`WebsiteID`, `domain`, `lastSeen`, `lastError`, `lastStatus`, `emailSent`) VALUES
(1, 'google.com', 'Not Checked Yet', 'Not Checked Yet', 'Not Checked Yet', 'false'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`WebsiteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `WebsiteID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
