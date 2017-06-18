SELECT u.last_name, u.first_name, DATE_FORMAT(u.birthdate, '%m-%d-%Y') AS birthdate
FROM db_sescolas.user_card u
WHERE YEAR(u.birthdate) = 1989
ORDER BY u.last_name;
