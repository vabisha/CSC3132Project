-- Create a new database
CREATE DATABASE my_database;

-- Use the new database
USE my_database;

-- Create a users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert some sample data
INSERT INTO users (username, password) VALUES ('user1', 'password123');
