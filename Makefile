setup:
	docker-compose -f deploy/setup.yml run mysql_check
	docker-compose -f deploy/setup.yml run mysql_init
	docker-compose -f deploy/setup.yml run database_migration

run:
	docker-compose -f deploy/run.yml up -d --build

stop:
	docker-compose -f deploy/run.yml stop
	docker-compose -f deploy/run.yml rm -f

remove:
	docker-compose -f deploy/setup.yml stop
	docker-compose -f deploy/setup.yml rm -f

tests:
	docker-compose -f deploy/test.yml run api_tests
	docker-compose -f deploy/test.yml rm -f