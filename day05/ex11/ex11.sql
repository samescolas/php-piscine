SELECT 
	UPPER(u.last_name) AS NAME,
	u.first_name,
	s.price

FROM
	db_sescolas.member m
	INNER JOIN db_sescolas.subscription s ON s.id_sub = m.id_sub
	INNER JOIN db_sescolas.user_card u ON u.id_user = m.id_user_card

WHERE s.price > 42

ORDER BY u.last_name, u.first_name;
