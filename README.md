# PHP Exercises

In this repository I'm gonna implement some design principles and good practices with PHP.

In the first version I'll not use any framework or library, only the default functions in PHP.

Feel free to post an Issue if you think that something is not right.

## Running the project

Enter the `web` page and run the following comando to start the PHP development server in the port `8080`.

```bash
php -S localhost:8080
```

## Versions

### v1.0

In version v1.0 I've implemented a simple login/logout flow. The main aspects there are presented in this version are separation of responsibilities, correct level of abstraction, user input sanitization and output scaping.

### v1.1

In this version I've implemented a simple support view with a form and the message history. This version emphasis form validation and session manipulation, including protection with CSRF token and user access level validation.
