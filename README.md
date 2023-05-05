# Router

PHP Router project

## Project Structure

1. `src:` source code

## Contributing

To contribuit to this project [follow these steps](./CONTRIBUTING).

## Getting started

1. Clone this repository

```bash
git clone https://github.com/AssoDePicche/router.git
```

2. Instantiate the router class and call the get or post methods passing them the route and a callback

```php
<?php

$router = new \Http\Router;

$router->get('/home', fn () => new Reponse('Hello, World!'));
```

3. Create a request instance from global and pass it to the handle method of the router instance

```php
$request = \Http\Request::createFromGlobals();

$response = $router->handle($request);
```

4. Send the response

```php
$response->send();
```

## License

[MIT Licence](./LICENSE) © Samuel do Prado Rodrigues (AssoDePicche)

## Get in touch

Samuel do Prado Rodrigues (AssoDePicche) - samuelprado730@gmail.com
