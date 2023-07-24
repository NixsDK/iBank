# iBank Project Setup
Welcome to the iBank project! This document provides step-by-step instructions to help you set up and run the project on your local machine.
# Key Features
Two-Factor Authentication (2FA): iBank prioritizes user security by implementing a Two-Factor Authentication mechanism, providing an extra layer of protection for user logins and transactions.

Bank Account Management: Users can easily manage their traditional bank accounts, view balances, and perform various financial operations effortlessly.

Investment Account Support: iBank goes beyond traditional banking by allowing users to manage their investment accounts within the same application. This seamless integration simplifies users' financial management.

Cryptocurrency Transactions: As a forward-thinking banking solution, iBank facilitates buying and selling of cryptocurrencies. Users can explore the world of digital assets through the application's user-friendly interface.

MySQL Database Integration: The application stores and manages data using the reliable and efficient MySQL database, ensuring data integrity and performance.

API Integration: iBank integrates two APIs to enhance functionality. The first API is dedicated to retrieving real-time currency exchange rates, while the second API provides up-to-date information on various cryptocurrencies, enabling users to make informed decisions.

#Page screenshots
![image](https://github.com/NixsDK/iBank/assets/124685876/0cce6718-685e-442b-b6ab-9b9394ac8479)
![image](https://github.com/NixsDK/iBank/assets/124685876/10c5a561-5223-45ed-84e9-b3b78f8d9750)
![image](https://github.com/NixsDK/iBank/assets/124685876/79b92e1c-2b0b-491a-80a8-9d378352265c)
![image](https://github.com/NixsDK/iBank/assets/124685876/7789ba66-50bd-49f7-9ae5-c1c2f8b49742)
![image](https://github.com/NixsDK/iBank/assets/124685876/12a2e1b0-1e2c-4a67-85f4-74e969f68642)
![image](https://github.com/NixsDK/iBank/assets/124685876/9d971c83-7c0e-4f8e-ba79-6fa0007a7e10)
![image](https://github.com/NixsDK/iBank/assets/124685876/9b1ba1ff-fb88-4292-9154-89858d41a798)
![image](https://github.com/NixsDK/iBank/assets/124685876/25c99e51-d345-4275-9d0d-ce7410029f41)
![image](https://github.com/NixsDK/iBank/assets/124685876/8915ac48-9d3c-4c1f-864b-d6aed578a16f)
![image](https://github.com/NixsDK/iBank/assets/124685876/631c1629-1ec2-40e8-bc5c-9862aa103ac3)

#Prerequisites
Before you begin, ensure that you have the following prerequisites installed on your system:

PHP (>= 7.3)
Composer
MySQL
CoinMarketCap API Key (sign up at https://coinmarketcap.com/api/)

#Installation

1.Clone the repository to your local machine:
git clone https://github.com/NixsDK/iBank.git

2.Navigate to the project directory:
cd ibank

3.Install the project dependencies:
composer install

4.Create a copy of the .env.example file and rename it to .env:

5.Open the .env file and set the following variables:

DB_DATABASE: Your MySQL database name.
DB_USERNAME: Your MySQL database username.
DB_PASSWORD: Your MySQL database password.
COINMARKETCAP_API_KEY: Your CoinMarketCap API key.

6.Generate an application key:
php artisan key:generate

7.Run the database migrations:
php artisan migrate

#Running the Application

1.Start the local development server:
php artisan serv
2.Open the application in your browser

