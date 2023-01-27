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

        $category3 = new Category();
        $category3->setName("Comedie")
            ->setIsForAdult(true);
        $manager->persist($category3);
        $manager->flush();

        $category4 = new Category();
        $category4->setName("Romance")
            ->setIsForAdult(true);
        $manager->persist($category4);
        $manager->flush();

        $category5 = new Category();
        $category5->setName("Science-Fiction")
            ->setIsForAdult(true);
        $manager->persist($category5);
        $manager->flush();

        $category6 = new Category();
        $category6->setName("Drame")
            ->setIsForAdult(true);
        $manager->persist($category6);
        $manager->flush();


        // Création des 2 Book
        $book1 = new Book();
        $date1 = new DateTime('08/04/2000');
        $book1->setName("Harry Potter")
            ->setAuthor("Joanne Kathleen Rowling")
            ->setSummary("Cette sixième année scolaire de Harry Potter à l'école de sorciers commence par une dispute avec son ennemi juré Draco Malfoy, en qui les forces des ténèbres placent désormais leurs espoirs. Accaparés par les émois et les malentendus amoureux, Hermione et Ron remarquent à peine que Harry enquête à la demande de Dumbledore sur le passé du professeur Slughorn. Entré dans le cercle des intimes de l'enseignant sur la foi de bonnes notes grâce à un manuel scolaire annoté, Harry se rapproche du but.")
            ->setReleaseDate($date1)
            ->addCategory($category1)
            ->setIsAvailable(true)
            ->setImage('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcT99IrfJ3_BVvv08GQfE1GO0w7fXygEag5pblx5mb3ItWfmuUa4');
        $manager->persist($book1);
        $manager->flush();

        $book2 = new Book();
        $date2 = new DateTime('06/04/2014');
        $book2->setName("Excalibur")
            ->setAuthor("Thomas Malory")
            ->setSummary("Uter Pendragon reçoit de Merlin l'Enchanteur l'épée mythique Excalibur. A la mort d'Uter, l'épée reste figée dans une stèle de granit. Seul le jeune Arthur, fils illégitime d'Uter parvient à brandir l'épée Excalibur et devient par ce geste le roi d'Angleterre. Quelques années plus tard, il épouse Guenièvre et réunit les Chevaliers de la Table Ronde. Mais sa demi-soeur, la méchante Morgane, parvient à avoir un fils d'Arthur qui va le pousser à sa perte.")
            ->setReleaseDate($date2)
            ->addCategory($category2)
            ->setIsAvailable(true)
            ->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN2BZludkjNUBX46SzMVg8l9MYjAuCjefpwb3Gdf8aGJKy3A73');
        $manager->persist($book2);
        $manager->flush();

        $book3 = new Book();
        $date3 = new DateTime('07/05/2012');
        $book3->setName("007")
            ->setAuthor("Ian Fleming")
            ->setSummary("Un message cryptique surgi du passé entraîne James Bond dans une mission très personnelle à Mexico puis à Rome, où il rencontre Lucia Sciarra, la très belle veuve d'un célèbre criminel. Bond réussit à infiltrer une réunion secrète révélant une redoutable organisation baptisée Spectre. Pendant ce temps, à Londres, Max Denbigh, le nouveau directeur du Centre pour la Sécurité Nationale, remet en cause les actions de Bond et l'existence même du MI6, dirigé par M.")
            ->setReleaseDate($date3)
            ->addCategory($category2)
            ->setIsAvailable(true)
            ->setImage('https://images-metadata-tea.s3.eu-central-1.amazonaws.com/0c/d1/metadata-image-65095778.jpeg');
        $manager->persist($book3);
        $manager->flush();

        $book4 = new Book();
        $date4 = new DateTime('10/04/2020');
        $book4->setName("Peter Pan")
            ->setAuthor("J. M. Barrie")
            ->setSummary("Peter Pan est un enfant joyeux, surdoué, et toujours prêt à aider les autres. Il a un don particulier : celui de se mettre à voler lorsqu'il pense à une chose agréable. Un jour, une fée appelée la Fée clochette prend contact avec Peter Pan. Il doit l'aider à retrouver des enfants, prisonniers sur l'île des enfants perdus. Il doit en outre leur trouver une maman. Ce sera la jeune Wendy. Avant cela, Peter Pan doit combattre le terrible capitaine Crochet ainsi qu'un féroce crocodile.")
            ->setReleaseDate($date4)
            ->addCategory($category2)
            ->setIsAvailable(true)
            ->setImage('https://assets.edenlivres.fr/medias/d3/16b51f464676389c38791ab4b7bdb4f8914de6.jpg?h=-&w=200');
        $manager->persist($book4);
        $manager->flush();

        $book5 = new Book();
        $date5 = new DateTime('04/01/2023');
        $book5->setName("Les derniers géants")
            ->setAuthor("Nom de l'auteur 2")
            ->setSummary("Colleen et Rich Gundersen habitent avec leur jeune fils Chub sur la côte en Californie du Nord. On est en 1977, et l'existence dans cette région forestière est de plus en plus difficile. Depuis des générations, le bois fait vivre toute la communauté, mais aujourd'hui ce mode de vie est menacé.

            Quoique sans diplôme, Colleen est sage-femme. Rich, lui, est de ces élagueurs qui travaillent au sommet des arbres. C'est un métier dangereux, dont son père et son grand-père sont morts. Il souhaite une vie meilleure pour sa famille. Pour cela, il a investi en secret toutes leurs économies dans un lot de séquoias pluricentenaires. Mais lorsque Colleen, qui veut avoir un deuxième enfant malgré la perte d'un bébé lors de sa dernière grossesse, se met à dénoncer les pratiques de la compagnie d'abattage et l'épandage d'herbicides responsables, selon elle, de nombreuses fausses couches dans la région, Rich et elle se retrouvent dans deux camps adverses.
            
            Encensée par Stephen King et toute la presse américaine, Ash Davidson signe avec ce texte bouleversant une fresque ample, puissante et tellurique.")
            ->setReleaseDate($date5)
            ->addCategory($category3)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/132/9782330174132.webp');
        $manager->persist($book5);
        $manager->flush();

        $book6 = new Book();
        $date6 = new DateTime('06/05/2021');
        $book6->setName("Deacon King Kong")
            ->setAuthor(" Jim Harrison ")
            ->setSummary("New York, à la fin des années 1960. Sur un coup de tête, le vieux Sportcoat tente de tuer un trafiquant du quartier.")
            ->setReleaseDate($date6)
            ->addCategory($category4)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/446/9782351782446.webp');
        $manager->persist($book6);
        $manager->flush();

        $book7 = new Book();
        $date7 = new DateTime('08/19/2020');
        $book7->setName("Mon combat. Vol. 6. Fin de combat")
            ->setAuthor(" Jim Harrison ")
            ->setSummary("Au coeur de la vie d'un écrivain

            « Entre vingt et trente ans, cette décennie effroyable, j'avais essayé de prendre part à la vie autour de moi, à la vie normale, à ce que tout un chacun vivait, mais sans y parvenir, et ce sentiment d'échec était si fort, cet éclair d'indignité si intense que peu à peu, sans en être conscient, je me focalisai sur autre chose, me plongeai plus profondément dans la littérature, sans que cela ait l'air d'une retraite, d'un refuge, mais au contraire d'un élan fort et triomphal, et, avant même de m'en rendre compte, c'était devenu ma vie. »
            
            Âgé de quarante ans dans ce récit, Knausgaard est à l'aube de sa gloire internationale. Il partage son quotidien entre l'écriture de ce qui sera son grand oeuvre et l'éducation de ses trois enfants en bas âge. Sa vie à Malmö est réglée comme du papier à musique. Jusqu'à ce que son oncle s'oppose à la publication de son premier ouvrage autobiographique. Un interdit qui va le plonger dans une grande angoisse et déséquilibrer profondément sa vie d'homme et de père.
            
            Fin de combat est une réflexion bouleversante sur les rapports de Knausgaard à son père et à sa famille. De sa voix singulière, il interroge les textes littéraires et politiques les plus emblématiques du XXe siècle, d'À la recherche du temps perdu à Mein Kampf, pour comprendre la relation mystérieuse qu'entretiennent l'écriture et la vie.")
            ->setReleaseDate($date7)
            ->addCategory($category3)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/089/9782207136089.webp');
        $manager->persist($book7);
        $manager->flush();

        $book8 = new Book();
        $date8 = new DateTime('10/04/2020');
        $book8->setName("En marge : mémoires")
            ->setAuthor(" Jim Harrison ")
            ->setSummary("Dans cette luxuriante autobiographie, Jim Harrison commence par le récit de son enfance. Mais plutôt que d'en distiller les détails, le grand romancier américain en retient surtout les images intenses, celles imprégnées de nourritures délicieuses, de feuilles fraîches et de bruits de rivière, car seule «la sensualité marque la mémoire».

            Dès lors, l'écriture déroule un formidable et gargantuesque appétit pour la vie, mais aussi une mélancolie profonde dont Jim Harrison, comme tout hédoniste, n'est pas exempt. Mais le plus extraordinaire est encore dans cette folle déclaration d'amour adressée à la littérature. En marge, dans le fond, n'est traversé que par un seul récit: celui d'une vie vouée à l'écriture.
            
            «Des coups de blues, des parties de rigolade, des plages de solitude, l'amitié, tels sont les ingrédients mélangés dans ce cocktail à boire cul sec: attention, il est très fort. À consommer sans modération.»
            
            Éric Neuhoff, Figaro Madame")
            ->setReleaseDate($date8)
            ->addCategory($category4)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/194/9782264039194.webp');
        $manager->persist($book8);
        $manager->flush();

        $book9 = new Book();
        $date9 = new DateTime('10/04/2020');
        $book9->setName("Les trois roses jaunes")
            ->setAuthor("Raymond Carver")
            ->setSummary("Le coeur est en liesse, les couples se forment, se marient et s'installent dans des maisons de banlieue comme il y en a tant. Les matins se suivent, les cigarettes se consument et, comme l'amour, finissent par s'éteindre. Les femmes s'en vont, laissant leurs maris hébétés. Dans le salon désormais vide, ils contemplent ce qui reste, trois roses jaunes, et s'accordent une nouvelle volute de fumée.")
            ->setReleaseDate($date9)
            ->addCategory($category5)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/043/9782757835043.webp');
        $manager->persist($book9);
        $manager->flush();

        $book10 = new Book();
        $date10 = new DateTime('10/04/2020');
        $book10->setName("Neuf histoires et un poème")
            ->setAuthor("Raymond Carver")
            ->setSummary("En 1993, Robert Altman réalise un vieux rêve : adapter au cinéma l'oeuvre de Raymond Carver. Le résultat : Shortcuts, film mythique interprété (entre autres) par Jennifer Jason Leigh, Tim Robbins, Jack Lemmon, Tom Waits et Frances McDormand. Altman s'est inspiré de neuf nouvelles et d'un poème. À ce jour, ils demeurent la meilleure initiation aux écrits de « Ray » Carver, sans nul doute l'un des plus grands écrivains américains du XXe siècle. Son écriture limpide met en scène des gens « ordinaires » - une serveuse de restaurant, un chômeur, un père anxieux, trois pêcheurs, des voisins trop curieux - hantés par deux idées fixes : le besoin d'une véritable intimité et la quête toujours remise au lendemain d'une introuvable dignité.")
            ->setReleaseDate($date10)
            ->addCategory($category6)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/324/9782823619324.webp');
        $manager->persist($book10);
        $manager->flush();

        $book11 = new Book();
        $date11 = new DateTime('10/04/2020');
        $book11->setName("En marge : mémoires 2")
            ->setAuthor(" Jim Harrison ")
            ->setSummary("Dans cette luxuriante autobiographie, Jim Harrison commence par le récit de son enfance. Mais plutôt que d'en distiller les détails, le grand romancier américain en retient surtout les images intenses, celles imprégnées de nourritures délicieuses, de feuilles fraîches et de bruits de rivière, car seule «la sensualité marque la mémoire».

            Dès lors, l'écriture déroule un formidable et gargantuesque appétit pour la vie, mais aussi une mélancolie profonde dont Jim Harrison, comme tout hédoniste, n'est pas exempt. Mais le plus extraordinaire est encore dans cette folle déclaration d'amour adressée à la littérature. En marge, dans le fond, n'est traversé que par un seul récit: celui d'une vie vouée à l'écriture.
            
            «Des coups de blues, des parties de rigolade, des plages de solitude, l'amitié, tels sont les ingrédients mélangés dans ce cocktail à boire cul sec: attention, il est très fort. À consommer sans modération.»
            
            Éric Neuhoff, Figaro Madame")
            ->setReleaseDate($date11)
            ->addCategory($category4)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/194/9782264039194.webp');
        $manager->persist($book11);
        $manager->flush();

        $book12 = new Book();
        $date12 = new DateTime('10/04/2020');
        $book12->setName("Les trois roses jaunes 2")
            ->setAuthor("Raymond Carver")
            ->setSummary("Le coeur est en liesse, les couples se forment, se marient et s'installent dans des maisons de banlieue comme il y en a tant. Les matins se suivent, les cigarettes se consument et, comme l'amour, finissent par s'éteindre. Les femmes s'en vont, laissant leurs maris hébétés. Dans le salon désormais vide, ils contemplent ce qui reste, trois roses jaunes, et s'accordent une nouvelle volute de fumée.")
            ->setReleaseDate($date12)
            ->addCategory($category5)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/043/9782757835043.webp');
        $manager->persist($book12);
        $manager->flush();

        $book13 = new Book();
        $date13 = new DateTime('10/04/2020');
        $book13->setName("Neuf histoires et un poème 3")
            ->setAuthor("Raymond Carver")
            ->setSummary("En 1993, Robert Altman réalise un vieux rêve : adapter au cinéma l'oeuvre de Raymond Carver. Le résultat : Shortcuts, film mythique interprété (entre autres) par Jennifer Jason Leigh, Tim Robbins, Jack Lemmon, Tom Waits et Frances McDormand. Altman s'est inspiré de neuf nouvelles et d'un poème. À ce jour, ils demeurent la meilleure initiation aux écrits de « Ray » Carver, sans nul doute l'un des plus grands écrivains américains du XXe siècle. Son écriture limpide met en scène des gens « ordinaires » - une serveuse de restaurant, un chômeur, un père anxieux, trois pêcheurs, des voisins trop curieux - hantés par deux idées fixes : le besoin d'une véritable intimité et la quête toujours remise au lendemain d'une introuvable dignité.")
            ->setReleaseDate($date13)
            ->addCategory($category6)
            ->setIsAvailable(true)
            ->setImage('https://www.lalibrairie.com/cache/img/livres/324/9782823619324.webp');
        $manager->persist($book13);
        $manager->flush();
















        // Création des State
        $states = ["Reservé", "En cours", "Emprunté", "Terminé","Annulé"];
        foreach ($states as $state) {
            $stateBooking = new StateBooking();
            $stateBooking->setName($state);
            $manager->persist($stateBooking);
            $manager->flush();
        }

        // Création d'un user
        $user = new User();
        $user->setEmail("test@gmail.com")
            ->setPassword('$2y$13$BKnERN.KtvSim4JgJJc1nuIJAOJL.2JrDDjxpGQbivdEOgelYhxG2')
            ->setFirstname("test")
            ->setLastname("test")
            ->setTel("0692123456")
            ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        $manager->flush();
    }
}