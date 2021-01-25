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

### v2.0

In this version I've added a breaking change, now the authenticated user is fetched from the database. Also there is a view and CRUD for contacts. This version emphasis the use of a database. You will need to have a MySQL database and create two table with the following code:

Users table:
```SQL
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_level` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'standard',
  `signup_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

Contacts table:
```SQL
CREATE TABLE `contacts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `name` varchar(254) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

In the development setup i've used a MySQL container with a Adminer instance, you can reproduce with the following `docker-compose.yml`:
```yml
version: '3.1'

services:
  db:
    image: mysql:8
    command: --default-authentication-plugin=mysql_native_password
    restart: always
    environment:
      MYSQL_USER: php-user
      MYSQL_PASSWORD: php-pass
      MYSQL_ROOT_PASSWORD: example
      MYSQL_ROOT_HOST: 172.*.*.*
    volumes:
      - ./data:/var/lib/mysql
    ports:
      - 3306:3306

  adminer:
    image: adminer
    restart: always
    ports:
      - 8080:8080
```

The database connections is handled in the `Database` component as a singleton. The queries are madded using the `php-pdo` extension.

The authentication is handled via the `Auth` component and it is responsible for checking if the user is authenticated, return an authenticated user and set the authenticated user.
