This blog platform, built with PHP/Laravel, it allows users to register, login and create blog posts.
Admin User can import posts from other blogs by providing the blog's REST API URL, and the frequency of import.
Cron job / scheduler runs every minute to import posts from other blogs.

Task details can be accessed [here](https://www.notion.so/Web-Developer-0cdf0bb1015d4e5c94b62b3fe61ee621).

## Technologies used
- Server application:
    - [Laravel](https://laravel.com/), A PHP web framework with focus on speed of development and perfectionism
    - [Docker](https://www.docker.com/), A set of platform as a service products that use OS-level virtualization to deliver software in packages called containers.
    - [Redis](https://redis.io/), in-memory data store which can be used as a database, cache, streaming engine, and message broker.
    - [Postman](https://www.getpostman.com/), a complete API development environment, and flexibly integrates with the software development cycle for API testing.

## Installation
### Local installation
Running this service locally requires you to download and install docker and docker-compose. You can do this by downloading
docker desktop from [here](https://www.docker.com/products/docker-desktop) and follow the instructions to install docker.
- Installation with docker
    - Download docker desktop from [here](https://www.docker.com/products/docker-desktop)
    - Install docker
    - Run docker-compose

- Basic installation:
    - Ensure Git is installed on your machine, then clone this repository by running `git clone https://github.com/MusahMusah/monolithic-blog.git` in the terminal.
    - Enter the directory with `cd monolithic-blog`
    - Create a `.env` file using the [.env.example](/.env.example) file as a template. All the appropriate values has been filled in the `.env.example`, but you can change the values to suit your environment if all the credentials in `docker-compose.yml` file are set.
    - Run `docker-compose up -d` to start the application. You can now access the application at `http://localhost:8001`.
    - Run `docker exec -it monolithic-app sh` to enter the container (for bash replace `sh` with `bash`).
    - Run `php artisan migrate --seed` to seed the database with default admin user access.

### Docker
If you've got Docker installed, edit the `.docker-compose.yml` file to your taste (you wouldn't need to except you hate me), then run `docker-compose build` and `docker-compose up -d` to spin up the server.

The application should be running on port `8081` at URL: `localhost:8081`.

## API Enpoints documentation
The application is built with RESTful API endpoints. No frontend is built due to the simplicity of the application and time constraints.

### The Login Endpoint
`POST /monolithic-blog/api/login` -> Log in the user.
- Admin User Credentials:
```json
{
    "email": "admin@admin.com",
    "password": "admin"
}
```
### The Registration Endpoint
`POST /monolithic-blog/api/register` -> Register a new user.
```json
{
    "email": "test@test.com",
    "password": "test",
    "name": "Test User"
}
```

## Testing 🚨
- For Automation Test Run the tests with `phpunit`
- Get the application up and running by following the instructions in the Installation Guide of this README.

## Discussion
This section contains justifications and improvements that should be made.

### Why Django
Oh well, Django is a favourite framework of mine and while I could have used Flask or something else, it's quite easy to set up a Django application and structure your application in a way that it can actually scale in production, as long as structure is concerned.

### Choice of Database
I choose Redis for the purpose of caching requests. Since Pokemon information doesn't and rarely changes, once a user has requested for an info, it can as well be cached to reduce network calls subsequently. This improves speed of the application

### Improvements for a production API
- Write tests with attention to non-framework specific features.

## Licence 🔐
[MIT licensed](/LICENSE) © [Musah Musah](https://github.com/MusahMusah)

## Credits 🙏
- Half of the Open Source Software community who contribute to the whole of the tools I use
- Guido Lord_Sarcastic, well, he's a good guy.
- Others who would be thanked by my smiles and Quora tags
