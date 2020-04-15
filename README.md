CMS Jaume Vidal Arasa v2
========================

Artist [Jaume Vidal Arasa](https://www.jaumevidalarasa.cat) main webpage powered by Sulu CMS technology.

#### Installation requirements

* PHP 7.2
* MySQL 5.7
* Git
* Composer
* Yarn

#### Installation instructions

```bash
$ git clone git@bitbucket.org:empaticanet/rainbow_backend.git cms-jaumevidalarasa-2
$ cd cms-jaumevidalarasa-2
$ cp env.dist .env
$ nano .env
$ composer install
$ yarn install
```

Remember to edit `.env` config file according to your system environment needs.

#### Load database fixtures commands

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console hautelook:fixtures:load
```

#### Testing suite commands

```bash
$ ./scripts/developer-tools/test-database-reset.sh
$ ./scripts/developer-tools/run-test.sh
```
