-- Learn Log-in DB – Schema & Seed
-- Charset & Collation je nach Server ggf. anpassen
CREATE DATABASE IF NOT EXISTS learn_login
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;
USE learn_login;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  profile_image VARCHAR(255) DEFAULT NULL,
  role VARCHAR(50) NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB;

-- Seed
-- Demo-User: admin / admin123 (Bitte Passwort direkt nach Import ändern!)
-- Hash erzeugt mit PHP password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO users (username, email, password_hash, profile_image, role)
VALUES 
('admin', 'admin@example.com', '$2y$10$0mH5QxNHj1l0XnqU.g2UuOx5y6s31YbKkk2m1X5X5aF2w/2GfZx8i', '/uploads/admin.png', 'admin'),
('a', 'a@example.com', '$2y$10$0mH5QxNHj1l0XnqU.g2UuOx5y6s31YbKkk2m1X5X5aF2w/2GfZx8i', '/uploads/a.jpg', 'user'),
('b', 'b@example.com', '$2y$10$0mH5QxNHj1l0XnqU.g2UuOx5y6s31YbKkk2m1X5X5aF2w/2GfZx8i', '/uploads/b.jpg', 'moderator');

