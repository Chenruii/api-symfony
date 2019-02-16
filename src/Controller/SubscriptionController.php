<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/subscription", name="subscription")
     */
    public function index()
    {
        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
        ]);
    }

    private $subscriptionRepository;
    private $em;

    public function __construct(SubscriptionRepository $subscriptionRepository,EntityManagerInterface $entityManager )
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->em = $entityManager;
    }

    /**
     * @Rest\Get("/api/subscriptions")
     * @Rest\View(serializerGroups = {"subscription"})
     */
    public function getApiAllSubscription(){

        $subscriptions = $this->subscriptionRepository->findAll();
        return $this->json($subscriptions);
    }

    /**
     * @Rest\View(serializerGroups = {"subscription"})
     * @Rest\Get("/api/subscriptions/{id}")
     */
    public function getApiSubscription(Subscription $subscription){
        return $this->json($subscription);
    }

    /**
     * @Rest\Post("/api/admin/subscriptions")
     * @ParamConverter("subscription",converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"subscription"})
     */
    public function postApiSubscription (Request $request,Subscription $subscription)
    {

        $this->em->persist($subscription);
        $this->em->flush();
        return $this->json($subscription);
    }
    /**
     * @Rest\Patch("/api/admin/subscriptions/{id}")
     * @Rest\View(serializerGroups={"subscription"})
     */
    public function patchApiSubcription(Request $request,Subscription $subscription){
        $ApiName = $request->get('name');
        $ApiSlogan = $request->get('slogan');
        $ApiUrl = $request->get('url');

        if ($ApiName !== null){
            $subscription->setName($ApiName);
        }
        if ($ApiSlogan !== null){
            $subscription->setUrl($ApiSlogan);
        }
        if ($ApiUrl !== null){
            $subscription->setSlogan($ApiUrl);
        }
        $this->em->persist($subscription);
        $this->em->flush();
        return $this->json($subscription);
    }
}
