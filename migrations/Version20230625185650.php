<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230625185650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAACCF9E01E FOREIGN KEY (departement_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_E23D8BAACCF9E01E ON annoucement (departement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAACCF9E01E');
        $this->addSql('DROP INDEX IDX_E23D8BAACCF9E01E ON annoucement');
        $this->addSql('ALTER TABLE annoucement DROP departement_id');
    }
}
