<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

     /**
     * @Route("/articles", name="articles")
     */
    public function articlesAction(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('home/articles.html.twig', ['articles'=>$articles]);
    }
    
    /**
    * @Route("/articles/{id}", name="article")
    */
    public function articleAction(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->findOneBy(['id'=>$id]);
        return $this->render('home/article.html.twig', ['article'=>$article]);
    }
}
