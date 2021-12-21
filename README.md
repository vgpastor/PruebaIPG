# Prueba IpGlobal 

El entorno general es la gestión de un blog, basado en la estructura de datos de https://jsonplaceholder.typicode.com/posts

Se trata de crear una API REST y frontal web con las siguientes especificaciones

- API REST
  - Lista de posts con info del autor 
  - Publicación de un post
- FRONTAL WEB
  - Lista de post
  - Página de post con info del autor

## Pasos seguidos

- Creación del entorno general, basado en symfony 5.4 y doctrine 2.10 sobre PHP 8.0 con PHPStan, PHP-CS-Fixer y PHPUnit
- Creación de los test de la API REST y hacerlos funcionar
- Create DB, migration and fixtures
- Remove Fake response and update with db response
- Improve logic to create a post


## Todo
- Crear un listener para validar el token JWT a la hora de hacer post o agregar la capa de security completa, definir el firewall con la librería jwt de symfony
- Validar el body del post al crear con una api antiplagio
- Validar el body no contenga tags html prohibidas (Scripts, iframes, etc) Ahora solo valida los script
- Validar el body no contenga palabras mal sonantes.
