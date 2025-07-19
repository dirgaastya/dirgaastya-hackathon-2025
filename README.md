# 06. Personal Finance Tracker
    1. Stack : Laravel 10 + Vue
    2. Fitur :
        - UI Summary Chart Category per bulan & Outcome per bulan
        - UI List Transaction & Pagination
    3. Instalasi :
        - Backend :
            1. Composer Install
            2. Php artisan generate:key
            3. Php artisan migrate
            4. Php aritsan db:seed CategorySeeder
            5. Php aritsan db:seed TransactionSeeder
            5. Php artisan Serve
        - Frontend:
            1. Npm Install
            2. Npm run dev
    4. Import Transcation WEB UI


# 03. Postgres Query Optimizer
    1. Persiapan data -> Dataset Salaries Data Science, ML & AI Job Sebanyak 10 Juta Data (Terdapat pada file salaries.csv)
    2. Tujuan dari Query Mencari Rata Rata Gaji berdasarkan tahun kerja, level dan tipe pekerja. Sebelum Optimasi didapatkan waktu sekitar 03.116 detik
``` sql
    SELECT job_title, AVG(salary) FROM salaries
    WHERE work_year between 2023 AND 2024
    AND experience_level IN ('EN', 'MI')
    AND employment_type = 'FT'
    GROUP BY job_title
    ORDER BY AVG(salary) desc
```
    3. Langkah Optimasi yang saya lakukan ialah membuat materiliazed view agar datanya tersimpan sehingga tidak perlu menjalankan query berulang ulang.

```sql
    CREATE MATERIALIZED VIEW average_salaries AS
    SELECT job_title, work_year, experience_level, employment_type, AVG(salary) AS avg_salary
    FROM salaries
    GROUP BY job_title, work_year, experience_level, employment_type;

```

4. Setelah itu Jalankan querynya kembali

``` sql
SELECT * FROM average_salaries
WHERE work_year between 2022 AND 2024
AND experience_level IN ('EN', 'MI')
AND employment_type = 'FT'
ORDER BY avg_salary desc

```

5. Hasil yang didapatkan menjadi 0.142
