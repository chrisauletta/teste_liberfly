# Projeto Teste Liberfly

Para começar vamos instarlar as dependencia.
```
composer install
```
Configurar o .env para conectar com o banco.
Depois rodas as migrate.
```
php artisan migrate
```
Agora é so levantar o servidor
```
php artisan serve
```
## Acesso ao Swagger

O Swagger ficara disponivel na rota: http://localhost:8000/api/documentation
