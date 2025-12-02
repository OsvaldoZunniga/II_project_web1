<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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


# Notes #
**Para inicializar el proyecto se debe ejecutar**
```
php artisan migrate
```

Esto creará las tablas faltantes a la base de datos.



# In Charge of: #
### Coffe ###
- ~~CRUD Users~~
- Admin
- ~~rides~~ agregar boton para que el chofer inicialice ride
- ~~Reservas~~
### BranchK ###
- ~~Registro~~
- ~~logIN~~
- ~~Vehiculos~~
- ~~publicPage~~

### ?? ###
- Auditoria
- PassLess

```
II_project_web1
├─ projectII_web
│  ├─ .editorconfig
│  ├─ .env
│  ├─ .gitattributes
│  ├─ .gitignore
│  ├─ app
│  │  ├─ Http
│  │  │  ├─ Controllers
│  │  │  │  ├─ AuthController.php
│  │  │  │  ├─ BookingController.php
│  │  │  │  ├─ Controller.php
│  │  │  │  ├─ DashboardController.php
│  │  │  │  ├─ PassengerController.php
│  │  │  │  ├─ ProfileController.php
│  │  │  │  ├─ PublicRidesController.php
│  │  │  │  ├─ RideController.php
│  │  │  │  ├─ UserController.php
│  │  │  │  └─ VehicleController.php
│  │  │  └─ Middleware
│  │  │     └─ AuthenticateUser.php
│  │  ├─ Models
│  │  │  ├─ Booking.php
│  │  │  ├─ Ride.php
│  │  │  ├─ Role.php
│  │  │  ├─ User.php
│  │  │  └─ Vehicle.php
│  │  ├─ Providers
│  │  │  └─ AppServiceProvider.php
│  │  └─ Services
│  │     ├─ AuthService.php
│  │     ├─ bookingService.php
│  │     ├─ EmailService.php
│  │     ├─ FileUploadService.php
│  │     ├─ ProfileService.php
│  │     ├─ RideService.php
│  │     ├─ UserService.php
│  │     └─ VehicleService.php
│  ├─ artisan
│  ├─ bootstrap
│  │  ├─ app.php
│  │  ├─ cache
│  │  │  ├─ .gitignore
│  │  │  ├─ packages.php
│  │  │  └─ services.php
│  │  └─ providers.php
│  ├─ composer.json
│  ├─ composer.lock
│  ├─ config
│  │  ├─ app.php
│  │  ├─ auth.php
│  │  ├─ cache.php
│  │  ├─ database.php
│  │  ├─ filesystems.php
│  │  ├─ logging.php
│  │  ├─ mail.php
│  │  ├─ queue.php
│  │  ├─ services.php
│  │  └─ session.php
│  ├─ database
│  │  ├─ .gitignore
│  │  ├─ database.sqlite
│  │  ├─ factories
│  │  │  └─ UserFactory.php
│  │  ├─ migrations
│  │  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  │  ├─ 2025_11_28_051326_create_roles_table.php
│  │  │  ├─ 2025_11_28_051405_create_usuarios_table.php
│  │  │  ├─ 2025_11_28_051417_create_vehiculos_table.php
│  │  │  ├─ 2025_11_28_051427_create_ride_table.php
│  │  │  └─ 2025_11_28_051445_create_reserva_table.php
│  │  └─ seeders
│  │     └─ DatabaseSeeder.php
│  ├─ package.json
│  ├─ phpunit.xml
│  ├─ pnpm-lock.yaml
│  ├─ pnpm-workspace.yaml
│  ├─ public
│  │  ├─ .htaccess
│  │  ├─ assets
│  │  │  ├─ 1764110915_1761284793_Snoopy.jpg
│  │  │  ├─ 1764111622_1761458026_Charlie_Brown.png
│  │  │  ├─ default-profile.png
│  │  │  └─ logo.jpg
│  │  ├─ css
│  │  │  └─ login.css
│  │  ├─ database
│  │  │  ├─ db.sql
│  │  │  ├─ functions.sql
│  │  │  └─ usefulqueries.sql
│  │  ├─ favicon.ico
│  │  ├─ index.php
│  │  └─ robots.txt
│  ├─ resources
│  │  ├─ css
│  │  │  └─ app.css
│  │  ├─ js
│  │  │  ├─ app.js
│  │  │  └─ bootstrap.js
│  │  └─ views
│  │     ├─ auth
│  │     │  ├─ login.blade.php
│  │     │  └─ register.blade.php
│  │     ├─ components
│  │     │  ├─ ride-card-base.blade.php
│  │     │  ├─ ride-card-driver.blade.php
│  │     │  ├─ ride-card-passenger.blade.php
│  │     │  └─ ride-card-public.blade.php
│  │     ├─ dashboard
│  │     │  ├─ admin
│  │     │  ├─ driver
│  │     │  │  ├─ reservations
│  │     │  │  ├─ rides
│  │     │  │  │  ├─ add.blade.php
│  │     │  │  │  ├─ edit.blade.php
│  │     │  │  │  └─ list.blade.php
│  │     │  │  └─ vehicles
│  │     │  │     ├─ add.blade.php
│  │     │  │     ├─ card.blade.php
│  │     │  │     ├─ edit.blade.php
│  │     │  │     └─ list.blade.php
│  │     │  ├─ main.blade.php
│  │     │  ├─ navs
│  │     │  │  ├─ nav-admin.blade.php
│  │     │  │  ├─ nav-chofer.blade.php
│  │     │  │  └─ nav-pasajero.blade.php
│  │     │  ├─ passenger
│  │     │  │  ├─ my-reservations.blade.php
│  │     │  │  └─ search-rides.blade.php
│  │     │  └─ profile
│  │     │     └─ edit.blade.php
│  │     ├─ public
│  │     │  └─ rides.blade.php
│  │     └─ welcome.blade.php
│  ├─ routes
│  │  ├─ console.php
│  │  └─ web.php
│  ├─ storage
│  │  ├─ app
│  │  │  ├─ .gitignore
│  │  │  ├─ private
│  │  │  │  └─ .gitignore
│  │  │  └─ public
│  │  │     └─ .gitignore
│  │  ├─ framework
│  │  │  ├─ .gitignore
│  │  │  ├─ cache
│  │  │  │  ├─ .gitignore
│  │  │  │  └─ data
│  │  │  │     └─ .gitignore
│  │  │  ├─ sessions
│  │  │  │  └─ .gitignore
│  │  │  ├─ testing
│  │  │  │  └─ .gitignore
│  │  │  └─ views
│  │  │     └─ .gitignore
│  │  └─ logs
│  │     ├─ .gitignore
│  │     └─ laravel.log
│  ├─ tests
│  │  ├─ Feature
│  │  │  └─ ExampleTest.php
│  │  ├─ TestCase.php
│  │  └─ Unit
│  │     └─ ExampleTest.php
│  └─ vite.config.js
└─ readme.md

```