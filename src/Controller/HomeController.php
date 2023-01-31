<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function shop(PaginatorInterface $paginator, Request $request): Response
    {
        $data = $this->bookRepository->findAll();
        $books = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            6
        );


        return $this->render('home/shop.html.twig', [
            'controller_name' => 'HomeController',
            'books' => $books
        ]);
    }  
}