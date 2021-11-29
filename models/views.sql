

-- //select statement for bike specs

SELECT bike_S.type, bike_s.back_basket, bike_s.mudguards, bike_s.front_basket, bike_s.lights, bike_s.disk_brakes, bs.name AS brake_name, bs.condition, ws.wheel_ISO, ws.tire_ISO, dt.name AS drive_name,  dt.short_description, dt.description, u.nick_name, u.first_name, u.last_name
FROM bike_specifications bike_s, braking_system bs, wheel_size ws, drive_type dt, user u
WHERE bike_s.wheel_sizeID = ws.wheel_sizeID
  AND bike_s.braking_systemID = bs.braking_systemID
  AND bike_s.drive_typeID = dt.drive_typeID
  AND bike_s.created_by = u.userID;

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
	     INNER JOIN user u ON (o.userID = u.userID)


CREATE OR REPLACE VIEW review_view AS
SELECT r.reviewID, r.created_at, r.title, r.content, r.state, r.rating, u.email, u.first_name, u.last_name
FROM review r
INNER JOIN user u ON r.userID = u.userID;

CREATE OR REPLACE VIEW brand_view AS
SELECT b.brandID, b.name, b.description, b.short_description, b.website, i.URL, i.alt, i.name AS image_name
FROM brand b
LEFT JOIN image i ON (b.imageID = i.imageID);


product_has_images
brand
post_has_images
image

CREATE OR REPLACE VIEW used_images AS
SELECT i.imageID
FROM image i, brand b, product_has_images pri, post_has_images poi
WHERE i.imageID = b.imageID
INNER JOIN product_has_images pri ON (i.imageID = pri.imageID)
INNER JOIN post_has_images poi ON (i.imageID = poi.imageID);

CREATE OR REPLACE VIEW used_images AS
SELECT b.imageID AS brand_image FROM brand b
UNION
SELECT pri.imageID AS product_image FROM product_has_images pri
UNION
SELECT poi.imageID AS post_image FROM post_has_images poi;








