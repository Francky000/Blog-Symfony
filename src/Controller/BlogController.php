<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */  
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll(); 

        return $this->render('blog/index.html.twig',[
            'articles' => $articles
        ]);
    }

     /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article :: class);

        $articles = $repo->find($id);

        return $this->render('blog/show.html.twig',[
                'article' => $articles
            ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @route("/blog/{id}/edit", name="blog_edit")
     */
    public function form(Article $article, Request $request, ObjectManager $Manager)
    {
       
        if(!$article){
            $article = new Article();
        }
        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('content')
            ->add('image')
            ->getForm();

        $form->handleRequest($request);

        // Add the date of creation the article
        if($form->isSubmitted() && $form->isValid()){

            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime());
            }
            
            $Manager->persist($article);
            $Manager->flush();

            //Redirect to article which was created
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);

        }
        return $this->render('blog/create.html.twig',[
        'formArticle' => $form->createView(),
        'editMode'  => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/blog/{id}/delete", name="blog_delete")
     */
    public function delete(Article $article)
    {
        $repo = $this->getDoctrine()->getManager();

        $repo->remove($article);
        $repo->flush();

        return $this->redirectToRoute('blog');
    }
}      
