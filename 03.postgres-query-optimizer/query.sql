-- Sebelum Optimasi
SELECT job_title, AVG(salary) FROM salaries
WHERE work_year between 2023 AND 2024
AND experience_level IN ('EN', 'MI')
AND employment_type = 'FT'
GROUP BY job_title
ORDER BY AVG(salary) desc


-- Setelah Optimasi
CREATE MATERIALIZED VIEW average_salaries AS
SELECT job_title, work_year, experience_level, employment_type, AVG(salary) AS avg_salary
FROM salaries
GROUP BY job_title, work_year, experience_level, employment_type;


-- Jalankan Query ini setelah membuat materialized view
SELECT * FROM average_salaries
WHERE work_year between 2022 AND 2024
AND experience_level IN ('EN', 'MI')
AND employment_type = 'FT'
ORDER BY avg_salary desc
