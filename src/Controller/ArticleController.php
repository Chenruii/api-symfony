<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    private $articleRepository;
    private $em;

    public function __construct(ArticleRepository $articleRepository,EntityManagerInterface $entityManager)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $entityManager;
    }

    /**
     * @Rest\Get("/api/article/{id}")
     *
     */
    public function getOneArticle(Article $article)
    {
        return $this->json($article);
    }

    /**
     * @Rest\Get("/api/articles")
     */
    public function getAllArticles()
    {
        $articles = $this->articleRepository->findAll();
        return $this->json($articles);
    }


    /**
     * @Rest\Patch("/api/users/{email}")
     */
    public function patchApiArticle( Request $request,Article $article)
    {
        $name = $request->get('name');
        $description = $request->get('description');


        $createAt = $request->get('createAt');



        if (null !== $name ){
            $article->setName($name);
        }
        if (null !== $description ){
            $article->getDescription($description);
        }

        if (null !== $createAt){
            $article->getCreateAt( new \DateTime( $createAt));
        }
        $this->em->persist($article);
        $this->em->flush();

        return $this->json($article);
    }
    /**
     * @Rest\Delete("/api/articles/{email}")
     */
    public function deleteApiArticle(Article $article){}

    /**
     * @Rest\Post("/api/articles")
     * @ParamConverter("article",converter="fos_rest.request_body")
     */
    public function postApiArticle (Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
        return $this->json($article);

    }


}
