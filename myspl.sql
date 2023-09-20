create database if not exists book;
use book;
create table if not exists Users (
	`id` INT NOT NULL AUTO_INCREMENT primary key,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `tel` INT NOT NULL,
  `role` VARCHAR(255) NOT NULL
  );
    CREATE TABLE IF NOT EXISTS Categories (
  `id` INT NOT NULL AUTO_INCREMENT primary key,
  `name` VARCHAR(255) NOT NULL
  );
 CREATE TABLE IF NOT EXISTS Books (
  `id` INT NOT NULL AUTO_INCREMENT primary key,
  `category_id` INT NOT NULL,
  `title` TEXT NOT NULL,
  `description` TEXT NOT NULL,
  `stock` INT NOT NULL,
  `price` INT NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  CONSTRAINT `books_ibfk_1`
    FOREIGN KEY (`category_id`)
    REFERENCES `book`.`categories` (`id`)
  );
  CREATE TABLE IF NOT EXISTS Orders (
  `id` INT NOT NULL AUTO_INCREMENT primary key,
  `user_id` INT NOT NULL,
  `book_id` INT NOT NULL,
  `amount` INT NOT NULL,
  `order_at` TIME NOT NULL,
  `payment` VARCHAR(255) NOT NULL,
  CONSTRAINT `orders_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `book`.`users` (`id`),
  CONSTRAINT `orders_ibfk_2`
    FOREIGN KEY (`book_id`)
    REFERENCES `book`.`books` (`id`)
  );

  CREATE TABLE IF NOT EXISTS Favorites (
  `id` INT NOT NULL AUTO_INCREMENT primary key,
  `user_id` INT NOT NULL,
  `book_id` INT NOT NULL,
  CONSTRAINT `favorites_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `book`.`users` (`id`),
  CONSTRAINT `favorites_ibfk_2`
    FOREIGN KEY (`book_id`)
    REFERENCES `book`.`books` (`id`)
  );
  
  