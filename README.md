Assessment for Bureau blauwGeel Utrecht: make a todo-list

install and run with docker

$ docker-compose pull

$ docker-compose up -d

add some dummy data

$ docker-compose exec php bin/console doctrine:fixtures:load
