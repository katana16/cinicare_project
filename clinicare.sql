-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 12:42 AM
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
-- Database: `clinicare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `email`, `password`, `address`, `mobile`, `birthdate`, `gender`, `photo_path`) VALUES
(1, 'Mehdi', 'Boufetima', 'mido23dz@gmail.com', '12345', 'City uv28', '0795013800', '1995-05-18', 'Male', '');

-- --------------------------------------------------------

--
-- Table structure for table `analysts`
--

CREATE TABLE `analysts` (
  `analystid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `analysts`
--

INSERT INTO `analysts` (`analystid`, `firstname`, `lastname`, `email`, `password`, `speciality`, `startdate`, `address`, `state`, `mobile`, `birthdate`, `gender`, `bloodgroup`, `photo_path`) VALUES
(1, 'Oussama', 'Boufetima', 'bio@gmail.com', '12345', 'Biologist', '2009-05-09', 'City annaba', 'Annaba', '0785214698', '1989-05-01', 'Male', 'A+', 'uploads/Analyst (1).jpg'),
(2, 'Amel', 'Beskeri', 'radio@gmail.com', '12345', 'Radiologist', '2005-05-03', 'City annaba', 'Annaba', '0698541235', '1987-05-17', 'Female', 'B+', 'uploads/Analyst (4).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentid` int(11) NOT NULL,
  `patientid` int(11) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT NULL,
  `appointmentdate` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentid`, `patientid`, `doctorid`, `turn`, `appointmentdate`, `status`, `comments`) VALUES
(7, 1, 6, 1, '2024-05-28', 'Pending', ''),
(8, 2, 6, 2, '2024-05-28', 'Completed', ''),
(9, 5, 6, 3, '2024-05-28', 'Rejected', ''),
(10, 5, 5, 1, '2024-05-28', 'Rejected', ''),
(11, 6, 6, 4, '2024-05-28', 'Accepted', ''),
(12, 6, 5, 2, '2024-05-28', 'Accepted', ''),
(13, 7, 6, 5, '2024-05-28', 'Accepted', ''),
(14, 7, 5, 3, '2024-05-28', 'Accepted', ''),
(15, 8, 6, 6, '2024-05-28', 'Completed', ''),
(16, 8, 5, 1, '2024-06-02', 'Pending', ''),
(17, 1, 5, 4, '2024-05-28', 'Accepted', ''),
(18, 7, 6, 1, '2024-06-04', 'Pending', ''),
(19, 7, 6, 1, '2024-06-03', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctorid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `workdays` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctorid`, `firstname`, `lastname`, `email`, `password`, `speciality`, `startdate`, `workdays`, `address`, `state`, `mobile`, `birthdate`, `gender`, `bloodgroup`, `photo_path`) VALUES
(1, 'Linda', 'Djendi', 'doc1@gmail.com', '12345', 'Gynecologist', '2020-05-09', 'Sun, Mon, Wed', 'City annaba', 'Annaba', '0632548981', '1990-04-26', 'Female', 'B+', 'uploads/Doctor (12).jpg'),
(2, 'Nazim', 'Hemissi', 'doc2@gmail.com', '12345', 'Cardiologist', '2020-05-08', 'Sun, Mon, Thu', 'City annaba', 'Annaba', '0798521245', '1991-04-30', 'Male', 'A+', 'uploads/Doctor (16).jpg'),
(3, 'Sana', 'Lalam', 'doc3@gmail.com', '12345', 'Dermatologist', '2012-05-10', 'Sun, Mon, Wed', 'city osas', 'Annaba', '0565124578', '1995-05-02', 'Female', 'A+', 'uploads/Doctor (2).jpg'),
(4, 'Yasmine', 'Zouai', 'doc4@gmail.com', '12345', 'Endocrinologist', '2014-05-02', 'Sun, Mon, Thu', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1996-05-03', 'Female', 'AB+', 'uploads/Doctor (3).jpg'),
(5, 'Saad', 'Djerrar', 'doc5@gmail.com', '12345', 'Gastroenterologist', '2001-05-24', 'Sun, Tue, Thu', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1990-05-04', 'Male', 'AB-', 'uploads/Doctor (7).jpg'),
(6, 'Kamel', 'Ghersi', 'doc6@gmail.com', '12345', 'Neurologist', '1999-05-11', 'Sun, Mon, Tue', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1980-05-10', 'Male', 'A+', 'uploads/Doctor (10).jpg'),
(7, 'Hayat', 'Aichaoui', 'doc7@gmail.com', '12345', 'Oncologist', '2005-05-10', 'Sun, Mon, Sat', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1985-05-10', 'Female', 'A+', 'uploads/Doctor (11).jpg'),
(8, 'Abdelhafid', 'Mekhzoumi ', 'doc8@gmail.com', '12345', 'Ophthalmologist', '2015-05-03', 'Wed, Thu', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1998-05-10', 'Male', 'A+', 'uploads/Doctor (21).jpg'),
(9, 'Lila', 'Belarbi', 'doc9@gmail.com', '12345', 'Pediatrician', '2012-05-03', 'Mon, Thu', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1989-05-04', 'Female', 'A+', 'uploads/Doctor (23).jpg'),
(10, 'Yahia', 'Abdelkader', 'doc10@gmail.com', '12345', 'Psychiatrist', '2015-05-03', 'Sun, Wed', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1990-05-11', 'Male', 'AB+', 'uploads/Doctor (22).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecords`
--

CREATE TABLE `medicalrecords` (
  `recordid` int(11) NOT NULL,
  `patientid` int(11) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `recorddate` date DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicalrecords`
--

INSERT INTO `medicalrecords` (`recordid`, `patientid`, `doctorid`, `recorddate`, `observation`, `description`, `diagnosis`) VALUES
(1, 2, 2, '2024-05-27', NULL, NULL, NULL),
(2, 8, 6, '2024-05-28', NULL, NULL, NULL),
(3, 1, 6, '2024-05-28', NULL, NULL, NULL),
(4, 2, 6, '2024-05-28', '<p><strong>History of Present Illness:</strong> John Doe, a 49-year-old male, presents with a history of persistent chest pain for the past 3 weeks. The pain is described as a pressure-like sensation located in the mid-sternal area, radiating to the left arm and jaw. The pain is exacerbated by physical activity and relieved by rest. He rates the pain at 7/10 in intensity. There are no associated symptoms such as nausea, vomiting, or diaphoresis. The patient denies any recent trauma or injury to the chest area.</p>\r\n\r\n<p><strong>Past Medical History:</strong></p>\r\n\r\n<ul>\r\n	<li>Hypertension, diagnosed 10 years ago.</li>\r\n	<li>Type 2 Diabetes Mellitus, diagnosed 5 years ago.</li>\r\n	<li>Hyperlipidemia, diagnosed 3 years ago.</li>\r\n	<li>Appendectomy at age 25.</li>\r\n</ul>\r\n\r\n<p><strong>Past Surgical History:</strong></p>\r\n\r\n<ul>\r\n	<li>Appendectomy at age 25.</li>\r\n</ul>\r\n\r\n<p><strong>Medications:</strong></p>\r\n\r\n<ul>\r\n	<li>Metformin 500 mg twice daily</li>\r\n	<li>Lisinopril 20 mg daily</li>\r\n	<li>Atorvastatin 40 mg daily</li>\r\n	<li>Aspirin 81 mg daily</li>\r\n</ul>\r\n\r\n<p><strong>Allergies:</strong></p>\r\n\r\n<ul>\r\n	<li>No known drug allergies.</li>\r\n</ul>\r\n\r\n<p><strong>Family History:</strong></p>\r\n\r\n<ul>\r\n	<li>Father: Deceased at age 70, myocardial infarction.</li>\r\n	<li>Mother: Alive, age 75, history of hypertension and type 2 diabetes.</li>\r\n	<li>Siblings: One sister, age 45, healthy.</li>\r\n</ul>\r\n\r\n<p><strong>Social History:</strong></p>\r\n\r\n<ul>\r\n	<li>Smoker: 1 pack per day for 25 years, quit 2 years ago.</li>\r\n	<li>Alcohol: Occasionally drinks, 1-2 drinks per week.</li>\r\n	<li>Occupation: Accountant.</li>\r\n	<li>Marital Status: Married, two children.</li>\r\n</ul>\r\n', 'Angina Pectoris', '<p><strong>Angina Pectoris</strong>: The patient&#39;s description of chest pain, particularly its characteristics and triggers (exacerbated by physical activity and relieved by rest), is highly suggestive of angina pectoris. This condition is indicative of underlying coronary artery disease (CAD).</p>\r\n'),
(5, 6, 5, '2024-05-28', NULL, NULL, NULL),
(6, 7, 5, '2024-05-28', NULL, NULL, '<p>fds</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientid`, `firstname`, `lastname`, `email`, `password`, `address`, `state`, `mobile`, `birthdate`, `gender`, `bloodgroup`, `photo_path`) VALUES
(1, 'Seif', 'Malcom', 'pat1@gmail.com', '12345', 'City annaba', 'Annaba', '0785642135', '1991-05-02', 'Male', 'AB+', 'uploads/patient8.jpg'),
(2, 'Kamal', 'Bourasse', 'pat2@gmail.com', '12345', 'City Harach', 'Algiers', '0598621454', '1985-05-08', 'Male', 'O+', 'uploads/patient3.jpg'),
(5, 'Zinou', 'Dejbar', 'pat3@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'Bouïra', '0565124578', '1991-05-10', 'Male', 'A+', 'uploads/patient (1).jpg'),
(6, 'Salma', 'Boujemla', 'pat4@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'El Tarf', '0565124578', '1985-05-17', 'Female', 'O+', 'uploads/patient (2).jpg'),
(7, 'Brahim', 'Bouarass', 'pat5@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'Algiers', '0565124578', '1975-05-17', 'Male', 'AB+', 'uploads/patient (3).jpg'),
(8, 'Ahmed', 'Souwafa', 'pat6@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'Batna', '0565124578', '1977-05-11', 'Male', 'B+', 'uploads/patient (5).jpg'),
(9, 'Lamia', 'Felfila', 'pat7@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'Constantine', '0565124578', '1998-05-18', 'Female', 'B-', 'uploads/patient (4).jpg'),
(10, 'Mohamed', 'Aïcha', 'pat8@gmail.com', '12345', 'CITIE UV 12 BT G N45', 'Annaba', '0565124578', '1970-05-09', 'Male', 'B+', 'uploads/patient (7).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescriptionid` int(11) NOT NULL,
  `recordid` int(11) DEFAULT NULL,
  `prescriptionname` varchar(255) DEFAULT NULL,
  `prescriptiondate` date DEFAULT NULL,
  `instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescriptionid`, `recordid`, `prescriptionname`, `prescriptiondate`, `instructions`) VALUES
(1, 4, 'Angina Pectoris', '2024-05-28', '<ul>\r\n	<li><strong>Nitrates (e.g., Nitroglycerin):</strong> Sublingual nitroglycerin 0.4 mg as needed for chest pain, up to 3 doses 5 minutes apart if necessary. Instruct patient to seek emergency care if pain persists after 3 doses.</li>\r\n	<li><strong>Beta-blockers (e.g., Metoprolol):</strong> Metoprolol 50 mg twice daily to reduce myocardial oxygen demand.</li>\r\n	<li><strong>Antiplatelet agents (e.g., Aspirin):</strong> Continue low-dose aspirin 81 mg daily to prevent platelet aggregation.</li>\r\n	<li><strong>Statins (e.g., Atorvastatin):</strong> Continue atorvastatin 40 mg daily for lipid control and plaque stabilization.</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE `secretary` (
  `secretaryid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `secretary`
--

INSERT INTO `secretary` (`secretaryid`, `firstname`, `lastname`, `email`, `password`, `startdate`, `address`, `state`, `mobile`, `birthdate`, `gender`, `bloodgroup`, `photo_path`) VALUES
(2, 'Zayneb', 'Samar', 'sec@gmail.com', '12345', '2015-05-07', 'City annaba', 'Annaba', '0698541235', '1995-05-03', 'Female', 'A+', 'uploads/TalentMed-New-Blogs-3-17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `testid` int(11) NOT NULL,
  `recordid` int(11) DEFAULT NULL,
  `analystid` int(11) DEFAULT NULL,
  `requestdate` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `testtype` varchar(255) DEFAULT NULL,
  `priority` varchar(10) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `resultdate` date DEFAULT NULL,
  `results` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testid`, `recordid`, `analystid`, `requestdate`, `status`, `testtype`, `priority`, `comment`, `resultdate`, `results`) VALUES
(2, 4, 1, '2024-05-28', 'Completed', 'FNS', 'High', '', '2024-05-28', '<ul>\r\n	<li>Complete Blood Count (CBC): Within normal limits.</li>\r\n	<li>Basic Metabolic Panel (BMP): Within normal limits.</li>\r\n	<li>Hemoglobin A1c: 7.2%</li>\r\n	<li>Lipid Panel: Total cholesterol 220 mg/dL, LDL 130 mg/dL, HDL 45 mg/dL, Triglycerides 150 mg/dL.</li>\r\n	<li>Troponin I: &lt;0.01 ng/mL (normal)</li>\r\n	<li>5</li>\r\n</ul>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `analysts`
--
ALTER TABLE `analysts`
  ADD PRIMARY KEY (`analystid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentid`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctorid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  ADD PRIMARY KEY (`recordid`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescriptionid`),
  ADD KEY `recordid` (`recordid`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`secretaryid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`testid`),
  ADD KEY `recordid` (`recordid`),
  ADD KEY `analystid` (`analystid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `analysts`
--
ALTER TABLE `analysts`
  MODIFY `analystid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescriptionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secretary`
--
ALTER TABLE `secretary`
  MODIFY `secretaryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `testid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patients` (`patientid`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctors` (`doctorid`);

--
-- Constraints for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  ADD CONSTRAINT `medicalrecords_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patients` (`patientid`),
  ADD CONSTRAINT `medicalrecords_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctors` (`doctorid`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`recordid`) REFERENCES `medicalrecords` (`recordid`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`recordid`) REFERENCES `medicalrecords` (`recordid`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`analystid`) REFERENCES `analysts` (`analystid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
