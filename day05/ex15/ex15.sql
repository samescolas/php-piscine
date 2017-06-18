SELECT REVERSE(SUBSTR(d.phone_number, 2, LENGTH(d.phone_number) - 1)) AS rebmunenohp
FROM db_sescolas.distrib d
WHERE d.phone_number LIKE '05%';
