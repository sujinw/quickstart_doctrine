<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Doctrine\Common\Util\Debug;

class Validator
{
    public $errors;

    public function validate($request, $rules)
    {
        foreach($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $ex) {
                $this->errors[$field] = $ex->getMessages();
            }
        }

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}