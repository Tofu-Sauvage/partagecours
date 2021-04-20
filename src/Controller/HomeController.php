<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    * @Route("/dashboard", name="dashboard")
    */
    public function dashboardAction(ArticleRepository $articleRepository): Response{
        $articles = $articleRepository->findAll();
        return $this->render('admin/dash.html.twig', ['articles'=>$articles]);
    }
    
    /**
    * @Route("/articles/{id}", name="article")
    */
    public function articleAction(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->findOneBy(['id'=>$id]);
        return $this->render('home/article.html.twig', ['article'=>$article]);
    }
    //ce qui fonctionne aussi (parce qu'il sait qu'on attend un id):
    //public function articleAction(Article $article): Response
    //{
    //    return $this->render('home/article.html.twig', ['article'=>$article]);
    //}

    /**
    * @Route("/add", name="form_article")
    * @Route("/edit/{id}", name="form_edit")
    */
    public function articleForm(Request $request, EntityManagerInterface $em, Article $article=null, SluggerInterface $slug): Response
    {
        if (!$article)
        {
            $article = new Article;
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

           /** @var UploadedFile $file */
            $file = $form->get('image')->getData();
           
            if ($file) {
                $original = pathInfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = $slug->slug($original);
                $uniqueName = $safeName. "-" . uniqid() . "." . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                //ici uploads est défin idans le fichier services.yml
                try {
                    $file->move(
                        $this->getParameter('uploads'),
                        $uniqueName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $article->setImage($uniqueName);
            }
            
            $article->setCreatedAt(new DateTime('now'));
            
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article', ['id'=>$article->getId()]);
        }
        return $this->render('home/form.html.twig', ['articleForm' => $form->createView()]);
    }

}
