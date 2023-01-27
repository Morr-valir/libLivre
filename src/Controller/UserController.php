<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Booking;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\BookRepository;
use App\Repository\BookingRepository;
use App\Repository\StateBookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user')]
    public function index(BookingRepository $bookingRepository, Request $request, EntityManagerInterface $em): Response
    {
        $arrayBooking = $bookingRepository->findBookingUser($this->getUser()->getID());

        // Récupérer les info du user connecté
        $user = $this->getUser();
        
        
        // Création du formulaire
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->flush();

            return $this->redirectToRoute('app_user');
        }


        return $this->renderForm('user/index.html.twig', [
            'controller_name' => 'UserController',
            'ArrayBooking' =>  $arrayBooking,
            'form' => $form
        ]);
    }
    
    #[Route('/profile/deleteBooking/{id}', name: 'app_user_delete_booking')]
    public function deleteBooking(Booking $booking, BookingRepository $bookingRepository,EntityManagerInterface $em, StateBookingRepository $stateBookingRepository): Response
    {
        // Récupérer le state "annulé"
        $stateAnnule = $stateBookingRepository->stateSelected("Annulé");

        // Passer le booking en annulé
        $booking->setState($stateAnnule);
        $em->flush(); 


        // Supprimer le Booking
        $em->remove($booking);
        $em->flush(); 

        // Rediriger sur la page /profile
        return $this->redirectToRoute("app_user");
    }


}
