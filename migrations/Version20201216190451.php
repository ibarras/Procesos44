<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216190451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ic_patrocinador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ic_patrocinador (id INT NOT NULL, id_usuario INT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, nombre_comercial VARCHAR(255) DEFAULT NULL, rfc VARCHAR(255) DEFAULT NULL, correo VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8378F853FCF8192D ON ic_patrocinador (id_usuario)');
        $this->addSql('ALTER TABLE ic_patrocinador ADD CONSTRAINT FK_8378F853FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX idx_7ecc07eb541026f RENAME TO IDX_7ECC07EB2EFCD0C9');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ic_patrocinador_id_seq CASCADE');
        $this->addSql('DROP TABLE ic_patrocinador');
        $this->addSql('ALTER INDEX idx_7ecc07eb2efcd0c9 RENAME TO idx_7ecc07eb541026f');
    }
}
