<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user')]
    public function index(BookingRepository $bookingRepository): Response
    {
        $arrayBooking = $bookingRepository->findBookingUser($this->getUser()->getID());
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'ArrayBooking' =>  $arrayBooking,
        ]);
    }
}
