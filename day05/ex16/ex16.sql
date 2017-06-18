SELECT COUNT(*) AS movies

FROM 
	db_sescolas.member_history h

WHERE 
	(h.date BETWEEN '2006-10-30' AND '2007-07-27') OR
	(MONTH(h.date) = 12 AND DAY(h.date) = 24);
