# Symfony 6 Movies API

A basic RESTful API built with Symfony 6 framework, managing movies and their related genres and countries.

---

## Overview

This project provides CRUD operations on three main entities:
- **Movie**: Represents a film with its details.
- **Genre**: Represents a film genre, e.g., Action, Comedy, Drama.
- **Country**: Represents a country where the movie was produced.

---

## Endpoints

### Movie
- `GET /movies`: Retrieve a list of all movies.
- `GET /movies/pagination?page={num}&limit={num}&title={string}`: Retrieve a paginated list of movies with title search filter.
- `GET /movies/{id}`: Retrieve a movie by its ID.
- `GET /movies/by-genre/{genre}`: Retrieve movies by genre.
- `GET /movies/by-country/{country}`: Retrieve movies by country.
- `GET /movies/by-genre-and-country/{genre}/{country}`: Retrieve movies by both genre and country.
- `POST /movies`: Create a new movie.
- `PUT /movies/{id}`: Update an existing movie by its ID.
- `DELETE /movies/{id}`: Delete a movie by its ID.

### Genre
(Endpoints for Genre entity are not provided in the given code, but here's a suggested structure):

- `GET /genres`: Retrieve a list of all genres.
- `GET /genres/{id}`: Retrieve a genre by its ID.
- `POST /genres`: Create a new genre.
- `PUT /genres/{id}`: Update a genre by its ID.
- `DELETE /genres/{id}`: Delete a genre by its ID.

### Country
(Endpoints for Country entity are not provided in the given code. Here's a suggested structure):

- `GET /countries`: Retrieve a list of all countries.
- `GET /countries/{id}`: Retrieve a country by its ID.
- `POST /countries`: Create a new country.
- `PUT /countries/{id}`: Update a country by its ID.
- `DELETE /countries/{id}`: Delete a country by its ID.

---

## Installation and Setup
1. Clone the repository: `git clone [repository_url]`.
2. Navigate to the project directory: `cd project_directory`.
3. Install the dependencies: `composer install`.
4. Set up your environment variables in `.env` or `.env.local`.
5. Run the database migrations: `bin/console doctrine:migrations:migrate`.
6. Start the Symfony development server: `symfony server:start`.

