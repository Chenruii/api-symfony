<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;


class CardController extends AbstractFOSRestController
{
    private $cardRepository;
    private $em;

    public function __construct(CardRepository $cardRepository, EntityManagerInterface $entityManager)
    {
        $this->cardRepository = $cardRepository;
        $this->em = $entityManager;
    }

    /**
     * @Rest\View(serializerGroups={"card"})
     * @Rest\Get("/api/cards")
     */
    public function getAllcArds()
    {
        $cards = $this->cardRepository->findAll();
        return $this->view($cards);
    }

    /**
     * @Rest\Get("/api/card/{id}")
     *
     */
    public function getOnecCard(Card $card)
    {
        return $this->view($card);
    }


    /**
     * @Rest\Patch("/api/card/{id}")
     */
    public function patchApicCard(Request $request, Card $card)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $createAt = $request->get('createAt');

        if (null !== $name ){
            $card->setName($name);
        }
        if (null !== $description ){
            $card->setDescription($description);
        }
        {}
        if (null !== $createAt){
            $card->setCreateAt( new \DateTime( $createAt));
        }
        $this->em->persist($card);
        $this->em->flush();

        return $this->view($card);
    }
    /**
     * @Rest\Delete("/api/card/{id}")
     */
    public function deleteApiCard(Card $card){}

    /**
     * @Rest\View(serializerGroups={"card"})
     * @Rest\Post("/api/cards")
     * @ParamConverter("card",converter="fos_rest.request_body")
     */
    public function postApiCard (Card $card)
    {
        $this->em->persist($card);
        $this->em->flush();
        return $this->view($card);

    }

}
