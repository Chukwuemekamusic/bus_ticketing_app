CREATE TABLE bookings (                        
    booking_id VARCHAR(50) NOT NULL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    one_bus_id INT NOT NULL,
    one_departure VARCHAR(30) NOT NULL,
    one_arrival VARCHAR(30) NOT NULL,
    one_departure_date DATE NOT NULL,
    one_departure_time TIME NOT NULL,
    one_arrival_date DATE NOT NULL,
    one_arrival_time TIME NOT NULL,
    one_bus_number VARCHAR(30) NOT NULL,
    one_ticket_price DECIMAL(10,2) NOT NULL DEFAULT 60.45,
    return_bus_id INT DEFAULT NULL
    return_departure VARCHAR(30) DEFAULT NULL,
    return_arrival VARCHAR(30) DEFAULT NULL,
    return_departure_date DATE DEFAULT NULL,
    return_departure_time TIME DEFAULT NULL,
    return_arrival_date DATE DEFAULT NULL,
    return_arrival_time TIME DEFAULT NULL,
    return_bus_number VARCHAR(30) DEFAULT NULL,
    return_ticket_price DECIMAL(10,2) DEFAULT NULL,
    total_paid DECIMAL(10,2) NOT NULL
    FOREIGN KEY (one_bus_id) REFERENCES bus_schedules(bus_schedule_id)
    );



    CREATE TABLE bookings5 (                        
    booking_id VARCHAR(50) NOT NULL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    one_departure VARCHAR(30) NOT NULL,
    one_arrival VARCHAR(30) NOT NULL,
    one_bus_number VARCHAR(30) NOT NULL,
    one_ticket_price DECIMAL(10,2) NOT NULL,
    total_paid DECIMAL(10,2) NOT NULL
    );




CREATE TABLE bookings (
  booking_id VARCHAR(50) NOT NULL PRIMARY KEY,
  departure_schedule_id INT(6) UNSIGNED,
  return_schedule_id INT(6) UNSIGNED DEFAULT NULL,
  departure_seat_number INT(11) NOT NULL,
  return_seat_number INT(11) DEFAULT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,  
  email VARCHAR(50) DEFAULT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  one_ticket_price DECIMAL(10,2) NOT NULL,
  return_ticket_price DECIMAL(10,2) DEFAULT NULL,
  total_price DECIMAL(10,2) GENERATED ALWAYS AS (one_ticket_price + return_ticket_price),
  booking_date DATETIME NOT NULL,
  departure_date DATE DEFAULT NULL,
  return_date DATE DEFAULT NULL,
  FOREIGN KEY (departure_schedule_id) REFERENCES bus_schedules(bus_schedule_id) ON DELETE CASCADE,
  FOREIGN KEY (return_schedule_id) REFERENCES bus_schedules(bus_schedule_id)
);


