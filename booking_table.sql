CREATE TABLE bookings (                        
    booking_id VARCHAR(50) NOT NULL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    one_departure VARCHAR(30) NOT NULL,
    one_arrival VARCHAR(30) NOT NULL,
    one_departure_date DATE NOT NULL,
    one_departure_time TIME NOT NULL,
    one_arrival_date DATE NOT NULL,
    one_arrival_time TIME NOT NULL,
    one_bus_number VARCHAR(30) NOT NULL,
    one_ticket_price DECIMAL(10,2) NOT NULL,
    return_departure VARCHAR(30),
    return_arrival VARCHAR(30),
    return_departure_date DATE ,
    return_departure_time TIME,
    return_arrival_date DATE,
    return_arrival_time TIME,
    return_bus_number VARCHAR(30),
    return_ticket_price DECIMAL(10,2),
    total_paid DECIMAL(10,2) NOT NULL
    );
    