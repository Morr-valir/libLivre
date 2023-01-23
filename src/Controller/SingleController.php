<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleController extends AbstractController
{
    #[Route('/single', name: 'app_single')]
    public function index(): Response
    {
        return $this->render('single/index.html.twig', [
            'controller_name' => 'SingleController',
        ]);
    }
}
