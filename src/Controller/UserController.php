<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("api/users/{email}")
     */
    public function  getUser(User $user)
    {
    }
    /**
     * @Rest\Get("api/users")
     */
    public function  getApiUsers()
    {
    }
    /**
     * @Rest\Get("api/users")
     */
    public function  getApiUser(User $user)
    {
    }
    /**
     * @Rest\Get("api/users/{email}")
     */
    public function  patchApiUser(User $user)
    {
    }
    /**
     * @Rest\Get("api/users/{email}")
     */
    public function  deleteApiUser(User $user)
    {
    }
}
