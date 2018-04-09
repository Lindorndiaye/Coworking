<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406151516 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, datereservation DATE NOT NULL, etat VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, contrat_id INT DEFAULT NULL, datepaiement DATETIME NOT NULL, montant INT NOT NULL, periode DATE NOT NULL, INDEX IDX_B1DC7A1E1823061F (contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, bien_id INT DEFAULT NULL, image LONGBLOB NOT NULL, INDEX IDX_C53D045FBD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_contrat (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, libelet VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, numpiece INT NOT NULL, nom_complet VARCHAR(30) NOT NULL, tel INT NOT NULL, adresse VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, bien_id INT DEFAULT NULL, date_contrat DATE NOT NULL, caution INT NOT NULL, duree VARCHAR(30) NOT NULL, INDEX IDX_6034999319EB6921 (client_id), INDEX IDX_60349993BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bien (id INT AUTO_INCREMENT NOT NULL, libelet VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, bien_parent_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, type_bien_id INT DEFAULT NULL, nom_bien VARCHAR(30) NOT NULL, etat TINYINT(1) NOT NULL, description VARCHAR(30) NOT NULL, INDEX IDX_45EDC3865B5147C8 (bien_parent_id), INDEX IDX_45EDC386924DD2B5 (localite_id), INDEX IDX_45EDC38695B4D7FA (type_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, bien_id INT DEFAULT NULL, nom_complet VARCHAR(30) NOT NULL, num_piece VARCHAR(30) NOT NULL, adress VARCHAR(30) NOT NULL, tel INT NOT NULL, codebanque VARCHAR(30) NOT NULL, INDEX IDX_69E399D619EB6921 (client_id), INDEX IDX_69E399D6BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E1823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3865B5147C8 FOREIGN KEY (bien_parent_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC38695B4D7FA FOREIGN KEY (type_bien_id) REFERENCES type_bien (id)');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D6BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386924DD2B5');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_6034999319EB6921');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D619EB6921');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E1823061F');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38695B4D7FA');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBD95B80F');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993BD95B80F');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC3865B5147C8');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D6BD95B80F');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE text_contrat');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE type_bien');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE proprietaire');
    }
}
