include make.conf

# -----------------------------------------
#     LIST ALL POSSIBLE COMMANDS
# -----------------------------------------
.PHONY: list
list:
	@echo "$(YELLOW_OPEN)composer$(YELLOW_CLOSE)			> Install composer dependencies"
	@echo "$(YELLOW_OPEN)tests$(YELLOW_CLOSE)				> Run available tests"

.PHONY: composer
composer:
	docker-compose up -d --build composer

.PHONY: tests
tests:
	docker-compose up -d web
	docker-compose logs --tail=15 web