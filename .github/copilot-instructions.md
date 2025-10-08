Project: Aztek_demo_Miadz (Laravel skeleton)

This repo is a Laravel 12.x application skeleton with Vite + Tailwind for frontend assets.
Keep instructions short and actionable so an AI agent can be productive immediately.

Key facts (big picture)
- Laravel MVC app: backend PHP (app/, routes/, database/). Frontend assets live under resources/ and are built with Vite (see `vite.config.js`).
- Database: SQLite file at `database/database.sqlite` used by default migrations/seeding in composer scripts.
- Tests: PHPUnit configured via `phpunit.xml`; `composer test` and `php artisan test` run the test suite.

Developer workflows / commands to run
- Install / setup (Windows PowerShell):
  - composer install; npm install
  - copy .env.example .env; php artisan key:generate
  - php artisan migrate
- Start development (single-machine): use the npm/dev script or the combined `composer dev` script which runs multiple services concurrently. Typical commands:
  - npm run dev   # starts Vite dev server
  - php artisan serve   # starts PHP dev server
  - composer dev   # runs a combined dev pipeline (concurrently)
- Build assets for production: npm run build
- Run tests: composer test  (this runs `php artisan test`)

Project conventions & patterns
- PSR-4 autoloading: App\ namespace maps to `app/` (see `composer.json`).
- Models, controllers and providers use standard Laravel locations: `app/Models`, `app/Http/Controllers`, `app/Providers`.
- Minimal bootstrap: `app/Providers/AppServiceProvider.php` is empty by default — add bindings here.
- Routes: HTTP routes in `routes/web.php`; simple closure-based route to `welcome` view.
- Database testing: `phpunit.xml` sets testing environment variables (DB uses `testing` and array/cache drivers). Tests expect an isolated environment.

Integration points & external dependencies
- Laravel framework (php ^8.2) — most logic uses framework services, facades and helper functions.
- Frontend: Vite + `laravel-vite-plugin` + Tailwind (`resources/js/app.js`, `resources/css/app.css`).
- Background/queues: composer `dev` runs `php artisan queue:listen`; production may use other queue drivers (config in `config/queue.php`).

Files to inspect when changing behavior
- Backend: `app/Models/*`, `app/Http/Controllers/*`, `app/Providers/*`, `routes/*.php`.
- Frontend: `resources/js/app.js`, `resources/css/app.css`, `vite.config.js`, `package.json` scripts.
- Migrations/seeders: `database/migrations/*`, `database/seeders/DatabaseSeeder.php`.

Examples / idioms for patches
- Add a route: update `routes/web.php` and add a controller in `app/Http/Controllers/`.
- Add a binding: put service container bindings in `app/Providers/AppServiceProvider.php::register`.
- Frontend change: update `resources/js/app.js` and `npm run dev` to preview.

Editing & testing checklist for pull requests
1. Run composer install and npm install locally.
2. Run migrations (or use in-memory/testing DB) and execute `composer test`.
3. Build assets with `npm run build` if frontend changes are included.
4. Keep edits limited to the least number of files; follow existing coding style.

If anything is ambiguous or you need runtime credentials, ask the maintainer rather than guessing (DB connection, third-party API keys, queue drivers).

Maintainers: check `README.md` and composer scripts for up-to-date developer steps.
