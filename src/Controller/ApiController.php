<?php

namespace App\Controller;

use App\Repository\BookRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingRepository;
use App\Repository\CategoryRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class ApiController extends AbstractController
{

    private $repoBooks;
    private $bookingRepository;
    private $security;
    public function __construct
    (BookRepository $bookRepository,
     BookingRepository $bookingRepository, 
     Security $securityContext)
    {
        $this->repoBooks = $bookRepository;
        $this->bookingRepository = $bookingRepository;
        $this->security = $securityContext;
    }
    
    public function __invoke()
    {
        $user = $this->security->getUser();
        return $user;
    }

    #[Route(path:'/api/login', name : 'api_login', methods:['POST'])]
    public function login() {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUserIdentifier(),
            'roles' => $user->getRoles()
        ]);
    }
    
    /**
     * @return Book to JSON response
     */
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

    #[Route('/api/booking/user/{id}', name: 'api_collection_bookingUser', methods: ['GET'])]
    public function getBookingToUSerId(SerializerInterface $serializer, Request $request): Response
    {
        $userId = $request->get('id');
        $getBookingList = $this->bookingRepository->findBookingUser($userId);

        if(!$getBookingList === null){
            $response = new Response(null, 600,[
                'Content-Type' => 'application/json',
            ]);
            return $response;
        }
        $jsonBookingUser = $serializer->serialize($getBookingList,'json');
        $response = new Response($jsonBookingUser,200,[
            'Content-Type' => 'application/json',
        ]);
        return $response;
    }


}