SELECT 
	COUNT(*) AS nb_susc,
	FLOOR(AVG(s.price)) AS av_susc,
	MOD(SUM(s.duration_sub), 42)) AS ft

FROM 
	db_sescolas.subscription s;
