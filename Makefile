.PHONY: help up down logs build restart shell artisan npm

help: ## Display this help message
	@echo "Sehatin Docker Commands"
	@echo "======================"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

up: ## Start Docker containers
	docker-compose up -d
	@echo "Containers started! App: http://localhost"

down: ## Stop Docker containers
	docker-compose down

build: ## Build Docker images
	docker-compose build

rebuild: ## Rebuild Docker images from scratch
	docker-compose build --no-cache

restart: ## Restart Docker containers
	docker-compose restart

logs: ## View Docker logs
	docker-compose logs -f

logs-app: ## View app logs
	docker-compose logs -f app

logs-nginx: ## View nginx logs
	docker-compose logs -f nginx

shell: ## Open bash shell in app container
	docker-compose exec app bash

artisan: ## Run artisan command (use: make artisan cmd="migrate")
	docker-compose exec app php artisan $(cmd)

npm: ## Run npm command (use: make npm cmd="install")
	docker-compose exec app npm $(cmd)

migrate: ## Run database migrations
	docker-compose exec app php artisan migrate

migrate-fresh: ## Refresh database
	docker-compose exec app php artisan migrate:fresh

seed: ## Run database seeders
	docker-compose exec app php artisan db:seed

tinker: ## Open Laravel Tinker
	docker-compose exec app php artisan tinker

test: ## Run tests
	docker-compose exec app ./vendor/bin/phpunit

tail-logs: ## Tail application logs
	docker-compose exec app tail -f storage/logs/laravel.log

clean: ## Clean up volumes and containers
	docker-compose down -v

ps: ## Show running containers
	docker-compose ps
