# Todo App

This is a simple Todo application.

## Features

- Add new tasks
- Mark tasks as completed
- Delete tasks

## Requirements
- PHP 8.3 or higher
- Composer
- MySQL


## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/farhodovbobur/Todo.git
    cd Todo
    ```

2. Install dependencies using Composer:
    ```shell
    composer install
    ```
3. Set up the database:
    - Create a MySQL database named `todo`.
    ```shell
      mysqlq -u root -p 
      CREATE DATABASE todo;
      USE todo;
      
      CREATE TABLE your_table_name (
         id INT AUTO_INCREMENT PRIMARY KEY,
         user VARCHAR(255) NOT NULL,
         text VARCHAR(255) NOT NULL,
         status INT
         );
   ```
## Usage

### Web Interface
1. Start a local PHP server:
    ```shell
    php -S localhost:9999
    ```
   
2. Open your browser and navigate to `http://localhost:9999`.

### Request and Response

- We use postman app to send request
- Download postman app - https://www.postman.com/downloads/

### Postman Documentation

https://documenter.getpostman.com/view/36894843/2sA3kaByDV
   
## Authors

- Farhodov Bobur - `farhodovbobur`

## License

- This project is licensed under the MIT License - see the LICENSE file for details.

