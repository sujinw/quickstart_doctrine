<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class UserValidator
{
    public static function getRules($request, $validator)
    {
        return $validation = $validator->validate($request, [
            'name'     => v::notEmpty()->length(3,100),
            'email'    => v::email(),
            'password' => v::notEmpty()->length(6,30)
        ]);
    }
}