-- Creating DB
CREATE DATABASE IF NOT EXISTS blog_db;
-- Using DB
USE blog_db;

-- Creating Tables
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    post_id INT,
    user_id INT,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


-- Dummy Data
INSERT INTO users (name, email) VALUES
('Alice', 'alice@example.com'),
('Bob', 'bob@example.com');

INSERT INTO posts (title, content, user_id) VALUES
('First Post', 'This is the first post', 1),
('Second Post', 'Another blog entry', 2);

INSERT INTO comments (content, post_id, user_id) VALUES
('Nice post!', 1, 2),
('Thanks for sharing!', 1, 1),
('Interesting read.', 2, 1);
