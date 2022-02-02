# <center>Php url shortener</center>
Service where you can write a long URL into an input field and the service shortens the URL to short link.

## <center>Requirements</center>
* **Docker >= v20.10.8**
  | Link to the documentation for installing this software for various operating systems:
  https://docs.docker.com/engine/install/
* **docker-compose >= v1.29.2**
  | Link to the documentation for installing this software for various operating systems:
  https://docs.docker.com/compose/install/

## <center>Installation</center>
1. Git clone **php-url-shortener** project to your folder.
2. Execute build command via console: **docker-compose build**
3. Execute build command via console: **docker-compose up -d**
4. Run installation of composer dependencies in the project: **composer install**
5. Execute build command via console: **sudo echo '127.0.0.1   php-url-shortener.local' >> /etc/hosts**
