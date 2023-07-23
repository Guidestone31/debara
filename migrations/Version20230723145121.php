<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723145121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8932B110F5');
        $this->addSql('DROP INDEX IDX_16DB4F8932B110F5 ON picture');
        $this->addSql('ALTER TABLE picture CHANGE annoucement_id annoucements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F892A940AA6 FOREIGN KEY (annoucements_id) REFERENCES annoucement (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F892A940AA6 ON picture (annoucements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F892A940AA6');
        $this->addSql('DROP INDEX IDX_16DB4F892A940AA6 ON picture');
        $this->addSql('ALTER TABLE picture CHANGE annoucements_id annoucement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8932B110F5 FOREIGN KEY (annoucement_id) REFERENCES annoucement (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F8932B110F5 ON picture (annoucement_id)');
    }
}
