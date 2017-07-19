<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\Entity\User;
use App\Validation\UserValidator;

class UserController extends Controller
{
    public function create(Request $request, Response $response)
    {
        try {
            $data = json_decode($request->getBody());

            $validation = UserValidator::getRules($request, $this->validator);

            if($validation->failed()) {
                return $response->withJson($validation, 400);
            }

            $repository = $this->doctrine->getRepository(User::class);
            $repository->addUser($data);

            return $response->withJson(['msg' => 'User successfully registered.'], 200);

        } catch (\Exception $ex) {
            return $response->withJson(['msg' => $ex->getMessage()], 400);
        }
    }

    public function get(Request $request, Response $response)
    {
        try {
            $repository = $this->doctrine->getRepository(User::class);
            $users = $repository->findAll();

            if(empty($users)) {
                return $response->withJson("No user found.", 400);
            }

            $data = $repository->getUsers($this->serializer, $users);
            return $response->withJson($data, 200);
        } catch (\Exception $ex) {
            return $response->withJson(['msg' => $ex->getMessage()], 400);
        }
    }
}