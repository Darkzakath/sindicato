<?php

namespace c2si;

require_once 'libs/Auth/Auth.php';
require_once 'libs/Slim/Middleware.php';

class AuthMiddleware extends \Slim\Middleware
{
    protected $system;
<<<<<<< HEAD
    public $auth;
=======
    protected $auth;
>>>>>>> 761859af77d15d99ea4a125f63b609ce2ef8d92f

    public function __construct($nd)
    {
      $this->system = $nd;
      $this->auth = new \c2si\Auth();
      $this->auth->setHandler($this->system->handler);
    }

    /**
     * Call
     *
     * This method will check the HTTP request headers for previous authentication. If
     * the request has already authenticated, the next middleware is called. Otherwise,
     * a 401 Authentication Required response is returned to the client.
     */
    public function call()
    {
      $request = $this->app->request;
      $response = $this->app->response;

      //si intenta acceder al login, no valido para que pueda pedir token
      if ($request->getResourceUri() !== '/login') {
        $ok = $this->auth->authentificate($request->headers->get('ACCESS_TOKEN'));
        if (!$ok) {
          $response->status(401);
          $response->write($request->getResourceUri());
        } else {
            $this->next->call();
        };
      } else {
        $this->next->call();
      };
    }
}
?>