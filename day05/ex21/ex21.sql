SELECT MD5(REPLACE(CONCAT(phone_number, "42"), '7', '9'))
FROM db_sescolas.distrib
WHERE id_distrib = 84;
