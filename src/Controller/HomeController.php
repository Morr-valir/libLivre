<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $categoryRepository;
    private $bookRepository;

    public function __construct(CategoryRepository $categoryRepository, BookRepository $bookRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->bookRepository = $bookRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findAll();

        $books = $this->bookRepository->recentBook();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $categories,
            'books' => $books
        ]);
    }


    #[Route('/shop', name: 'app_shop')]
    public function shop(): Response
    {
        $books = $this->bookRepository->findAll();

        return $this->render('home/shop.html.twig', [
            'controller_name' => 'HomeController',
            'books' => $books
        ]);
    }
}