<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class LoginValidator
{
    public static function getRules($request, $validator)
    {
        return $validation = $validator->validate($request, [
            'email'    => v::email(),
            'password' => v::notEmpty()->length(6,30)
        ]);
    }
}