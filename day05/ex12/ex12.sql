SELECT
	u.last_name,
	u.first_name

FROM 
	db_sescolas.user_card u

WHERE
	u.first_name REGEXP '.*( |-).*' OR
	u.last_name REGEXP '.*( |-).*'

ORDER BY
	u.last_name,
	u.first_name;
