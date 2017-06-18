SELECT f.title, f.summary
FROM db_sescolas.film f
WHERE LOWER(f.summary) LIKE '%vincent%'
ORDER BY f.id_film;
