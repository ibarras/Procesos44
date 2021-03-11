<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216201319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ic_pago_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE SEQUENCE ic_pago_proyectado_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE SEQUENCE ic_patrocinador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ic_pago (id INT NOT NULL, id_pago_proyectado INT NOT NULL, fecha DATE DEFAULT NULL, monto NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62FA7384445BECE7 ON ic_pago (id_pago_proyectado)');
        //$this->addSql('CREATE TABLE ic_pago_proyectado (id INT NOT NULL, id_patrocinador INT DEFAULT NULL, fecha_pago_proyectado DATE DEFAULT NULL, fecha_limite_pago DATE DEFAULT NULL, monto NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id))');
        //$this->addSql('CREATE INDEX IDX_64C990ACE6B55293 ON ic_pago_proyectado (id_patrocinador)');
        //$this->addSql('CREATE TABLE ic_patrocinador (id INT NOT NULL, id_usuario INT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, nombre_comercial VARCHAR(255) DEFAULT NULL, rfc VARCHAR(255) DEFAULT NULL, correo VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        //$this->addSql('CREATE INDEX IDX_8378F853FCF8192D ON ic_patrocinador (id_usuario)');
        $this->addSql('ALTER TABLE ic_pago ADD CONSTRAINT FK_62FA7384445BECE7 FOREIGN KEY (id_pago_proyectado) REFERENCES ic_pago_proyectado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('ALTER TABLE ic_pago_proyectado ADD CONSTRAINT FK_64C990ACE6B55293 FOREIGN KEY (id_patrocinador) REFERENCES ic_patrocinador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('ALTER TABLE ic_patrocinador ADD CONSTRAINT FK_8378F853FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('ALTER INDEX idx_7ecc07eb541026f RENAME TO IDX_7ECC07EB2EFCD0C9');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ic_pago DROP CONSTRAINT FK_62FA7384445BECE7');
        $this->addSql('ALTER TABLE ic_pago_proyectado DROP CONSTRAINT FK_64C990ACE6B55293');
        $this->addSql('DROP SEQUENCE ic_pago_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ic_pago_proyectado_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ic_patrocinador_id_seq CASCADE');
        $this->addSql('DROP TABLE ic_pago');
        $this->addSql('DROP TABLE ic_pago_proyectado');
        $this->addSql('DROP TABLE ic_patrocinador');
        $this->addSql('ALTER INDEX idx_7ecc07eb2efcd0c9 RENAME TO idx_7ecc07eb541026f');
    }
}
