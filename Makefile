local-build:
	docker compose -f ./docker/local/docker-compose.yml build

local-up:
	docker compose -f ./docker/local/docker-compose.yml up -d
local-down:
	docker compose -f ./docker/local/docker-compose.yml down


