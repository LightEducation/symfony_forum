<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('home/index.html.twig',[
            'posts' => $postRepository->findAll()
        ]);
    }

    /**
     * @Route ("/makepost", name="make_post")
     */
    public function makePost(Request $request,PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $post->setUser($this->getUser());
            $post->setDate(new \DateTime());
            $postRepository->add($post,true);
            return $this->redirectToRoute("home");
        }
        return $this->render("users/makepost.html.twig",[
            "form" => $form->createView()
        ]);
    }
}
