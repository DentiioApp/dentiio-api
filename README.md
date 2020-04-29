![Dentiio Api](https://www.dentiio.com/img/logoblue.png)

[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

----------------

[Dentiio](https://www.dentiio.com/) Api is an [API Platefom](https://github.com/api-platform/api-platform)


----------------

### Principal contributors :  
[Lory][L] 
,[Branis][B] 
,[Arthur][A] 
,[Romain][R] 
& [Mounia][M]

[L]:https://github.com/loryleticee
[B]:https://github.com/branisanz1
[R]:https://github.com/romainmaucot
[A]:https://github.com/adjikpo
[M]:https://github.com/lyafmounia

----------------

## Contents
-   [Requirements](#-requirements)
-   [Configuration](#-configuration)
-   [Building your app](#-building-your-app)
-   [Contributing on the Dentiio api](#-contributing-on-the-dentiio-api)

## 📋 Requirements
- 🛠Make
- :elephant: PHP-fpm >= 7.3 
- MariaDB 
- NGINX >= 1.13.6  
- 🐳Docker

## :gear: Configuration
1. Create a .env file 
2. Copy .env_example in .env
3. Update the variables on the .env at your environement 
4. Move the .env on the api file


## 🎉 Building your app  

### with docker
1. Launch the command  `make help` or `make` generate list of targets with descriptions
2. Build the docker & the app

``` bash
$ make install
$ make composer
$ make fixtures
```

or

``` bash
$ make all
```

### without docker
[Read the official "Getting Started" guide for the API Plateform](https://api-platform.com/docs/distribution/#using-symfony-flex-and-composer-advanced-users). It's the same for the Dentiio Api 

### Install the JWT Authentication
Launch the command `make jwt`

## Contributing on the Dentiio api

Dentiio api is an Open Source, community-drivvern project community-driven project with of contributors. Join them contributing code or contributing documentation.
