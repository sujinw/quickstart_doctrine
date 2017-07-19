<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Controller\Controller;
use App\Model\Entity\User;
use App\Validation\LoginValidator;
use Doctrine\Common\Util\Debug;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    public function login(Request $request, Response $response)
    {
        try {
            $data = json_decode($request->getBody());

            $validation = LoginValidator::getRules($request, $this->validator);

            if($validation->failed()) {
                return $response->withJson($validation, 400);
            }

            $repository = $this->doctrine->getRepository(User::class);

            $user = $repository->login($data);

            $token = $this->createAuthenticationToken($user);

            return $response->withJson(['token' => $token], 200);
        } catch (\Exception $ex) {
            return $response->withJson(['msg' => $ex->getMessage()], 400);
        }
    }

    private function createAuthenticationToken($user)
    {
        $data = [
            "iat" => time(),
            "exp" => time() + (60 * 60),
            "id"  => $user->getId(),
            "claims" => [
                "email" => $user->getEmail(),
            ]
        ];

        return JWT::encode($data, $this->key);
    }
}