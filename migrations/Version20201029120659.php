<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029120659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_conge ADD personnel_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_conge ADD CONSTRAINT FK_D80610611C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_D80610611C109075 ON demande_conge (personnel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_conge DROP FOREIGN KEY FK_D80610611C109075');
        $this->addSql('DROP INDEX IDX_D80610611C109075 ON demande_conge');
        $this->addSql('ALTER TABLE demande_conge DROP personnel_id');
    }
}
