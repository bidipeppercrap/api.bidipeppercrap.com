# API - bidipeppercrap.com
The server side of [bidipeppercrap.com](https://bidipeppercrap.com/)

### Technology Stack
[<img align="left" width="26px" alt="Laravel" src="https://laravel.com/img/logomark.min.svg">][laravel]
[<img align="left" width="26px" alt="MariaDB" src="https://mariadb.org/wp-content/uploads/2019/02/cropped-mariadb_org_rgb_r_512-1-270x270.png">][mariadb]
[<img align="left" width="26px" alt="auth0" src="https://cdn.auth0.com/website/press/resources/auth0-glyph.svg">][auth0]

<br>

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
[auth0]: https://auth0.com/
