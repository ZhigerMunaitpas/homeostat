<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Homeostat

Музыкальная веб-платформа Homeostat: артисты загружают треки, слушатели ищут и прослушивают их, ставят лайки, комментируют, собирают плейлисты и подписываются на артистов. Каждый новый трек проходит модерацию администратором.

Проект выполняется в рамках курсовой работы по дисциплине «Основы backend-разработки».

## Стек

- PHP 8.3+, Laravel 11+
- MySQL 8
- Laravel Sanctum (токены для API)
- Blade-шаблоны для интерфейса
- Composer, Git

## Требования

- PHP 8.3 или выше с расширениями: pdo_mysql, mbstring, openssl, fileinfo, curl
- Composer 2
- MySQL 8
- Git

## Установка

```bash
git clone <ссылка на репозиторий> homeostat
cd homeostat
composer install
cp .env.example .env
```

Создайте пустую базу данных (например, `homeostat_app`) и укажите в `.env` параметры подключения: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Команда `--seed` заработает после появления сидеров (практическая работа 6). До этого используйте `php artisan migrate`.

Приложение будет доступно по адресу http://localhost:8000.

## Проверка

Откройте http://localhost:8000/api/health. При работающем подключении к БД вернётся JSON с кодом 200:

```json
{
  "app": "Homeostat",
  "time": "2026-11-03T12:00:00+06:00",
  "database": "ok"
}
```

Если база недоступна, маршрут вернёт код 503 и `"database": "error"`.

## Структура

| Каталог | Назначение |
|---|---|
| `app/Models` | Модели Eloquent |
| `app/Http` | Контроллеры, Form Request, API Resources |
| `app/Services` | Бизнес-логика |
| `app/Enums` | Перечисления (роли, статусы) |
| `database/migrations` | Миграции структуры БД |
| `routes/api.php` | API-маршруты |
| `resources/views` | Blade-шаблоны |

## База данных (КП5)

Структура БД создаётся миграциями, тестовые данные — сидерами, одной командой:

```sh
php artisan migrate:fresh --seed
```

Таблицы: `users` (с полями `role`, `bio`, `avatar_path`, `is_blocked`), `genres`, `tracks`, `playlists`, `comments`, `likes`,
промежуточные `playlist_track` (плейлист ↔ трек, с позицией) и `follows` (пользователь ↔ пользователь).
Перечисления: `App\Enums\UserRole` (`listener`, `artist`, `admin`) и `App\Enums\TrackStatus` (`pending`, `published`, `rejected`).

Тестовые учётные записи (пароль у всех — `password`):

| Роль | Email |
|---|---|
| Администратор | `admin@homeostat.test` |
| Исполнитель | `artist@homeostat.test` |
| Слушатель | `listener@homeostat.test` |
| Заблокированный слушатель | `blocked@homeostat.test` |

Проверка связей в `php artisan tinker`:

```php
Track::with(['artist', 'genre'])->first();
Playlist::with('tracks')->first()->tracks->pluck('pivot.position', 'title');
User::where('email', 'listener@homeostat.test')->with(['likedTracks', 'following'])->first();
```

Валидация входных данных описана в `app/Http/Requests` (сообщения на русском), формат ответов API — в `app/Http/Resources`
(пароль и `remember_token` скрыты через `$hidden` модели `User` и не входят в `UserResource`).

## Документация

Проектная документация (ТЗ, ER-диаграмма, физическая модель БД) хранится в каталоге `docs/`.
