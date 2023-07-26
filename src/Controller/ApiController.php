<?php

namespace App\Controller;

use App\Entity\Book;
use DateTimeImmutable;
use App\Entity\Booking;
use App\Repository\BookRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingRepository;
use App\Repository\CategoryRepository;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\StateBookingRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * Get a collection bookin form user id
     * @return JSON array
     */
    #[Route('/api/booking/user/{id}', name: 'api_collection_bookingUser', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
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

    #[Route('/addOrder/{id}', name: "app_single_add_order", methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function addOrder(Book $book, EntityManagerInterface $em, StateBookingRepository $stateBookingRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {

            return new Response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        $booking = new Booking();
        $booking->setReference($user->getId() . "-" . $book->getId())
            ->setUser($user)
            ->addBook($book)
            ->setCreatedAt(new DateTimeImmutable("now"))
            ->setState($stateBookingRepository->stateSelected("Reservé"));

        $em->persist($booking);
        $em->flush();

        $this->addFlash('info', 'Votre livre à bien été réservé !');
        return new Response('Votre livre à bien été réservé !', Response::HTTP_OK);
    }


}