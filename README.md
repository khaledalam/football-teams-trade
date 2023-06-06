# Football Teams Trade | Symfony v6^

### Symfony app that allow to teams to buy/sell players.

## !! App & Doc are still in progress !!


### Roles:
- [x] Admin
- [x] Team Manager
- [x] Player

### Features:
- [x] Multi-languages


### Frontend
- Template Engine: twig
- Bootstrap
- JQuery
-

### Backend
- Database: SQLite
- Docker(-compose)
- 

<img src="screenshots/login.png">
<hr />
<img src="screenshots/all_teams.png">
<hr />
<img src="screenshots/new-team.png">
<hr />
<img src="screenshots/team.png">

<br />


doctrine/annotations<br/>
doctrine/orm<br/>
doctrine/doctrine-bundle<br/>
doctrine/doctrine-migrations-bundle<br/>
symfony/security-bundle<br/>
orm-fixtures<br/>
symfony/orm-pack<br/>

format_currency filter:<br/>
composer require twig/intl-extra<br/>
composer require twig/extra-bundle<br/>



### Auth

Admin:<br>
Email: admin@example.com<br>
Pass: password

Team Manager:<br>
Email: team1@example.com<br>
Pass: team1password

Player:<br>
Email: player1@example.com<br>
Pass: player1password


<hr />

2023-06-04T19:47:08+00:00 [info] User Deprecated: The "url" connection parameter is deprecated. Please use Doctrine\DBAL\Tools\DsnParser to parse a database url before calling Doctrine\DBAL\DriverManager. (DriverManager.php:256 called by DriverManager.php:172, https://github.com/doctrine/dbal/pull/5843, package doctrine/dbal)
2023-06-04T19:47:08+00:00 [info] User Deprecated: Doctrine\DBAL\Connection::getEventManager is deprecated. (Connection.php:296 called by EntityManager.php:167, https://github.com/doctrine/dbal/issues/5784, package doctrine/dbal)
2023-06-04T19:47:08+00:00 [info] User Deprecated: Doctrine\DBAL\Platforms\AbstractPlatform::usesSequenceEmulatedIdentityColumns is deprecated. (AbstractPlatform.php:3945 called by ClassMetadataFactory.php:626, https://github.com/doctrine/dbal/pull/5513, package doctrine/dbal)

<hr />

```
rm ./src/Migrations/* 2> /dev/null ;
php bin/console doctrine:database:drop --force --no-interaction &&
php bin/console doctrine:migrations:diff --no-interaction

php bin/console doctrine:database:drop --force --no-interaction &&
php bin/console doctrine:database:create --no-interaction && 
php bin/console  doctrine:migrations:migrate --no-interaction &&
php bin/console  doctrine:fixture:load --no-interaction


docker compose down --remove-orphans
docker compose up -d
```
