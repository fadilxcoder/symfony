<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BlogPostRepository as BlogRepository;

class BlogController extends AbstractController
{
	public function __construct(private BlogRepository $blogRepository)
				{
				}

	/**
     * @Route("/", name="blog")
     */
    public function index(): Response
    {
        dd($this->blogRepository->findAll());

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}