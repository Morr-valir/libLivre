<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Booking;
use App\Repository\BookRepository;
use App\Repository\StateBookingRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SingleController extends AbstractController
{
    #[Route('/single/{id}', name: 'app_single')]
    public function index(int $id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->findById($id);

        return $this->render('single/index.html.twig', [
            'controller_name' => 'SingleController',
            'book' => $book
        ]);
    }

    #[Route('/single/addOrder/{id}', name: "app_single_add_order")]
    public function addOrder(Book $book, EntityManagerInterface $em, StateBookingRepository $stateBookingRepository): Response
    {
        $user = $this->getUser();

        $booking = new Booking();
        $booking->setReference($user->getId() . "-" . $book->getId())
            ->setUser($user)
            ->addBook($book)
            ->setCreatedAt(new DateTimeImmutable("now"))
            ->setState($stateBookingRepository->stateSelected("Reservé"));

        $em->persist($booking);
        $em->flush();

        return $this->redirectToRoute('app_single', ['id' => $book->getId()]);
    }
}