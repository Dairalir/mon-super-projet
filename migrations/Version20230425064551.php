<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425064551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_2');
        $this->addSql('CREATE TABLE produit_sous_rubrique (produit_id INT NOT NULL, sous_rubrique_id INT NOT NULL, INDEX IDX_A9B49BF7F347EFB (produit_id), INDEX IDX_A9B49BF77BEAFB00 (sous_rubrique_id), PRIMARY KEY(produit_id, sous_rubrique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_sous_rubrique ADD CONSTRAINT FK_A9B49BF7F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_sous_rubrique ADD CONSTRAINT FK_A9B49BF77BEAFB00 FOREIGN KEY (sous_rubrique_id) REFERENCES sous_rubrique (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_1');
        $this->addSql('DROP INDEX srub_id ON produit');
        $this->addSql('DROP INDEX fou_id ON produit');
        $this->addSql('ALTER TABLE produit ADD prix NUMERIC(5, 2) NOT NULL, DROP srub_id, DROP fou_id, DROP price_ht');
        $this->addSql('ALTER TABLE rubrique CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sous_rubrique DROP FOREIGN KEY sous_rubrique_ibfk_1');
        $this->addSql('DROP INDEX rub_id ON sous_rubrique');
        $this->addSql('ALTER TABLE sous_rubrique ADD picture VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE rub_id rubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_rubrique ADD CONSTRAINT FK_87EA3D293BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX IDX_87EA3D293BD38833 ON sous_rubrique (rubrique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, country VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, pro_id INT NOT NULL, cli_id INT DEFAULT NULL, shipping_adress VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, facturation_adress VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, quantity INT NOT NULL, reduction INT DEFAULT NULL, tva INT DEFAULT NULL, INDEX cli_id (cli_id), INDEX pro_id (pro_id), PRIMARY KEY(id, pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, cmd_id INT DEFAULT NULL, date DATE NOT NULL, INDEX cmd_id (cmd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bon_de_livraison (id INT AUTO_INCREMENT NOT NULL, pro_id INT NOT NULL, cmd_id INT DEFAULT NULL, date DATE NOT NULL, quantity INT NOT NULL, INDEX pro_id (pro_id), INDEX cmd_id (cmd_id), PRIMARY KEY(id, pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, emp_id INT DEFAULT NULL, surname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, country VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type TINYINT(1) DEFAULT NULL, coef NUMERIC(4, 2) NOT NULL, INDEX emp_id (emp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adress VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, postal_code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (cli_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_2 FOREIGN KEY (pro_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT facture_ibfk_1 FOREIGN KEY (cmd_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE bon_de_livraison ADD CONSTRAINT bon_de_livraison_ibfk_1 FOREIGN KEY (pro_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE bon_de_livraison ADD CONSTRAINT bon_de_livraison_ibfk_2 FOREIGN KEY (cmd_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT client_ibfk_1 FOREIGN KEY (emp_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE produit_sous_rubrique DROP FOREIGN KEY FK_A9B49BF7F347EFB');
        $this->addSql('ALTER TABLE produit_sous_rubrique DROP FOREIGN KEY FK_A9B49BF77BEAFB00');
        $this->addSql('DROP TABLE produit_sous_rubrique');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE rubrique CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD srub_id INT DEFAULT NULL, ADD fou_id INT DEFAULT NULL, ADD price_ht NUMERIC(4, 2) NOT NULL, DROP prix');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_1 FOREIGN KEY (srub_id) REFERENCES sous_rubrique (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_2 FOREIGN KEY (fou_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX srub_id ON produit (srub_id)');
        $this->addSql('CREATE INDEX fou_id ON produit (fou_id)');
        $this->addSql('ALTER TABLE sous_rubrique DROP FOREIGN KEY FK_87EA3D293BD38833');
        $this->addSql('DROP INDEX IDX_87EA3D293BD38833 ON sous_rubrique');
        $this->addSql('ALTER TABLE sous_rubrique DROP picture, CHANGE name name VARCHAR(50) NOT NULL, CHANGE rubrique_id rub_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_rubrique ADD CONSTRAINT sous_rubrique_ibfk_1 FOREIGN KEY (rub_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX rub_id ON sous_rubrique (rub_id)');
    }
}
