CREATE TABLE users_bookings (
 uid INT(11) NOT NULL,
    booking_id VARCHAR(50) NOT NULL,
    PRIMARY KEY (uid, booking_id),
    FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE
) 