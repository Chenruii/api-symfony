<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends AbstractFOSRestController
{
    private $articleRepository;
    private $em;

    public function __construct(ArticleRepository $articleRepository,EntityManagerInterface $entityManager)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $entityManager;
    }

    /**
     * @Rest\View(serializerGroups={"article"})
     * @Rest\Get("/api/articles")
     */
    public function getAllArticles()
    {
        $articles = $this->articleRepository->findAll();
        return $this->view($articles);
    }

    /**
     * @Rest\Get("/api/article/{id}")
     *
     */
    public function getOneArticle(Article $article)
    {
        return $this->view($article);
    }


    /**
     * @Rest\Patch("/api/article/{id}")
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
            $article->setDescription($description);
        }
        {}
        if (null !== $createAt){
            $article->setCreateAt( new \DateTime( $createAt));
        }
        $this->em->persist($article);
        $this->em->flush();

        return $this->view($article);
    }
    /**
     * @Rest\Delete("/api/article/{id}")
     */
    public function deleteApiArticle(Article $article){}

    /**
     * @Rest\View(serializerGroups={"article"})
     * @Rest\Post("/api/articles")
     * @ParamConverter("article",converter="fos_rest.request_body")
     */
    public function postApiArticle (Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
        return $this->view($article);

    }

}
