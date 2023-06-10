<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610175545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAACCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_E23D8BAACCFA12B8 ON annoucement (profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAACCFA12B8');
        $this->addSql('DROP INDEX IDX_E23D8BAACCFA12B8 ON annoucement');
        $this->addSql('ALTER TABLE annoucement DROP profile_id');
    }
}
