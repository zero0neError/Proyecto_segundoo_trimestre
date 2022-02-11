<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210083252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reserva');
        $this->addSql('ALTER TABLE usuario ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD hash_email VARCHAR(32) DEFAULT NULL, DROP correo, CHANGE nombre nombre VARCHAR(40) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, correo_fk_id INT NOT NULL, fecha_inicio_de_reserva DATE NOT NULL, fecha_fin_de_reserva DATE NOT NULL, fecha_creacion_reserva DATE NOT NULL, INDEX IDX_188D2E3BB0A462A3 (correo_fk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BB0A462A3 FOREIGN KEY (correo_fk_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_2265B05DE7927C74 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD correo VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP email, DROP roles, DROP password, DROP hash_email, CHANGE nombre nombre VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
