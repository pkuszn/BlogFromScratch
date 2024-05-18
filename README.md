# BlogFromScratch
A simple blog written to pass a university course

# Projektowanie aplikacji internetowych
Termin 26 maja!!!


# Requirements

- php version x
- wsl/ubuntu
- apache server

# Installation

## Docker

Build image from dockerfile
```bash
docker build -t my-php-app .
```

Run container
```bash
docker run -d -p 8080:80 -e MYSQL_HOST=localhost -e MYSQL_USER=root -e MYSQL_PASSWORD=secret my-php-app
```

# Usage