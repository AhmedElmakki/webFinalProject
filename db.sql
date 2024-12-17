-- Create the database
CREATE DATABASE IF NOT EXISTS `students_db`;
USE `students_db`;

-- --------------------------------------------------------
-- Table structure for table `contact_us`
-- --------------------------------------------------------

CREATE TABLE `contact_us` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `submitted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `students`
-- --------------------------------------------------------

CREATE TABLE `students` (
  `student_name` VARCHAR(255) NOT NULL,
  `student_id` INT(11) NOT NULL AUTO_INCREMENT,
  `gpa` DOUBLE NOT NULL,
  `credit_hours` INT(11) NOT NULL,
  `age` INT(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Optional: Insert a sample user into `users` table for testing
-- --------------------------------------------------------

-- INSERT INTO `users` (`username`, `password`) VALUES ('testuser', 'hashed_password');
