<?php

namespace App\Controller\Admin;

use Exception;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Supprimer le Booking
        try {
            $entityManager->remove($entityInstance);
            $entityManager->flush();
        } catch (Exception $e) {
            $this->addFlash('danger', 'Veuillez passez la réservation en "Terminé" ou "Annulé" avant de supprimer celle-ci.');
        }
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Liste des réservation')
            ->setEntityLabelInSingular('Réservation');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference', 'Numéro de réservation')->setFormTypeOption('disabled', 'disabled'),
            DateField::new('created_At', 'Date de création')->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('state', 'Etat de réservation'),
            AssociationField::new('user')->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('books'),
        ];
    }
}
