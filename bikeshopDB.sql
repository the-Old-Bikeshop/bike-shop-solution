DROP DATABASE IF EXISTS bikeshop;
CREATE DATABASE bikeshop;
USE bikeshop;
CREATE TABLE user (userID INT NOT NULL PRIMARY KEY);
CREATE TABLE drive_type (
  drive_typeID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255)
);
CREATE TABLE wheel_size (
  wheel_sizeID INT NOT NULL PRIMARY KEY,
  wheel_ISO VARCHAR(255) NOT NULL,
  tire_ISO VARCHAR(255) NOT NULL
);
CREATE TABLE braking_system (
  braking_systemID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `condition` INT(2)
);
CREATE TABLE category (
  categoryID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255)
);
CREATE TABLE `image` (
  imageID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255),
  `URL` TEXT,
  alt VARCHAR(255)
);
CREATE TABLE brand (
  brandID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255),
  website VARCHAR(255),
  imageID INT NOT NULL,
  FOREIGN KEY (imageID) REFERENCES `image` (imageID)
);
CREATE TABLE bike_specifications (
  bike_specificationsID INT NOT NULL PRIMARY KEY,
  `type` VARCHAR(255) NOT NULL,
  back_basket INT,
  mudguarts INT,
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
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE product (
  productID INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  short_description VARCHAR(255),
  `weight` DECIMAL(10, 2),
  price DECIMAL(10, 2) NOT NULL,
  model_name VARCHAR(255) NOT NULL,
  stock INT NOT NULL,
  `length` DECIMAL(10, 2),
  color VARCHAR(100),
  create_date VARCHAR(100),
  bike_specificationsID INT NOT NULL,
  brandID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (bike_specificationsID) REFERENCES bike_specifications (bike_specificationsID),
  FOREIGN KEY (brandID) REFERENCES brand (brandID),
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE product_list(
  ID INT NOT NULL,
  productID INT NOT NULL,
  productID_two INT NOT NULL,
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (productID_two) REFERENCES product (productID),
  CONSTRAINT PK_product_list PRIMARY KEY(ID, productID, productID_two)
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
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE post (
  postID INT NOT NULL PRIMARY KEY,
  title VARCHAR(255),
  content LONGTEXT,
  create_date VARCHAR(100),
  productID INT NOT NULL,
  userID INT NOT NULL,
  FOREIGN KEY (productID) REFERENCES product (productID),
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE post_has_images (
  postID INT NOT NULL,
  imageID INT NOT NULL,
  FOREIGN KEY (imageID) REFERENCES `image`(imageID),
  FOREIGN KEY (postID) REFERENCES post(postID),
  CONSTRAINT PK_post_has_images PRIMARY KEY (postID, imageID)
);
CREATE TABLE comment (
  commentID INT NOT NULL PRIMARY KEY,
  creation_date VARCHAR(100),
  title VARCHAR(255),
  content TEXT NOT NULL,
  userID INT NOT NULL,
  postID INT NOT NULL,
  FOREIGN KEY (postID) REFERENCES post(postID),
  FOREIGN KEY (userID) REFERENCES user (userID)
);
CREATE TABLE reply (
  replyID INT NOT NULL PRIMARY KEY,
  creation_date VARCHAR(100),
  title VARCHAR(255),
  content TEXT NOT NULL,
  userID INT NOT NULL,
  commentID INT NOT NULL,
  FOREIGN KEY (commentID) REFERENCES comment(commentID),
  FOREIGN KEY (userID) REFERENCES user (userID)
);