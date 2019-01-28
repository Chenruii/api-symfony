<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Rest\Get("/api/users")
     */
    public function getApiUsers()
    {
        $users = $this->userRepository->findAll();
        return $this->json($users);
    }


    /**
     *
     * @Rest\Get("/api/user/{email}")
     */
    public function getOneUser(User $user)
    {
        return $this->json($user);
    }



    /**
     * @Rest\Patch("/api/users/{email}")
     */
    public function patchApiUser(User $user)
    {
        return $this->json($user);
    }
    /**
     * @Rest\Delete("/api/users/{email}")
     */
    public function deleteApiUser(User $user)
    {

    }
}
