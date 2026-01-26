# Todo List API
## Introduction
A simple API for managing todo list. Based on Laravel framework version 12.

## Installation
1. Clone the repository.
2. Run `composer install` to install dependencies.
3. If you haven't built the image before run `./vendor/bin/sail build --no-cache`.
4. Run `./vendor/bin/sail up` to start the server.
5. Run `./vendor/bin/sail php -v` to check php version.
6. Run `./vendor/bin/sail artisan migrate --seed` to create database tables and test user with a Bearer token.
   It will display the email password and token of the test user in the console.
7. Open `http://localhost` in your browser and login with credentials.
8. Via Postman in Authorization tab, select Bearer Token and paste the token.
9. Send GET request to `/tasks` to get a list of tasks.

## Authentication
This App uses Laravel Sanctum authentication system to make requests as auth user. 
To create a new user, use web routes and then create a token using `tinker`
```
    $token = $user->createToken($request->token_name);

    echo $token->plainTextToken;
```
or with in seeding the database with `./vendor/bin/sail artisan db:seed` command.
After that you can use the token for authorization in the header. 
`plainTextToken` is shown only once while creating a new token.

## API Endpoints
- GET|HEAD `/tasks` - get a list of tasks.
- POST `/tasks` - create a new task.
- PUT|PATCH `/tasks/{id}` - update task by id.
- DELETE `/tasks/{id}` - delete task by id.
- PATCH `/tasks/{id}/complete` - mark task as completed.

## Search, Sorting and Filters
Search, sorting and filters can be applied to get the list of tasks, add the following parameters to `/tasks` GET request:
  - `search={value}` - specified needed value.
  - `sort={value}` - where value is needed field. To specify asc/desc sorting, add `-` to the begining of value, for example `-completedAt`
  - `filter[name]={value}` and `filter[value]={value}` - to apply filters.

## TODO
 - Use new PHP and Laravel features
 - Think the best way to validate the model state before perform different actions on it, it should be reusable in 
   controller and in views as well. Maybe it can be done like Gate policies.
 - Refactor Sort And Filter logic, separate query building from the repository.
