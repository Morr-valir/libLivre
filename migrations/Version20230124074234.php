<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124074234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_book (booking_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_D374817F3301C60 (booking_id), INDEX IDX_D374817F16A2B381 (book_id), PRIMARY KEY(booking_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, refence_booking VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, etat VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_book ADD CONSTRAINT FK_D374817F3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_book ADD CONSTRAINT FK_D374817F16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_book DROP FOREIGN KEY FK_D374817F3301C60');
        $this->addSql('ALTER TABLE booking_book DROP FOREIGN KEY FK_D374817F16A2B381');
        $this->addSql('DROP TABLE booking_book');
        $this->addSql('DROP TABLE log');
    }
}
