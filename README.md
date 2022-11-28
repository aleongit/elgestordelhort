# El Gestor de l'Hort

Exemple d'aplicació Symfony amb MySQL i Bootstrap 5. Ús de login, registre, control d'accés, vistes amb templates twig, models (entitats), controladors, rutes, forms, validacions, layout, includes i traduccions.


## Requeriments

🖥️ php -v
→ PHP 8.0.12 (cli)

🖥️ MySQL
→ Server version: 8.0.28 MySQL Community Server - GPL

🖥️ composer -v
→ Composer version 2.2.5

🖥️ symfony -v
→ Symfony CLI version 5.2.2

🖥️ php bin/console --version
→ Symfony 6.0.4


## Doc
- **https://symfony.com/doc/current/index.html**


## For New project
- **install Symfony** by Scoop on Windows
- https://symfony.com/download
- scoop install symfony-cli
- symfony new elgestordelhort --webapp
- cd elgestordelhort
- **Install Symfony Components**
- composer require symfony/config
- composer require doctrine/annotations
- composer require symfony/maker-bundle --dev
- composer require twig
- composer require symfony/asset
- composer require symfony/orm-pack
- composer require symfony/form
- composer require symfony/security-bundle
- composer require symfony/validator
- composer require symfonycasts/verify-email-bundle
- composer require sensio/framework-extra-bundle
- composer require symfony/twig-pack
- **Make controllers and entities**
- php bin/console make:controller Home
- php bin/console make:controller User
- php bin/console make:controller Task
- php bin/console doctrine:migrations:status
- php bin/console doctrine:migrations:sync-metadata-storage
- php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity
- php bin/console make:entity --regenerate App
- **Console**
- php bin/console --version
- php bin/console list
- php bin/console about
- php bin/console cache:clear
- php bin/console dbal:run-sql "SELECT * FROM users"


## Get Started
- git clone https://github.com/aleongit/elgestordelhort.git
- cd elgestordelhort
- composer install
- run **init.sql** in MySQL
- .env
- symfony server:start
- http://127.0.0.1:8000
- user: pepet@gmail.com 1234
- user: pepeta@gmail.com 1234
- or http://127.0.0.1:8000/registre


![Screenshot](screenshots/img/1.png)

![Screenshot](screenshots/img/2.png)

![Screenshot](screenshots/img/3.png)