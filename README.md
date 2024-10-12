
# GitHub API Challenge

## Introduction

This project is a Laravel application that interacts with the GitHub API, allowing users to create and delete repositories via console commands and list them through a REST API endpoint. The application follows a Domain-Driven Design (DDD) approach and includes Swagger documentation for the API.

## Requirements

- PHP 8.3 or higher
- Docker and Docker Compose
- Git
- GitHub Personal Access Token

## Getting Started

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/your-username/github-api-challenge.git
cd github-api-challenge
```

### 2. Set Up Environment Variables

Create a `.env` file by copying the provided `.env.example` file:

```bash
cp .env.example .env
```

Next, set the necessary environment variables in your `.env` file:

- Add your **GitHub Personal Access Token** to interact with GitHub:

  ```env
  GITHUB_ACCESS_TOKEN=your_github_personal_access_token
  ```

- Configure your database connection:

  ```env
  DB_CONNECTION=mysql
  DB_HOST=db
  DB_PORT=3306
  DB_DATABASE=your_database
  DB_USERNAME=your_username
  DB_PASSWORD=your_password
  ```

### 3. Set Up Docker

Build and start the Docker containers using the provided `docker-compose.yml` file:

```bash
docker-compose up -d
```

This will start the following containers:

- **laravel_app**: For running the Laravel PHP application.
- **mysql_db**: MySQL database container.

### 4. Install Dependencies

After the containers are up and running, install the PHP dependencies using Composer:

```bash
docker exec -it laravel_app composer install
```

### 5. Set Up the Database

Run the migrations to set up the database schema:

```bash
docker exec -it laravel_app php artisan migrate
```

### 6. Generate API Documentation (Swagger)

Generate the Swagger documentation for the REST API:

```bash
docker exec -it laravel_app php artisan l5-swagger:generate
```

Swagger documentation will be available at: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

### 7. Access the Application

- **API Documentation**: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
- **List Repositories**: Send a GET request to `http://localhost:8000/api/repositories`

You can filter repositories by passing a `username` query parameter.

### 8. Console Commands

The following artisan commands are available for interacting with the GitHub API:

- **Create a GitHub Repository**:

  ```bash
  docker exec -it laravel_app php artisan create:github-repository --name="repository_name"
  ```

- **Delete a GitHub Repository**:

  ```bash
  docker exec -it laravel_app php artisan delete:github-repository --name="repository_name"
  ```

### 9. Running Tests

To run the project's integration tests, use the following command:

```bash
docker exec -it laravel_app php artisan test
```
