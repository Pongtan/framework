<?php

namespace Pongtan\Http;

use Interop\Container\ContainerInterface;

class Controller
{

    protected $app;

    protected $ci;

    // use TwigTrait;

    //Constructor
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }


    /**
     * @param $response
     * @param $res
     * @param int $statusCode
     * @return mixed
     */
    public function echoJson($response, $res, $statusCode = 200)
    {
        $newResponse = $response->withJson($res, $statusCode);
        return $newResponse;
    }

    /**
     * @param $response
     * @param $to
     * @return mixed
     */
    public function redirect($response, $to)
    {
        $newResponse = $response->withStatus(302)->withHeader('Location', $to);
        return $newResponse;
    }
}