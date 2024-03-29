<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827114013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annoucement (id INT AUTO_INCREMENT NOT NULL, villesfrance_id INT NOT NULL, sub_category_o_id INT NOT NULL, created_by_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_E23D8BAAC14B6A2B (villesfrance_id), INDEX IDX_E23D8BAA9F3799F2 (sub_category_o_id), INDEX IDX_E23D8BAAB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departements (num_departement VARCHAR(255) NOT NULL, id_region_dpt INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_CF7489B21D0F1D03 (id_region_dpt), PRIMARY KEY(num_departement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, annoucement_id INT DEFAULT NULL, paiement_id VARCHAR(255) NOT NULL, payer_id VARCHAR(255) NOT NULL, payer_email VARCHAR(255) NOT NULL, amont DOUBLE PRECISION NOT NULL, currency VARCHAR(255) NOT NULL, purchased_at DATETIME NOT NULL, paiement_status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B1DC7A1E32B110F5 (annoucement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, annoucements_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_16DB4F892A940AA6 (annoucements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (num_region INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(num_region)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category_one (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_48FC6C9D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, picture LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE villes_france (ville_id INT AUTO_INCREMENT NOT NULL, departement_code VARCHAR(255) DEFAULT NULL, ville_nom VARCHAR(45) NOT NULL, ville_code_postal VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, INDEX IDX_3F591C926A333750 (departement_code), PRIMARY KEY(ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAAC14B6A2B FOREIGN KEY (villesfrance_id) REFERENCES villes_france (ville_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAA9F3799F2 FOREIGN KEY (sub_category_o_id) REFERENCES sub_category_one (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAAB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departements ADD CONSTRAINT FK_CF7489B21D0F1D03 FOREIGN KEY (id_region_dpt) REFERENCES regions (num_region)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E32B110F5 FOREIGN KEY (annoucement_id) REFERENCES annoucement (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F892A940AA6 FOREIGN KEY (annoucements_id) REFERENCES annoucement (id)');
        $this->addSql('ALTER TABLE sub_category_one ADD CONSTRAINT FK_48FC6C9D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE villes_france ADD CONSTRAINT FK_3F591C926A333750 FOREIGN KEY (departement_code) REFERENCES departements (num_departement)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAAC14B6A2B');
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAA9F3799F2');
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAAB03A8386');
        $this->addSql('ALTER TABLE departements DROP FOREIGN KEY FK_CF7489B21D0F1D03');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E32B110F5');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F892A940AA6');
        $this->addSql('ALTER TABLE sub_category_one DROP FOREIGN KEY FK_48FC6C9D12469DE2');
        $this->addSql('ALTER TABLE villes_france DROP FOREIGN KEY FK_3F591C926A333750');
        $this->addSql('DROP TABLE annoucement');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE departements');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE regions');
        $this->addSql('DROP TABLE sub_category_one');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE villes_france');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
