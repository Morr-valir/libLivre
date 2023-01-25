<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Book;
use App\Entity\User;
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
        $date1 = new DateTime('08/04/2000');
        $book1->setName("Harry Potter")
        ->setAuthor("Nom de l'auteur")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date1)
        ->addCategory($category1)
        ->setIsAvailable(true)
        ->setImage('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcT99IrfJ3_BVvv08GQfE1GO0w7fXygEag5pblx5mb3ItWfmuUa4');
        $manager->persist($book1);
        $manager->flush();

        $book2 = new Book();
        $date2 = new DateTime('06/04/2014');
        $book2->setName("Excalibur")
        ->setAuthor("Nom de l'auteur 2")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date2)
        ->addCategory($category2)
        ->setIsAvailable(true)
        ->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN2BZludkjNUBX46SzMVg8l9MYjAuCjefpwb3Gdf8aGJKy3A73');
        $manager->persist($book2);
        $manager->flush();

        $book3 = new Book();
        $date3 = new DateTime('07/05/2012');
        $book3->setName("007")
        ->setAuthor("Nom de l'auteur 3")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date3)
        ->addCategory($category2)
        ->setIsAvailable(true)
        ->setImage('https://images-metadata-tea.s3.eu-central-1.amazonaws.com/0c/d1/metadata-image-65095778.jpeg');
        $manager->persist($book3);
        $manager->flush();

        $book4 = new Book();
        $date4 = new DateTime('10/04/2020');
        $book4->setName("Peter Pan")
        ->setAuthor("Nom de l'auteur 2")
        ->setSummary("Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici Résumé du livre ici")
        ->setReleaseDate($date4)
        ->addCategory($category2)
        ->setIsAvailable(true)
        ->setImage('https://assets.edenlivres.fr/medias/d3/16b51f464676389c38791ab4b7bdb4f8914de6.jpg?h=-&w=200');
        $manager->persist($book4);
        $manager->flush();

        // Création des State
        $states = ["Reserver","En cours","Emprunter","Terminer"];
        foreach($states as $state){
            $stateBooking = new StateBooking();
            $stateBooking->setName($state);
            $manager->persist($stateBooking);
            $manager->flush();
        }

        // Création d'un user
        $user = new User();
        $user->setEmail("test@gmail.com")
        ->setPassword("123")
        ->setFirstname("test")
        ->setLastname("test")
        ->setTel("0692123456")
        ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        $manager->flush();
    }
}
