When building database:
CREATE TABLE users (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CreationDate DATETIME NOT NULL
);

Host: localhost
User: root
Password:
Database Name: eqs
