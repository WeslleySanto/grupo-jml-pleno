
# Iniciar servidor
```php artisan serve```

# Executar a seeder
```php artisan db:seed --class=FornecedoresSeeder```

# Instalar composer
```composer install```

# Postman

## Criar fornecedor
```
curl --location 'http://localhost:8002/api/fornecedores' \
--header 'Content-Type: application/json' \
--data-raw '{
   "nome": "nome para teste",
   "cnpj": 10254888888889,
   "email": "teste@gmail.com"
}'
```

## Search fornecedor

```
curl --location 'http://localhost:8002/api/fornecedores/search?search=r'
```

# Executar testes de unidade

```vendor/bin/phpunit```