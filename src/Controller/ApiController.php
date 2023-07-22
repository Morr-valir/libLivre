<?php

namespace App\Controller;

use App\Repository\BookRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
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
    #[Route('/api/categories/book/{id}', name: 'api_collection_booksCategory', methods: ['GET'])]
    public function getBooksToCategories(SerializerInterface $serializer, Request $request): Response
    {
        $idBook = $request->get('id');
        $getCollectionBooks = $this->repoBooks->findByCategory($idBook);

        if($getCollectionBooks === null){
            $response = new Response(null,600,[
            'Content-Type' => 'application/json',
            ]);
            return $response;
        }
        $jsonCollectionBooks = $serializer->serialize($getCollectionBooks,'json');
        $response = new Response($jsonCollectionBooks,200, [
            'Content-Type' => 'application/json',
        ]);
        return $response;
    }
}