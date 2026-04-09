# E-DMS (Engineering Document Management System)

Production-oriented SaaS starter for engineering document control, built with Laravel architecture patterns (modular folders, service layer, RBAC, audit logging, API-first design).

## Current Environment Note

This codebase is fully generated, but runtime commands could not be executed in this machine because `php`, `composer`, and `node` are not installed in PATH.

## Features Implemented

- Authentication scaffolding endpoints and role-aware user model
- RBAC foundations: roles, permissions, role assignments
- Project module with team assignment and status tracking
- Document module with metadata, versioning, folder hierarchy, and tags
- Workflow approvals with multi-level status trail
- Transmittals (incoming/outgoing) with document linking
- Dashboard and reports APIs
- Audit logs and notification table support
- Secure download placeholder and encryption-ready model fields
- Seeders for initial roles, permissions, and sample data

## Stack

- Backend: Laravel 11+ structure
- Database: MySQL
- Frontend: Blade admin starter with RTL-friendly layout hook
- API: REST endpoints under `/api/v1`

## Installation

1. Install prerequisites:
   - PHP 8.2+
   - Composer 2+
   - Node.js 20+
   - MySQL 8+
2. Install dependencies:
   - `composer install`
   - `npm install`
3. Configure environment:
   - `copy .env.example .env`
   - Set DB credentials and app settings
   - `php artisan key:generate`
4. Run database:
   - `php artisan migrate --seed`
5. Serve:
   - `php artisan serve`
6. Optional frontend build:
   - `npm run build`

## Deployment (Production)

1. Provision Linux server with Nginx, PHP-FPM 8.2+, MySQL, Redis.
2. Clone source and run:
   - `composer install --no-dev --optimize-autoloader`
   - `php artisan migrate --force`
   - `php artisan config:cache`
   - `php artisan route:cache`
   - `php artisan view:cache`
3. Queue and scheduler:
   - Supervisor for `php artisan queue:work`
   - Cron: `* * * * * php /var/www/edms/artisan schedule:run`
4. File storage:
   - Set `FILESYSTEM_DISK=s3` (recommended) for scalable secure storage.
5. Backups:
   - Run nightly DB + storage backups (see `docs/deployment.md`).

## Module Map

- `app/Modules/Auth`
- `app/Modules/Projects`
- `app/Modules/Documents`
- `app/Modules/Workflow`
- `app/Modules/Transmittals`
- `app/Modules/Reports`
- `app/Modules/Dashboard`
- `app/Modules/Shared`

## Notes

- OCR, visual workflow builder, and e-sign are prepared via extension points (`services` + DB entities), with implementation stubs for integration.
- This is architected for SaaS multi-project operation and can be extended to full multi-tenant isolation (database-per-tenant or row-level tenancy).
