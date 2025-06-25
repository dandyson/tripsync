# Railway Environment Variables

Copy these into your Railway project's Variables tab:

## Required Variables
```
APP_NAME=TripSync
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-railway-domain.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=YOUR_MYSQL_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="TripSync"
```

## Railway-specific Variables
```
NIXPACKS_PKGS=php-redis php-gd
NIXPACKS_BUILD_CMD=chmod +x build.sh && ./build.sh
```

## Notes:
1. Replace `YOUR_MYSQL_HOST`, `YOUR_DATABASE_NAME`, etc. with actual values from your Railway MySQL service
2. The `APP_URL` should be your Railway domain (you'll get this after first deployment)
3. Generate an `APP_KEY` using: `php artisan key:generate --show` 
