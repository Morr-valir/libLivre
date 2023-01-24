<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124054709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, library_id_id INT NOT NULL, book_id_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4B3656604CE14C78 (library_id_id), UNIQUE INDEX UNIQ_4B36566071868B2E (book_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656604CE14C78 FOREIGN KEY (library_id_id) REFERENCES library (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566071868B2E FOREIGN KEY (book_id_id) REFERENCES book (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656604CE14C78');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566071868B2E');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE stock');
    }
}
