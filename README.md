# Creare il file .env
```bash
cp .env.example .env
```

# Installare vendor con sail
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

# Generare la chiave
```bash
./vendor/bin/sail artisan key:generate
```

# Migrate il database e seedarlo
```bash
./vendor/bin/sail artisan migrate --seed
```
