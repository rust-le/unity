# PostgreSQL


You may use docker-compose.yml file by ```docker compose up -d``` to create a Postgre 14 database.
Then log into Postgre console in container by ```docker container exec -it postgres psql -U postgres``` and create a database:
```sql
DROP TABLE IF EXISTS authors, books, reviews;
    
CREATE TABLE authors (
    author_id SERIAL PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    UNIQUE (first_name, last_name)
);

CREATE TABLE books (
    book_id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    publication_year INT NOT NULL,
    isbn VARCHAR(13) UNIQUE NOT NULL,
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    review_id SERIAL PRIMARY KEY,
    rating INT CHECK (rating BETWEEN 1 AND 10),
    content TEXT,
    book_id INT NOT NULL,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
);
```
And then fill them with sample data:
```sql
INSERT INTO authors (first_name, last_name) VALUES
('Stanisław', 'Lem'),
('Andrzej', 'Sapkowski'),
('Jacek', 'Dukaj'),
('Rafał', 'Kosik'),
('Anna', 'Kańtoch'),
('Maja', 'Lidia Kossakowska'),
('Jarosław', 'Grzędowicz'),
('Michał', 'Gołkowski'),
('Robert', 'M. Wegner'),
('Łukasz', 'Orbitowski');

INSERT INTO books (title, publication_year, isbn, author_id) VALUES
('Solaris', 1961, '9780156027601', 1),
('Cyberiada', 1965, '9780156027595', 1),
('Wiedźmin', 1993, '9780316029186', 2),
('Chrzest ognia', 1996, '9780316219180', 2),
('Lód', 2007, '9788374693157', 3),
('Czarne oceany', 2001, '9788374693158', 3),
('Felix, Net i Nika', 2004, '9788374693159', 4),
('Vertical', 2006, '9788374693160', 4),
('Piąta pora roku', 2005, '9788374693161', 5),
('Ostatnie życzenie', 1993, '9788374693162', 2),
('Wieża Jaskółki', 2002, '9788374693163', 2),
('Cień torturowanego', 1980, '9788374693164', 6),
('Kieł koncyliatora', 1981, '9788374693165', 6),
('Miecz przeznaczenia', 1992, '9788374693166', 2),
('Żmija', 1993, '9788374693167', 2),
('Czas pogardy', 1995, '9788374693168', 2),
('Pani Jeziora', 1999, '9788374693169', 2),
('Coś się kończy', 1997, '9788374693170', 2),
('Sezon burz', 2013, '9788374693171', 2),
('Krew Elfów', 1993, '9788374693172', 2);

INSERT INTO reviews (rating, content, book_id) VALUES
(1, 'Ależ to jest gniot...', 1),
(9, 'Niesamowita historia.', 2),
(7, 'Bardzo interesująca.', 3),
(10, 'Uwielbiam!', 4),
(6, 'Dobra lektura.', 5),
(8, 'Dobrze napisana.', 6),
(9, 'Fantastyczna!', 7),
(7, 'Podobało mi się.', 8),
(10, 'Gorąco polecam.', 9),
(6, 'Nieźle.', 10),
(8, 'Świetna książka!', 11),
(9, 'Niesamowita historia.', 12),
(7, 'Bardzo interesująca.', 13),
(10, 'Uwielbiam!', 14),
(6, 'Dobra lektura.', 15),
(8, 'Dobrze napisana.', 16),
(9, 'Fantastyczna!', 17),
(7, 'Podobało mi się.', 18),
(10, 'Gorąco polecam.', 19),
(6, 'Nieźle.', 20);
```
Query that returns authors first and second names with the number of books they have written:

```sql
SELECT
    a.first_name,
    a.last_name,
    COUNT(b.book_id) AS book_count
FROM
    authors a
        LEFT JOIN
    books b ON a.author_id = b.author_id
GROUP BY
    a.author_id
ORDER BY
    book_count DESC;
```
Returned data:

| first_name | last_name         | book_count |
|------------|-------------------|------------|
| Andrzej    | Sapkowski         | 11         |
| Jacek      | Dukaj             | 2          |
| Stanisław  | Lem               | 2          |
| Rafał      | Kosik             | 2          |
| Maja       | Lidia Kossakowska | 2          |
| Anna       | Kańtoch           | 1          |
| Michał     | Gołkowski         | 0          |
| Łukasz     | Orbitowski        | 0          |
| Jarosław   | Grzędowicz        | 0          |
| Robert     | M. Wegner         | 0          |
And finally, query creating a view containing 5 authors whose average rating of all books is the highest: 

```sql
CREATE VIEW top_authors_by_avg_rating AS
SELECT
    a.author_id,
    a.first_name,
    a.last_name,
    ROUND(AVG(r.rating),2) AS avg_rating
FROM
    authors a
        JOIN
    books b ON a.author_id = b.author_id
        JOIN
    reviews r ON b.book_id = r.book_id
GROUP BY
    a.author_id, a.first_name, a.last_name
ORDER BY
    avg_rating DESC
LIMIT 5;
```
Then, simply use:
```sql
SELECT * FROM top_authors_by_avg_rating;
```
Returned data:

| author_id | first_name | last_name         | avg_rating |
|-----------|------------|-------------------|------------|
| 5         | Anna       | Kańtoch           | 10.00      |
| 4         | Rafał      | Kosik             | 8.00       |
| 6         | Maja       | Lidia Kossakowska | 8.00       |
| 2         | Andrzej    | Sapkowski         | 7.91       |
| 3         | Jacek      | Dukaj             | 7.00       |
