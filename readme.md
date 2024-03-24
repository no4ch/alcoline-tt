How use app

Steps:
1. Install docker/docker compose
2. Go in projectDir/docker
3. Run `docker-compose up -d --build`
4. Run `docker-compose exec app composer install`
5. Run cli script `docker-compose exec app php bin/console.php vending-machine-cli`
6. Follow commands
