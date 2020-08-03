# API - bidipeppercrap.com
The server side of bidipeppercrap.com

### Technology Stack
[<img align="left" width="26px" src="https://laravel.com/img/logomark.min.svg">][laravel]
[<img align="left" width="26px" src="https://mariadb.org/wp-content/uploads/2019/02/cropped-mariadb_org_rgb_r_512-1-270x270.png">][mariadb]

## Setup
#### Database
- Login to `mariadb`
- ``CREATE DATABASE `bidipeppercrap`;``
- `CREATE USER 'bidipeppercrap' IDENTIFIED BY 'secret';`
- `GRANT USAGE ON *.* TO 'bidipeppercrap'@localhost IDENTIFIED BY 'secret';`
- ``GRANT ALL PRIVILEGES ON `bidipeppercrap`.* TO 'bidipeppercrap'@localhost;``
- `FLUSH PRIVILEGES;`
- Verify your user has the right permission `SHOW GRANTS FOR 'bidipeppercrap'@localhost;`

#### Finally
- Configure `.env`

[laravel]: https://laravel.com/
[mariadb]: https://mariadb.org/
