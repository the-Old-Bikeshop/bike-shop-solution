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
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` VARCHAR(100) NOT NULL
);

CREATE TABLE `company_details` (
    company_detailsID INT NOT NULL Primary Key AUTO_INCREMENT,
    company_description TEXT,
    opening_hours VARCHAR(100),
    mission TEXT,
    vision TEXT,
    STATEMENT TEXT,
    phone VARCHAR(20),
    address VARCHAR(255),
    email VARCHAR(150),
    instagram VARCHAR(100)
);

CREATE TABLE email_template (
    email_templateID INT NOT NULL Primary Key AUTO_INCREMENT,
    `name` VARCHAR(100),
    subject VARCHAR(100),
    `text` TEXT,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  address_type INT NOT NULL,
  userID INT NOT NULL,
  postalCodeID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` ( userID ),
  FOREIGN KEY (postalCodeID) REFERENCES city (postalCodeID)
);

CREATE TABLE shipping (
  shippingID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT
);

CREATE TABLE review (
  reviewID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255),
  content TEXT NOT NULL,
  userID INT,
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);

CREATE TABLE `order` (
  orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  follow_up_date DATE,
  `status` INT NOT NULL ,
  payment_status INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
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
  imageID INT,
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
  wheel_sizeID INT,
  braking_systemID INT,
  drive_typeID INT,
  created_by INT,
  FOREIGN KEY (wheel_sizeID) REFERENCES wheel_size (wheel_sizeID),
  FOREIGN KEY (braking_systemID) REFERENCES braking_system (braking_systemID),
  FOREIGN KEY (drive_typeID) REFERENCES drive_type (drive_typeID),
  FOREIGN KEY (created_by) REFERENCES `user` (userID)
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
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  bike_specificationsID INT,
  brandID INT,
  created_by INT NOT NULL,
  FOREIGN KEY (bike_specificationsID) REFERENCES bike_specifications (bike_specificationsID),
  FOREIGN KEY (brandID) REFERENCES brand (brandID),
  FOREIGN KEY (created_by) REFERENCES `user` (userID)
);

CREATE TABLE order_has_products(
  quantity INT NOT NULL,
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
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (imageID) REFERENCES `image`(imageID),
  CONSTRAINT PK_product_has_images PRIMARY KEY (productID, imageID)
);

CREATE TABLE post (
  postID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  content TEXT,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  meta_title VARCHAR(160),
  meta_description VARCHAR(500),
  meta_keyword VARCHAR(100)
);
