<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/api/posts/{id}", name="blog_show", methods={"GET","HEAD"})
     * @param Blog $post
     */
    public function show(Blog $post)
    {
        // ... return a JSON response with the post
    }

    /**
     * @Route("/api/posts/{id}", name="blog_edit", methods={"PUT"})
     * @param Blog $post
     */
    public function edit(Blog $post)
    {
        // ... edit a post
    }
}
