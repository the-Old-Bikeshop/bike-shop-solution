

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