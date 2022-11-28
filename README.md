# El Gestor de l'Hort

TODO:

## Requeriments

🖥️ php -v
→ PHP 8.0.12 (cli)

🖥️ MySQL
→ Server version: 8.0.28 MySQL Community Server - GPL

🖥️ composer -v
→ Composer version 2.2.5

🖥️ symfony -v
→ Symfony CLI version 5.2.2


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


## Get Started
- git clone https://github.com/aleongit/elgestordelhort.git
- cd elgestordelhort
- composer install
- run **init.sql** in MySQL
- .env
- symfony server:start
- http://127.0.0.1:8000
- http://127.0.0.1:8000/registre


![Screenshot](public/img/1.png)