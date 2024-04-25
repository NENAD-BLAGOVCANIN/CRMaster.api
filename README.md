
## Installation

For the second step to work you will have to install composer. Just download it online. And make sure the composer command works in your cmd/terminal

Steps:
1. Create a database with mysql workbench or some other tool you have. Name the database what you want.
2. Open the env file in the project folder and find the part where the database settings are. Replace the database name with your chosen name. And change your mysql password.
3. Open the project folder and run composer install --ignore-platform-reqs (let me know if you have problems with this step)
4. Then run php artisan migrate. This will create the database tables. You can check if this step worked by connecting to our created database with dbeaver or some other tool.
5. Create a jwt secret with the command: php artisan jwt:secret
6. After that you should be able to run the project with the command:
php artisan serve.
You might need to generate a token with the command php artisan key:generate. Let me know if any other error appear, I will help you. But this should be it.
