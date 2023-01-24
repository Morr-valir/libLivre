<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\StateBooking;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        // Création des 2 Category
        $category1 = new Category();
        $category1->setName("Aventure")
        ->setIsForAdult(false);
        $manager->persist($category1);
        $manager->flush();


        $category2 = new Category();
        $category2->setName("Action")
        ->setIsForAdult(true);
        $manager->persist($category2);
        $manager->flush();


        // Création des 2 Book
        $book1 = new Book();
        $date1 = new DateTime('06/04/2014');
        $book1->setName("Harry Potter")
        ->setAuthor("Nom de l'auteur")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date1)
        ->addCategory($category1);
        $manager->persist($book1);
        $manager->flush();

        $book2 = new Book();
        $date2 = new DateTime('06/04/2014');
        $book2->setName("Excalibur")
        ->setAuthor("Nom de l'auteur 2")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date2)
        ->addCategory($category2);
        $manager->persist($book2);
        $manager->flush();

        // Création des State
        $states = ["Reserver","En cours","Emprunter","Terminer"];
        foreach($states as $state){
            $stateBooking = new StateBooking();
            $stateBooking->setName($state);
            $manager->persist($stateBooking);
            $manager->flush();
        }
    }
}
