<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
