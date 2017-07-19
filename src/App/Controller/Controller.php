<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class Controller
{
    protected $ci;
    protected $key;
    protected $jwt;
    protected $doctrine;
    protected $validator;
    protected $serializer;

    public function __construct(ContainerInterface $ci)
    {
        try
        {
            $this->ci = $ci;

            $this->jwt          = $this->ci->get("jwt");
            $this->key          = $this->ci["settings"]['key'];
            $this->doctrine     = $this->ci->get("em");
            $this->validator    = $this->ci->get("validator");
            $this->serializer   = $this->ci->get("serializer");
        }
        catch (\Exception $e)
        {
            echo "Error: ".$e->getMessage();
        }
    }
}