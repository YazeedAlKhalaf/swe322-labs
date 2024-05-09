CREATE DATABASE IF NOT EXISTS hotelquiz;
USE hotelquiz;

CREATE TABLE guest (
  id int(11) NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  last_name varchar(100) NOT NULL,
  dob date NOT NUll,
  gender char(1) NOT NULL,
  address varchar(100) NOT NULL,
  phone_number varchar(14) NOT NULL,
  email varchar(320) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE room (
  room_number int(11) NOT NULL AUTO_INCREMENT,
  room_type enum('SINGLE', 'DOUBLE', 'SUITE') NOT NULL,
  price decimal NOT NULL,
  PRIMARY KEY (room_number)
);

CREATE TABLE booking (
  id int(11) NOT NULL AUTO_INCREMENT,
  guest_id int(11) NOT NULL,
  room_number int(11) NOT NULL,
  check_in_date date NOT NUll,
  check_out_date date NOT NUll,
  PRIMARY KEY (id)
);

use hotelquiz;

ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`) ON DELETE CASCADE;

-- insert the sample data :D

INSERT INTO guest (first_name, last_name, dob, gender, address, phone_number, email)
  VALUES ('Ahmad', 'Mostafa', '2024-01-01', 'M', 'Riyadh, Saudi Arabia', '0505050505', 'ahmad@mostafa.com'),
  ('Sarah', 'Hameed', '2024-03-02', 'F', 'Dammam, Saudi Arabia', '0505050504', 'sarah@hameed.com'),
  ('Salem', 'Aldosari', '2024-05-02', 'M', 'Jeddah, Saudi Arabia', '0505050503', 'salem@aldosari.com'); 

INSERT INTO room (room_number, room_type, price)
  VALUES (301, 'SINGLE', 10.3),
  (302, 'DOUBLE', 10.3),
  (303, 'SUITE', 10.3);

INSERT INTO booking (guest_id, room_number, check_in_date, check_out_date)
  VALUES (1, 301, '2024-01-01', '2025-01-01'),
  (2, 302, '2024-01-04', '2025-01-04'),
  (3, 303, '2024-01-06', '2025-01-06');
