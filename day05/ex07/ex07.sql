SELECT f.title, f.summary
FROM db_sescolas.film f
WHERE f.title LIKE '%42%' OR f.summary LIKE '%42%'
ORDER BY f.duration;
