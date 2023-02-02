<?php

namespace App\Service;

use App\Entity\Book;
use League\Csv\Reader;
use App\Repository\BookRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportbookCommandService
{
    public function __construct(
        private BookRepository $repoBook,
        private EntityManagerInterface $em
        )
    {

    }
    public function importbook(SymfonyStyle $io): void
    {
        $io->title('Importation des livres');
        $books = $this->readCsvFile();
        $io->progressStart(count($books));
        foreach ($books as $arrayBook)
        {
            $io->progressAdvance();
            $books = $this->createOrupdateBook($arrayBook);
            $this->em->persist($books);
        }
        $this->em->flush();
        $io->progressFinish();
        $io->success('Importation terminée');
    }

    private function readCsvFile(): Reader
    {
        $reader = Reader::createFromPath('%kernel.root_dir%\..\import\importBooksv2.csv','r');
        $reader->setDelimiter(';');
        $reader->setHeaderOffset(0);

        return $reader;
    }

    private function createOrupdateBook(array $arrayBook): Book
    {
        $book = $this->repoBook->findOneBy(['name' => $arrayBook['name']]);
        if(!$book){
            $book = new Book();
        }
        $book
        ->setName($arrayBook['name'])
        ->setAuthor($arrayBook['author'])
        ->setSummary($arrayBook['summary'])
        ->setReleaseDate(new DateTime($arrayBook['releaseDate']) )
        ->setImage($arrayBook['image'])
        ->setIsAvailable($arrayBook['isAvailable']);
        return $book;
    }
}