<?php

namespace App\Controller;

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
    public function articlesAction(): Response
    {
        return $this->render('home/articles.html.twig');
    }
    
    /**
    * @Route("/articles/1", name="article")
    */
    public function articleAction(): Response
    {
        return $this->render('home/article.html.twig');
    }
}
