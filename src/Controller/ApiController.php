<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiController extends AbstractController
{

    private $repoBooks;
    private $repoCategory;

    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->repoBooks = $bookRepository;
        $this->repoCategory = $categoryRepository;
    }
}