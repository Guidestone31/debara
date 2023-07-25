<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725091923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement ADD paiment_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAA86FB6C2E FOREIGN KEY (paiment_id_id) REFERENCES paiement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E23D8BAA86FB6C2E ON annoucement (paiment_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAA86FB6C2E');
        $this->addSql('DROP INDEX UNIQ_E23D8BAA86FB6C2E ON annoucement');
        $this->addSql('ALTER TABLE annoucement DROP paiment_id_id');
    }
}
