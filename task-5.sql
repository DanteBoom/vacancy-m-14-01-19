/*part 1*/
/*
SELECT fullname, ROUND(100 -
                  (SELECT amount FROM transactions WHERE from_person_id=persons.id) +
                  (SELECT amount FROM transactions WHERE to_person_id=persons.id), 4) as balance
FROM `persons`
WHERE id=1
*/

/*part 2*/
/*looks strange, i know*/
/*
SELECT tmp.name
FROM (
	SELECT ct.name , COUNT(transaction_id) as number
	FROM transactions
	JOIN persons pr ON pr.id = from_person_id
	JOIN cities ct ON ct.id = pr.city_id
	GROUP BY ct.name
    ) as tmp
WHERE tmp.number IN (SELECT MAX(tmp2.number) FROM (
	SELECT COUNT(transaction_id) as number
	FROM transactions
	JOIN persons pr ON pr.id = from_person_id
	JOIN cities ct ON ct.id = pr.city_id
	GROUP BY ct.name
    ) as tmp2)
*/

/*part 3*/
/*
SELECT transaction_id
FROM transactions
JOIN persons p1
	ON p1.id=from_person_id
JOIN persons p2
	ON p2.id=to_person_id
WHERE p1.city_id = p2.city_id
 */
