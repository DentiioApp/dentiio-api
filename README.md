# Dentiio-api

Contributors :  
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


## Contents
-   [Requirements](#-requirements)
-   [Configuration](#-configuration)
-   [Building your app](#-building-your-app)


## 📋 Requirements
- 🛠Make
- :elephant: PHP-fpm >= 7.3 
- MariaDB 
- NGINX >= 1.13.6  
- 🐳Docker

## Configuration
1. Create a .env file 
2. Copy .env_example in .env


## 🎉 Building your app  
1. Launch the command  `make help` or `make` generate list of targets with descriptions
2. Build the docker & the app
    `make install`
    `make composer`
    `make fixtures`

