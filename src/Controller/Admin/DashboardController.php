<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\Log;
use App\Entity\StateBooking;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LibLivre - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Gestion des livres');
        yield MenuItem::linkToCrud('livre','fas fa-bowl-rice',Book::class);
        yield MenuItem::linkToCrud('catégorie','fas fa-bowl-rice',Category::class);
        yield MenuItem::section('Gestion des réservation');
        yield MenuItem::linkToCrud('Etat réservation','fas fa-bowl-rice',StateBooking::class);
        yield MenuItem::linkToCrud('Réservation','fas fa-bowl-rice',Booking::class);
        yield MenuItem::section('Gestion utilisateur');
        yield MenuItem::linkToCrud('Utilisateur','fas fa-bowl-rice',User::class);
        yield MenuItem::section('Affichage des ancienne réservation');
        yield MenuItem::linkToCrud('log réservation','fas fa-bowl-rice',Log::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
