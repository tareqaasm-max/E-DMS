# Production Deployment Guide

## 1) Environment Setup
- Ubuntu 22.04+
- Nginx + PHP-FPM 8.2
- MySQL 8
- Redis (cache + queues)
- Supervisor

## 2) App Bootstrap
- `composer install --no-dev --optimize-autoloader`
- `cp .env.example .env`
- Configure DB, cache, mail, queue
- `php artisan key:generate`
- `php artisan migrate --force --seed`

## 3) Performance
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- Enable OPCache

## 4) Queue + Scheduler
- Supervisor command: `php artisan queue:work --sleep=3 --tries=3`
- Cron: `* * * * * php /var/www/edms/artisan schedule:run`

## 5) Storage and Security
- Use object storage for files (S3/minio)
- Use signed URL downloads
- Set HTTPS and secure cookies
- Rotate app keys/secrets via secret manager

## 6) Backup
- Daily MySQL dumps
- Incremental storage snapshots
- Test restores monthly
