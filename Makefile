artisan migrate:
	docker exec -ti hexagonal-app php artisan migrate --path=/app/Shared/Infrastructure/Database/Migrations

artisan rollback:
	docker exec -ti hexagonal-app php artisan migrate:rollback --path=/app/Shared/Infrastructure/Database/Migrations

