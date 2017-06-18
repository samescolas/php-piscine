SELECT 
	g.id_genre AS id_genre,
	g.name AS name_genre,
	d.id_distrib AS id_distrib,
	d.name AS name_distrib,
	f.title AS title_film

FROM
	db_sescolas.film f
	LEFT JOIN db_sescolas.genre g ON f.id_genre = g.id_genre
	LEFT JOIN db_sescolas.distrib d ON d.id_distrib = f.id_distrib

WHERE f.id_genre BETWEEN 4 AND 8;
