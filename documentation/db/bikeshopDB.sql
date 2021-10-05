DROP DATABASE IF EXISTS bikeshop;
CREATE DATABASE bikeshop;
USE bikeshop;

CREATE TABLE `user` (
  userID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nick_name VARCHAR(100) NOT NULL,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  password_hash VARCHAR(155) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(100) NOT NULL,
  `role` VARCHAR(100) NOT NULL
);
CREATE TABLE city (
  postalCodeID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
);
CREATE TABLE `address` (
  addressID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  street_name VARCHAR(150) NOT NULL,
  address_content VARCHAR(150) NOT NULL,
  phone_number VARCHAR(100) NOT NULL,
  address_type VARCHAR(100) NOT NULL,
  userID INT NOT NULL,
  postalCodeID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` ( userID ),
  FOREIGN KEY (postalCodeID) REFERENCES city (postalCodeID)
);
CREATE TABLE shipping (
  shippingID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  creation_date DATE,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  userID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE review (
  reviewID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  creation_date DATETIME,
  title VARCHAR(255),
  content TEXT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE `order` (
  orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  creation_date DATETIME NOT NULL,
  follow_up_date DATE,
  `status` VARCHAR(100) NOT NULL,
  payment_status VARCHAR(100) NOT NULL,
  total_price INT NOT NULL,
  purchase_order_number INT NOT NULL,
  userID INT NOT NULL,
  shippingID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` (userID),
  FOREIGN KEY (shippingID) REFERENCES shipping (shippingID)
);
CREATE TABLE drive_type (
  drive_typeID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255)
);
CREATE TABLE wheel_size (
  wheel_sizeID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  wheel_ISO VARCHAR(255) NOT NULL,
  tire_ISO VARCHAR(255) NOT NULL
);
CREATE TABLE braking_system (
  braking_systemID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `condition` INT(2)
);
CREATE TABLE category (
  categoryID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255)
);
CREATE TABLE `image` (
  imageID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255),
  `URL` TEXT,
  alt VARCHAR(255)
);
CREATE TABLE brand (
  brandID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255),
  website VARCHAR(255),
  imageID INT NOT NULL,
  FOREIGN KEY (imageID) REFERENCES `image` (imageID)
);
CREATE TABLE bike_specifications (
  bike_specificationsID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  back_basket INT,
  mudguards INT,
  front_basket INT,
  lights INT,
  disk_brakes INT,
  wheel_sizeID INT NOT NULL,
  braking_systemID INT NOT NULL,
  drive_typeID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (wheel_sizeID) REFERENCES wheel_size (wheel_sizeID),
  FOREIGN KEY (braking_systemID) REFERENCES braking_system (braking_systemID),
  FOREIGN KEY (drive_typeID) REFERENCES drive_type (drive_typeID),
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE product (
  productID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255),
  `weight` DECIMAL(10, 2),
  price DECIMAL(10, 2) NOT NULL,
  model_name VARCHAR(255) NOT NULL,
  stock INT NOT NULL,
  `length` DECIMAL(10, 2),
  color VARCHAR(100),
  creation_date DATE,
  bike_specificationsID INT NOT NULL,
  brandID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (bike_specificationsID) REFERENCES bike_specifications (bike_specificationsID),
  FOREIGN KEY (brandID) REFERENCES brand (brandID),
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE order_products(
  quantity INT NOT NULL,
  paid_price INT NOT NULL,
  userID INT NOT NULL,
  productID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` (userID),
  FOREIGN KEY (productID) REFERENCES product (productID),
  CONSTRAINT PK_order_products PRIMARY KEY(userID, productID)
);
CREATE TABLE favourite_products(
  userID INT NOT NULL,
  productID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES user (userID),
  FOREIGN KEY (productID) REFERENCES product (productID),
  CONSTRAINT PK_favourite_products PRIMARY KEY(userID, productID)
);
CREATE TABLE product_has_category (
  productID INT NOT NULL,
  categoryID INT NOT NULL,
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (categoryID) REFERENCES category (categoryID),
  CONSTRAINT PK_product_has_category PRIMARY KEY(productID, categoryID)
);
CREATE TABLE product_has_images (
  productID INT NOT NULL,
  imageID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (imageID) REFERENCES `image`(imageID),
  CONSTRAINT PK_product_has_images PRIMARY KEY (productID, imageID),
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE post (
  postID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  content TEXT,
  creation_date DATETIME,
  productID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE post_has_images (
  postID INT NOT NULL,
  imageID INT NOT NULL,
  FOREIGN KEY (imageID) REFERENCES `image`(imageID),
  FOREIGN KEY (postID) REFERENCES post(postID),
  CONSTRAINT PK_post_has_images PRIMARY KEY (postID, imageID)
);
CREATE TABLE comment (
  commentID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  creation_date DATETIME,
  title VARCHAR(255),
  content TEXT NOT NULL,
  userID INT NOT NULL,
  postID INT NOT NULL,
  FOREIGN KEY (postID) REFERENCES post(postID),
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);
CREATE TABLE `page` (
  pageID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  cannonical_path VARCHAR(100),
  meta_title VARCHAR(100) NOT NULL,
  meta_description VARCHAR(255) NOT NULL,
  meta_keyword VARCHAR(100) NOT NULL
);
