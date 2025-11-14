<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Haiseven API Auth (Sanctum)

This backend exposes a basic authentication API using Laravel Sanctum personal access tokens.

### Endpoints

- `POST /api/register` → body: `{ name, email, password }` → returns `{ token, token_type, user }`
- `POST /api/login` → body: `{ email, password }` → returns `{ token, token_type, user }`
- `POST /api/logout` → Authorization: `Bearer <token>` → revokes current token
- `GET /api/user` → Authorization: `Bearer <token>` → returns the current user

#### Productivity Tools

- Daily Focus
	- `POST /api/focus` (auth) → body: `{ items: [{ content: string, completed?: boolean, order?: number }] }` stores today's focus list (replaces existing for today)
	- `GET /api/focus/today` (auth) → returns `{ date, items: [...] }`
	- `GET /api/focus/history?limit=10` (auth) → returns array of previous days with counts

- Gratitude Jar
	- `POST /api/gratitude` (auth) → body: `{ content: string }` → creates a new gratitude entry
	- `GET /api/gratitude` (auth) → returns user's entries (latest first)

- Morning Page (3-minute brain dump)
	- `POST /api/morning-page` (auth) → body: `{ content: string }` → upserts entry for today's date

Example (fish shell):

```fish
# Login
set TOKEN (curl -s -X POST $API"/api/login" \
	-H "Accept: application/json" \
	-H "Content-Type: application/json" \
	-d '{"email":"me@example.com","password":"secret"}' | jq -r .token)

# Save focus
curl -s -X POST $API"/api/focus" \
	-H "Accept: application/json" -H "Content-Type: application/json" \
	-H "Authorization: Bearer $TOKEN" \
	-d '{"items":[{"content":"Task A"},{"content":"Task B","completed":true}]}' | jq .

# Gratitude
curl -s -X POST $API"/api/gratitude" \
	-H "Accept: application/json" -H "Content-Type: application/json" \
	-H "Authorization: Bearer $TOKEN" \
	-d '{"content":"Bersyukur udara pagi."}' | jq .

# Morning page
curl -s -X POST $API"/api/morning-page" \
	-H "Accept: application/json" -H "Content-Type: application/json" \
	-H "Authorization: Bearer $TOKEN" \
	-d '{"content":"Brain dump ..."}' | jq .
```

### Setup

1. Install dependencies and Sanctum:

	- Composer dependencies include `laravel/sanctum` in `composer.json`. Run composer install/update in your environment.
	- Run migrations to create `personal_access_tokens` table:

	  ```bash
	  # fish shell example
	  php artisan vendor:publish --provider=Laravel\Sanctum\SanctumServiceProvider
	  php artisan migrate
	  php artisan db:seed --class=Database\\Seeders\\UserSeeder
	  ```

2. Configure CORS origins in `.env` (optional, defaults to localhost + haiseven.com):

	```bash
	# fish
	set -Ux CORS_ALLOWED_ORIGINS "http://localhost:3000,https://haiseven.com"
	```

The rest of the default Laravel README follows.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
