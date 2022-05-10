@start /b "" apache\bin\httpd.exe

# Change to the project directory
# cd poker

# Install/Update composer dependancies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run tests of the app
php poker test

php poker


php poker play

start
