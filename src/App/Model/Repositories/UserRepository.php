<?php

namespace App\Model\Repositories;

use JMS\Serializer\SerializationContext;
use Doctrine\ORM\EntityRepository;
use App\Model\Entity\User;

class UserRepository extends EntityRepository
{
    public function addUser($data)
    {
        $this->checkEmail($data);

        $user = new User();
        $user->setName($data->name);
        $user->setEmail($data->email);
        $user->setPassword(md5($data->password));

        $this->_em->persist($user);
        $this->_em->flush();
    }

    private function checkEmail($data)
    {
        $email = $this->_em->getRepository(User::class)->findOneBy(['email' => $data->email]);

        if($email) {
            throw new \Exception("E-mail already registered.");
        }
    }

    public function getUsers($serializer, $users)
    {
        $context = SerializationContext::create()->setGroups(array("user"));

        $json = $serializer->serialize($users, "json", $context);

        $data = json_decode($json);

        return ['users' => $data];
    }

    public function login($data)
    {
        $user = $this->_em->getRepository(User::class)->findOneBy(['email' => $data->email, 'password' => md5($data->password)]);

        if(empty($user)) {
            throw new \Exception("Data not found. Try again");
        }

        return $user;
    }
}