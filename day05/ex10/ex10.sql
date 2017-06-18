SELECT 
	f.last_projection,
	f.title AS Title,
	f.summary AS Summary,
	f.prod_year

FROM 
	db_sescolas.film f
	INNER JOIN db_sescolas.genre g ON g.id_genre = f.id_genre

WHERE 
	g.name = 'erotic'

ORDER BY 
	f.prod_year DESC;
