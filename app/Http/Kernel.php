protected $routeMiddleware = [
    // ...
    'role.redirect' => \App\Http\Middleware\RoleRedirect::class,

];
