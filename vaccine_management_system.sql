-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 08:11 AM
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
-- Database: `vaccine_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'Covid', '1919');

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `hospital_name` varchar(30) NOT NULL,
  `allergy` varchar(255) NOT NULL DEFAULT '',
  `dob` text NOT NULL,
  `vaccination_name` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_name`, `phone_number`, `hospital_name`, `allergy`, `dob`, `vaccination_name`, `appointment_date`, `status`) VALUES
(1, 'Saifullah', '0318127475', '0', 'Polluns', '', 'Corona ', '2024-11-21', 'Accepted'),
(3, 'Mark Johnson', '4567891230', '0', 'Dust', '', 'COVID-19 Booster', '2024-11-27', 'Accepted'),
(5, 'Bob Davis', '3216549870', '0', 'Pollen', '', 'Tetanus Vaccine', '2024-11-29', 'Rejected'),
(6, 'azlan', '9373226', 'asdhiak', 'Pollens', '2024-12-27', 'Covaxin', '2024-12-20', 'Pending'),
(7, 'azlan', '9373226', 'asdhiak', 'Pollens', '2024-12-27', 'Covaxin', '2024-12-20', 'Pending'),
(8, 'azlan', '9373226', 'asdhiak', 'Pollens', '2024-12-27', 'Covaxin', '2024-12-20', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_name`, `contact`, `hospital_name`, `appointment_date`, `status`) VALUES
(1, 'ashle', '12121212', 'times', '2024-11-20', 'Pending'),
(2, 'ashle', '12121212', 'times', '2024-11-20', 'Approved'),
(3, 'sara', '232 2323 34', 'patel', '2024-12-07', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_date` date NOT NULL,
  `test_time` time NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospital_name`, `location`) VALUES
(1, 'City Hospital', 'Downtown'),
(2, 'Green Clinic', 'Uptown'),
(3, 'Bright Health Center', 'Suburb'),
(4, 'Medi care', 'Suburb');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_user`
--

CREATE TABLE `hospital_user` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_user`
--

INSERT INTO `hospital_user` (`id`, `hospital_name`, `email`, `phone`, `location`, `status`, `created_at`) VALUES
(1, 'City Hospital', 'cityhospital@example.com', '1234567890', 'Downtown', 'Rejected', '2024-11-25 18:03:48'),
(2, 'Green Clinic', 'greenclinic@example.com', '0987654321', 'Uptown', 'Rejected', '2024-11-25 18:03:48'),
(3, 'Bright Health Center', 'brighthealth@example.com', '1122334455', 'Suburb', 'Rejected', '2024-11-25 18:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(255) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `allergy` varchar(35) NOT NULL,
  `age` int(3) NOT NULL,
  `medicine_prescribed` varchar(255) DEFAULT NULL,
  `vaccination_status` enum('Pending','Completed') DEFAULT 'Pending',
  `corona_result` enum('Positive','Negative') DEFAULT 'Negative'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_name`, `phone_number`, `dob`, `allergy`, `age`, `medicine_prescribed`, `vaccination_status`, `corona_result`) VALUES
(9, 'saif ullah', '+92 318 1274752', '2024-12-26', 'gluten', 21, '', 'Pending', 'Negative');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('hospital','patient') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'syedhamza', 'hassan@gmail.com', '$2y$10$6q97QFemABBQatCwxhkODuJjbroAiUMtFCYed1.WLWfpjI3ofEMfq', 'patient', '2024-12-09 21:44:18'),
(2, 'ali', 'ali@gmail.com', '$2y$10$gTSZXEM5IA4CQ67YxZ3pY.6yrq/pppwVPO..kEuz0bQNSgaKFUUlK', 'hospital', '2024-12-09 21:55:11'),
(3, 'saifullah', 'saif@gmail.com', '$2y$10$N7n/v1P4v05zoTbOAarSJuIrYsM2BCzvIMFDsOfOctOFTzArFahEK', 'patient', '2024-12-09 22:18:01'),
(6, 'saif', 'saifchesterking131@gmail.com', '$2y$10$M8xfdYbmarKV0XIbUX7rHuhaROnVAv4Nlyu4snuIyt7rHLsJm4s.u', 'patient', '2024-12-09 22:26:10'),
(7, 'wasw', 'wsaw@gmail.com', '$2y$10$514yY2FdqT3/XFxuVGJDuOcalPpQKbIMUStCpPJuf46XATmCWDoN6', 'hospital', '2024-12-09 22:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_availability`
--

CREATE TABLE `vaccine_availability` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `availability_status` enum('Available','Unavailable') NOT NULL,
  `availability_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_availability`
--

INSERT INTO `vaccine_availability` (`hospital_id`, `hospital_name`, `vaccine_name`, `availability_status`, `availability_count`) VALUES
(1, 'City Hospital', 'Pfizer', 'Available', 0),
(2, 'Green Clinic', 'Moderna', 'Unavailable', 0),
(4, 'Medi care', 'AstraZeneca', 'Available', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_user`
--
ALTER TABLE `hospital_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vaccine_availability`
--
ALTER TABLE `vaccine_availability`
  ADD PRIMARY KEY (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital_user`
--
ALTER TABLE `hospital_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vaccine_availability`
--
ALTER TABLE `vaccine_availability`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
