<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
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
     * @Rest\View(serializerGroups={"card","user","subscription"}})
     * @Rest\Get("/api/cards")
     */
    public function getAllCards()
    {
        $card = $this->cardRepository->findAll();
        $finalArray = array();
        foreach ($card as $key => &$value) {
            $finalArray[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'creditCardType' => $value->getCreditCardType(),
                'creditCardNumber' => $value->getCreditCardNumber(),
                'currencyCode' => $value->getCurrencyCode(),
                'value' => $value->getValue(),
                'email' => $value->getUser()->getEmail(),
                'firstname' => $value->getUser()->getFirstname(),
            );
        }
        return $this->json($finalArray);
    }

    /**
     * @Rest\Get("/api/card/{id}")
     *
     */
    public function getOneCard(Card $card)
    {
        return $this->view($card);
    }

    /*
     * @Rest\View(serializerGroups={"card"})
     * @ParamConverter("card",converter="fos_rest.request_body")
     */
    public function postCard (Card $card,Request $request,UserRepository $user)
    {
        $this->em->persist($card);
        $this->em->flush();
        die('carte ajouté');
        return $this->json($card);

    }

    /**
     * @Rest\Patch("/api/card/{creditCardNumber}")
     */
    public function patchCard(Request $request, Card $card,UserRepository $user)
    {
        $name = $request->get('name');
        $credit_card_type = $request->get('credit_card_type');
        $credit_card_number = $request->get('credit_card_number');
        $currency_code = $request->get('currency_code');
        $value = $request->get('value');
//        $user = $request->get('user');
//
//         if ($user !== null){
//            $objsub = $user->find($user);
//            $card->setUser($objsub);
//        }

        if ($name !== null){
            $card->setName($name);
        }
        if ($currency_code !== null){
            $card->setCurrencyCode($currency_code);
        }
        if ($credit_card_type !== null){
            $card->setCreditCardType($credit_card_type);
        }
        if ($credit_card_number !== null){
            $card->setCreditCardNumber($credit_card_number);
        }
        if ($value !== null){
            $card->setValue($value);
        }
        $this->em->persist($card);
        $this->em->flush();
        return $this->json($card);
    }
    /**
     * @Rest\Delete("/api/card/{id}")
     */
    public function deleteCard(Card $card){}

}
