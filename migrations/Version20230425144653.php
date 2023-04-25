<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425144653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_2');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_2');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY facture_ibfk_1');
        $this->addSql('ALTER TABLE bon_de_livraison DROP FOREIGN KEY bon_de_livraison_ibfk_1');
        $this->addSql('ALTER TABLE bon_de_livraison DROP FOREIGN KEY bon_de_livraison_ibfk_2');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY client_ibfk_1');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE bon_de_livraison');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP INDEX sous_rubrique_id ON produit');
        $this->addSql('DROP INDEX fournisseur_id ON produit');
        $this->addSql('ALTER TABLE produit ADD prix NUMERIC(5, 2) NOT NULL, DROP fournisseur_id, DROP price_ht, DROP sous_rubrique_id');
        $this->addSql('ALTER TABLE sous_rubrique DROP FOREIGN KEY sous_rubrique_ibfk_1');
        $this->addSql('ALTER TABLE sous_rubrique CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX rubrique_id ON sous_rubrique');
        $this->addSql('CREATE INDEX IDX_87EA3D293BD38833 ON sous_rubrique (rubrique_id)');
        $this->addSql('ALTER TABLE sous_rubrique ADD CONSTRAINT sous_rubrique_ibfk_1 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, country VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, client_id INT DEFAULT NULL, shipping_adress VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, facturation_adress VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, quantity INT NOT NULL, reduction INT DEFAULT NULL, tva INT DEFAULT NULL, INDEX client_id (client_id), INDEX produit_id (produit_id), PRIMARY KEY(id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, date DATE NOT NULL, INDEX commande_id (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bon_de_livraison (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, commande_id INT DEFAULT NULL, date DATE NOT NULL, quantity INT NOT NULL, INDEX produit_id (produit_id), INDEX commande_id (commande_id), PRIMARY KEY(id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, surname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, country VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type TINYINT(1) DEFAULT NULL, coef NUMERIC(4, 2) NOT NULL, INDEX employe_id (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_2 FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT facture_ibfk_1 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE bon_de_livraison ADD CONSTRAINT bon_de_livraison_ibfk_1 FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE bon_de_livraison ADD CONSTRAINT bon_de_livraison_ibfk_2 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT client_ibfk_1 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE produit ADD fournisseur_id INT DEFAULT NULL, ADD price_ht NUMERIC(4, 2) NOT NULL, ADD sous_rubrique_id INT DEFAULT NULL, DROP prix');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_2 FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX sous_rubrique_id ON produit (sous_rubrique_id)');
        $this->addSql('CREATE INDEX fournisseur_id ON produit (fournisseur_id)');
        $this->addSql('ALTER TABLE sous_rubrique DROP FOREIGN KEY FK_87EA3D293BD38833');
        $this->addSql('ALTER TABLE sous_rubrique CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('DROP INDEX idx_87ea3d293bd38833 ON sous_rubrique');
        $this->addSql('CREATE INDEX rubrique_id ON sous_rubrique (rubrique_id)');
        $this->addSql('ALTER TABLE sous_rubrique ADD CONSTRAINT FK_87EA3D293BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
    }
}
