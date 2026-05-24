# PHP Mini Medical Supplies Router

PHP Lab03 - Front Controller, Router & Standard Response.

Ứng dụng được đổi từ bài mẫu Mini Product Routing App sang **Mini Medical Supplies Routing App**.

## Yêu cầu môi trường

```bash
php -v
composer --version
git --version
```

## Cài đặt

```bash
composer dump-autoload
```

> Nếu máy chưa cài Composer, project vẫn có fallback autoload đơn giản trong `public/index.php` để dễ chạy thử. Khi nộp bài vẫn nên chạy `composer dump-autoload` đúng yêu cầu Lab.

## Chạy chương trình

```bash
php -S localhost:8000 -t public public/index.php
```

Mở trình duyệt:

```text
http://localhost:8000
```

## Routes chính

| Method | URL | Controller@Action | Response |
|---|---|---|---|
| GET | `/` | `HomeController@index` | HTML |
| GET | `/health` | `HealthController@index` | JSON |
| GET | `/supplies` | `SupplyController@index` | HTML |
| GET | `/supplies/create` | `SupplyController@create` | HTML form |
| POST | `/supplies` | `SupplyController@store` | Redirect |
| GET | `/login` | `AuthController@login` | HTML |
| POST | `/login` | `AuthController@handleLogin` | Redirect |
| GET | `/logout` | `AuthController@logout` | Redirect |
| GET | `/go-home` | `HomeController@goHome` | Redirect |

## Test nhanh bằng curl

```bash
curl -i http://localhost:8000/
curl -i http://localhost:8000/health
curl -i http://localhost:8000/supplies
curl -i http://localhost:8000/go-home
curl -i http://localhost:8000/unknown
curl -i -X POST http://localhost:8000/health
curl -i -X POST http://localhost:8000/supplies \
  -d "name=Surgical Mask" \
  -d "group=Personal Protection" \
  -d "supplier=MedCare Vietnam" \
  -d "unit_price=85000" \
  -d "quantity=20"
```

## Git

```bash
git init
git add .
git commit -m "init: create medical supplies routing app"
git branch -M main
git remote add origin https://github.com/USERNAME/php-mini-medical-supplies-router.git
git push -u origin main
```