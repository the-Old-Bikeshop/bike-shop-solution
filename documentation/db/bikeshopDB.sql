DROP DATABASE IF EXISTS bikeshop;
CREATE DATABASE bikeshop;
USE bikeshop;

CREATE TABLE `user` (
  userID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nick_name VARCHAR(100),
  first_name VARCHAR(100),
  last_name VARCHAR(100),
  password_hash VARCHAR(155),
  email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(100),
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` INT NOT NULL
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

CREATE TABLE delivery_zip (
	postal_code VARCHAR(10) NOT NULL PRIMARY KEY,
	country_code VARCHAR(10),
	place_name VARCHAR(255),
	admin_name1 VARCHAR(5),
	admin_name2 VARCHAR (5),
	admin_name3 VARCHAR (5),
	code_name3 VARCHAR (5),
	code_name2 VARCHAR(5),
	code_name1 VARCHAR(5),
	latitude VARCHAR(10),
	longitude VARCHAR(10),
	accuracy INT(2)
);

CREATE TABLE `address` (
  addressID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  street_name VARCHAR(150) NOT NULL,
  address_content VARCHAR(150) NOT NULL,
  phone_number VARCHAR(100) NOT NULL,
  address_type INT NOT NULL,
  userID INT NOT NULL,
  postalCodeID VARCHAR(10) NOT NULL,
  FOREIGN KEY (userID) REFERENCES `user` ( userID ),
  FOREIGN KEY (postalCodeID) REFERENCES `delivery_zip` (postal_code)
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
  rating INT,
  state INT,
  userID INT,
  FOREIGN KEY (userID) REFERENCES `user` (userID)
);

CREATE TABLE `order` (
  orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  follow_up_date DATE,
  `status` INT NOT NULL ,
  payment_status INT NOT NULL,
  total_price DECIMAL(10,2),
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
  orderID INT NOT NULL,
  productID INT NOT NULL,
  FOREIGN KEY (orderID) REFERENCES `order` (orderID),
  FOREIGN KEY (productID) REFERENCES product (productID),
  CONSTRAINT PK_order_products PRIMARY KEY(orderID, productID)
);

CREATE TABLE favourite_products(
	favourite_productsID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  userID INT NOT NULL,
  productID INT NOT NULL,
  FOREIGN KEY (userID) REFERENCES user (userID),
  FOREIGN KEY (productID) REFERENCES product (productID)
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
  productID INT,
  userID INT,
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
  content TEXT ,
  userID INT ,
  postID INT ,
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

CREATE OR REPLACE VIEW bike_speks AS
SELECT
	bike_s.bike_specificationsID,
	bike_S.type,
	bike_s.back_basket,
	bike_s.mudguards,
	bike_s.front_basket,
	bike_s.lights,
	bike_s.disk_brakes,
	bs.name AS brake_name,
	bs.condition,
	ws.wheel_ISO,
	ws.tire_ISO,
	dt.name AS drive_name,
	dt.short_description,
	dt.description,
	u.nick_name,
	u.first_name,
	u.last_name
FROM bike_specifications bike_s
	     INNER JOIN wheel_size ws ON (bike_s.wheel_sizeID = ws.wheel_sizeID)
	     INNER JOIN drive_type dt ON (bike_s.drive_typeID = dt.drive_typeID)
	     INNER JOIN braking_system bs ON (bike_s.braking_systemID = bs.braking_systemID)
	     INNER JOIN user u ON (bike_s.created_by = u.userID);


CREATE OR REPLACE VIEW order_view AS
SELECT o.orderID, o.created_at, o.status, o.payment_status, o.total_price, op.quantity, s.name AS shipping, p.name, u.first_name, u.last_name, u.email
FROM product p
	     INNER JOIN order_has_products op ON (op.productID = p.productID)
	     RIGHT JOIN `order` o ON (op.orderID = o.orderID)
	     INNER JOIN shipping s ON (o.shippingID = s.shippingID)
	     INNER JOIN user u ON (o.userID = u.userID);

CREATE OR REPLACE VIEW review_view AS
SELECT r.reviewID, r.created_at, r.title, r.content, u.email, u.first_name, u.last_name
FROM review r
	     INNER JOIN user u ON r.userID = u.userID;

CREATE OR REPLACE VIEW used_images AS
SELECT b.imageID AS usedImageID FROM brand b
UNION
SELECT pri.imageID AS product_image FROM product_has_images pri
UNION
SELECT poi.imageID AS post_image FROM post_has_images poi;

CREATE OR REPLACE VIEW brand_view AS
SELECT b.brandID, b.name, b.description, b.short_description, b.website, i.URL, i.alt, i.name AS image_name
FROM brand b
	     LEFT JOIN image i ON (b.imageID = i.imageID);


CREATE OR REPLACE VIEW simple_product_with_image AS
SELECT p.productID, p.model_name, p.name, p.price, i.URL, i.alt
FROM product p
LEFT JOIN product_has_images phi ON( p.productID = phi.productid)
LEFT JOIN image i ON (phi.imageid = i.imageid);