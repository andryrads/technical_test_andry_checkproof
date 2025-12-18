## PHP Code Test - Andry Rachdian Sumardi

Laravel Version : 12

The goal is to show code clarity, structure, naming, and maintainability. 

### Implementation

-  `POST /api/users`: validate input, create user, send welcome + admin email notification, return user.

-  `GET /api/users`: list active users with search/sort/pagination, include `orders_count` and `can_edit` per role.

### Architecture (Clean Architecture)

- **HTTP**: controllers, requests, resources (`app/Http`).

- **Application / Services**: use cases + contracts + permission service (`app/Services`).

- **Data**: models + Eloquent repositories (`app/Models`, `app/Repositories`).

- **Mail**: mailables + mailer implementation (`app/Mail`).

- **Policy**: `UserPolicy` uses `UserPermissionService`, `AuthServiceProvider` mapping.

- **Routing/Bootstrap**: `routes/api.php` loaded via `bootstrap/app.php`.

### Auth

- Using Laravel Sanctum personal access tokens.

- Token generated in `php artisan tinker` to be used in bearer token requests, the purpose is for testting the functionality of role control.

### Notes

-  `orders_count` comes from `OrderReadRepository`, only active users are listed.

-  `UserPermissionService` is the single source for edit rules, `UserPolicy@update` delegates to it.
