SELECT *

FROM db_sescolas.distrib d

WHERE 
	(d.id_distrib IN (42, 71, 88, 89, 90) OR d.id_distrib BETWEEN 62 AND 69) OR
	LOWER(d.name) REGEXP '.*y.*y.*'

LIMIT 2, 5;
