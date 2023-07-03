<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703205814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement ADD sub_category_o_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAA9F3799F2 FOREIGN KEY (sub_category_o_id) REFERENCES sub_category_one (id)');
        $this->addSql('CREATE INDEX IDX_E23D8BAA9F3799F2 ON annoucement (sub_category_o_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAA9F3799F2');
        $this->addSql('DROP INDEX IDX_E23D8BAA9F3799F2 ON annoucement');
        $this->addSql('ALTER TABLE annoucement DROP sub_category_o_id');
    }
}
