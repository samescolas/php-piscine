SELECT c.floor_number AS floor, SUM(c.nb_seats) AS seats
FROM db_sescolas.cinema c
GROUP BY c.floor_number
ORDER BY c.seats DESC;
