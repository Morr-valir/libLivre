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
        // Récupérer les Category
        $categories = $this->categoryRepository->findAll();

        // Récupérer tout les Book
        $books = $this->bookRepository->recentBook();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $categories,
            'books' => $books
        ]);
    }


    #[Route('/boutique', name: 'app_boutique')]
    public function boutique(): Response
    {
        // Récupérer tout les Book
        $books = $this->bookRepository->findAll();

        return $this->render('home/boutique.html.twig', [
            'controller_name' => 'HomeController',
            'books' => $books

        ]);
    }
}