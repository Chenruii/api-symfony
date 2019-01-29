<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractFOSRestController
{
    private $userRepository;
    private $em;

    public function __construct(UserRepository $userRepository,EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->em = $entityManager;
    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Get("/api/users")
     *
     */
    public function getAllUsers()
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
    public function patchApiUser( Request $request,User $user)
    {
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $apikey =$request->get('apiKey');
        $birthday =$request->get('birthday');


        if (null !== $firstname ){
            $user->setFirstname($firstname);
        }
        if (null !== $lastname){
            $user->setLastname($lastname);
        }
        if (null !== $apikey){
            $user->setApiKey($apikey);
        }
        if (null !== $birthday){
             $user->setBirthday( new \DateTime( $birthday));
        }
        $this->em->persist($user);
        $this->em->flush();

        return $this->json($user);
    }
    /**
     * @Rest\Delete("/api/users/{email}")
     */
    public function deleteApiUser(User $user){}

    /**
     * @Rest\Post("/api/users")
     * @ParamConverter("user",converter="fos_rest.request_body")
     */
    public function postApiUser (User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
        return $this->json($user);

    }
}
