# Server

## Setup

### Database

- Run mariadb
- ``CREATE DATABASE `bidipeppercrap`;``
- `CREATE USER 'bidipeppercrap' IDENTIFIED BY 'secret';`
- `GRANT USAGE ON *.* TO 'bidipeppercrap'@localhost IDENTIFIED BY 'secret';`
- ``GRANT ALL PRIVILEGES ON `bidipeppercrap`.* TO 'bidipeppercrap'@localhost;``
- `FLUSH PRIVILEGES;`
- Verify your user has the right permission `SHOW GRANTS FOR 'bidipeppercrap'@localhost;`

### Finally

- Configure `.env`