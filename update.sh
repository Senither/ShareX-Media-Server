# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
git pull origin master

# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear

# Clear and cache routes
php artisan route:cache

# Clear and cache config
php artisan config:cache

# Clear and cache views
php artisan view:cache

# Restart queue workers
php artisan queue:restart

# Install/update node modules
yarn install

# Build new assets
yarn prod

# Turn off maintenance mode
php artisan up
