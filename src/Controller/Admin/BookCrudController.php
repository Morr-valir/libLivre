<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookCrudController extends AbstractCrudController
{
    public const BASE_PATH = 'upload/books';
    public const UPLOAD_DIR = 'public/upload/books';


    public static function getEntityFqcn(): string
    {
        return Book::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Liste de livres')
        ->setEntityLabelInSingular('Livre');
    }

    public function configureFields(string $pageName): iterable
    {
        return[
            TextField::new('name'),
            TextField::new('author'),
            ImageField::new('image')->setBasePath(self::BASE_PATH)->setUploadDir(self::UPLOAD_DIR)->setSortable(false),
            TextEditorField::new('summary'),
            DateField::new('relaseDate'),
            AssociationField::new('categories')
            
        ];
    }
}
