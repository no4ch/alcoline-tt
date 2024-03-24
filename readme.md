How use app

Steps:
1. Install docker/docker compose
2. Clone this project
3. Go in projectDir/docker
4. Run `docker-compose up -d --build`
5. Run `docker-compose exec app composer install`
6. Run cli script `docker-compose exec app php bin/console.php vending-machine-cli`
7. Follow commands
