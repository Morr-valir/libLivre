<?php

namespace App\Controller;

use App\Entity\Book;
use DateTimeImmutable;
use App\Entity\Booking;
use App\Repository\BookRepository;
use App\Repository\BookingRepository;
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

    /**
     * Create a new booking user
     * @param  $id book
     * @return  JsonResponse
     */
    #[Route('api/addOrder/{id}', name: "api_order", methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function addOrder(EntityManagerInterface $em, StateBookingRepository $stateBookingRepository, Request $request): Response
    {
        $idBook = $request->get('id');
        $bookSelect = $this->repoBooks->findById($idBook);
        $user = $this->getUser();
        if (!$user) {
            return new Response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        if ($bookSelect->isIsAvailable() == false){
            return new Response('Livre non disponible', Response::HTTP_CONFLICT);
        }
        
        $booking = new Booking();
        $booking->setReference($user->getId() . "-" .$bookSelect->getId())
            ->setUser($user)
            ->addBook($bookSelect)
            ->setCreatedAt(new DateTimeImmutable("now"))
            ->setState($stateBookingRepository->stateSelected("Reservé"));
        $bookSelect->setIsAvailable(false);
        $em->persist($booking);
        $em->flush();
        return new Response('Votre livre à bien été réservé !', Response::HTTP_OK);
    }

    #[Route('api/removeBooking/{id}', name: 'api_delete_booking', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function deleteBooking(EntityManagerInterface $em, StateBookingRepository $stateBookingRepository, Request $request): Response
    {
        $idBooking = $request->get('id');
        $bookingSelect = $this->bookingRepository->findById($idBooking);
        $bookId = $bookingSelect->getBooks()[0]->getId();
        $book = $this->repoBooks->findById($bookId);
        $user = $this->getUser();
        if (!$user) {
            return new Response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        // Vérifier que l'utilisateur est le propriétaire de la réservation
        if (!$bookingSelect || $bookingSelect->getUser() !== $user) {
            // Gérer l'erreur si la réservation n'a pas été trouvée ou si l'utilisateur n'est pas le propriétaire
            // Par exemple, retourner une réponse HTTP 404 Not Found ou 403 Forbidden
            return new Response('Reservation not found or unauthorized', Response::HTTP_NOT_FOUND);
        }
        // Récupérer le state "annulé"
        $stateAnnule = $stateBookingRepository->stateSelected("Annulé");
        $book->setIsAvailable(true);
        // Passer le booking en annulé
        $bookingSelect->setState($stateAnnule);
        $em->flush(); 
        // Supprimer le Booking
        $em->remove($bookingSelect);
        $em->flush(); 

        // Response Valide après suppression
        return new Response('Réservation annulée', Response::HTTP_OK);
    }

}