<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Booking;
use Doctrine\ORM\EntityManager;
use App\Repository\BookRepository;
use App\Repository\BookingRepository;
use App\Repository\StateBookingRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SingleController extends AbstractController
{
    #[Route('/single/{id}', name: 'app_single')]
    public function index(int $id,BookRepository $bookRepository): Response
    {
        // Récupérer les informations du Book cliqué
        $book = $bookRepository->findById($id);

        return $this->render('single/index.html.twig', [
            'controller_name' => 'SingleController',
            "book" => $book
        ]);
    }

    #[Route('/single/addOrder/{id}', name:"app_single_add_order")]
    public function addOrder(Book $book, BookingRepository $bookingRepository, UserRepository $userRepository , EntityManagerInterface $em, StateBookingRepository $stateBookingRepository): Response 
    {
        // Récupérer un user
        $user = $userRepository->find(1);

        // Reference du Booking (idbook + nbAlea)
        $booking = new Booking();
        $booking->setReference( $user->getId() . "-" .$book->getId())
        ->setUserId($user)
        ->addBook($book)
        ->setCreatedAt(new DateTimeImmutable("now"))
        ->setState($stateBookingRepository->find(29));

        dd($booking);
        $em->persist($booking);
        $em->flush();

        return $this->redirectToRoute('app_single', ['id' => $book->getId()]);

    } 
}
