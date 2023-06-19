<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619002522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Adresses (idAdresse INT AUTO_INCREMENT NOT NULL, numRue SMALLINT DEFAULT NULL, rue VARCHAR(25) NOT NULL, codePostal VARCHAR(255) DEFAULT NULL, Id_adresse_ville INT DEFAULT NULL, INDEX FK_ville_adresses (Id_adresse_ville), PRIMARY KEY(idAdresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Departements (num_departement VARCHAR(3) NOT NULL, id_region_dpt VARCHAR(2) DEFAULT NULL, nom CHAR(32) NOT NULL, INDEX FK_region_dpt (id_region_dpt), PRIMARY KEY(num_departement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Regions (num_region VARCHAR(2) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(num_region)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Villes_france (ville_id INT AUTO_INCREMENT NOT NULL, departement_code VARCHAR(3) DEFAULT NULL, ville_slug VARCHAR(255) DEFAULT NULL, ville_nom VARCHAR(45) DEFAULT NULL, ville_nom_simple VARCHAR(45) DEFAULT NULL, ville_nom_reel VARCHAR(45) DEFAULT NULL, ville_nom_soundex VARCHAR(20) DEFAULT NULL, ville_nom_metaphone VARCHAR(22) DEFAULT NULL, ville_code_postal VARCHAR(255) DEFAULT NULL, ville_commune VARCHAR(3) DEFAULT NULL, ville_code_commune VARCHAR(5) NOT NULL, ville_arrondissement SMALLINT UNSIGNED DEFAULT NULL, ville_canton VARCHAR(4) DEFAULT NULL, ville_amdi SMALLINT UNSIGNED DEFAULT NULL, ville_population_2010 INT UNSIGNED DEFAULT NULL, ville_population_1999 INT UNSIGNED DEFAULT NULL, ville_population_2012 INT UNSIGNED DEFAULT NULL COMMENT \'approximatif\', ville_densite_2010 INT DEFAULT NULL, ville_surface DOUBLE PRECISION DEFAULT NULL, ville_longitude_deg DOUBLE PRECISION DEFAULT NULL, ville_latitude_deg DOUBLE PRECISION DEFAULT NULL, ville_longitude_grd VARCHAR(9) DEFAULT NULL, ville_latitude_grd VARCHAR(8) DEFAULT NULL, ville_longitude_dms VARCHAR(9) DEFAULT NULL, ville_latitude_dms VARCHAR(8) DEFAULT NULL, ville_zmin INT DEFAULT NULL, ville_zmax INT DEFAULT NULL, INDEX ville_nom_metaphone (ville_nom_metaphone), INDEX ville_longitude_latitude_deg (ville_longitude_deg, ville_latitude_deg), INDEX ville_nom_reel (ville_nom_reel), INDEX ville_population_2010 (ville_population_2010), INDEX ville_departement (departement_code), INDEX ville_nom_simple (ville_nom_simple), INDEX ville_nom_soundex (ville_nom_soundex), INDEX ville_code_postal (ville_code_postal), INDEX ville_nom (ville_nom), UNIQUE INDEX ville_slug (ville_slug), UNIQUE INDEX ville_code_commune_2 (ville_code_commune), PRIMARY KEY(ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annoucement (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, sub_category_one_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, image LONGBLOB DEFAULT NULL, INDEX IDX_E23D8BAACCFA12B8 (profile_id), INDEX IDX_E23D8BAAEEC97447 (sub_category_one_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, phone_number INT DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, picture LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category_one (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_48FC6C9D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', email VARCHAR(255) NOT NULL, create_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Adresses ADD CONSTRAINT FK_166F4704859402ED FOREIGN KEY (Id_adresse_ville) REFERENCES Villes_france (ville_id)');
        $this->addSql('ALTER TABLE Departements ADD CONSTRAINT FK_D745524A1D0F1D03 FOREIGN KEY (id_region_dpt) REFERENCES Regions (num_region)');
        $this->addSql('ALTER TABLE Villes_france ADD CONSTRAINT FK_8C2757676A333750 FOREIGN KEY (departement_code) REFERENCES Departements (num_departement)');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAACCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE annoucement ADD CONSTRAINT FK_E23D8BAAEEC97447 FOREIGN KEY (sub_category_one_id) REFERENCES sub_category_one (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sub_category_one ADD CONSTRAINT FK_48FC6C9D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Adresses DROP FOREIGN KEY FK_166F4704859402ED');
        $this->addSql('ALTER TABLE Departements DROP FOREIGN KEY FK_D745524A1D0F1D03');
        $this->addSql('ALTER TABLE Villes_france DROP FOREIGN KEY FK_8C2757676A333750');
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAACCFA12B8');
        $this->addSql('ALTER TABLE annoucement DROP FOREIGN KEY FK_E23D8BAAEEC97447');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('ALTER TABLE sub_category_one DROP FOREIGN KEY FK_48FC6C9D12469DE2');
        $this->addSql('DROP TABLE Adresses');
        $this->addSql('DROP TABLE Departements');
        $this->addSql('DROP TABLE Regions');
        $this->addSql('DROP TABLE Villes_france');
        $this->addSql('DROP TABLE annoucement');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE sub_category_one');
        $this->addSql('DROP TABLE user');
    }
}
