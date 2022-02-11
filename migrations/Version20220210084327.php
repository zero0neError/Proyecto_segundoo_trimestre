<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210084327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservas (id INT AUTO_INCREMENT NOT NULL, fkcorreo_id INT NOT NULL, fecha_de_inicio_de_reserva DATE NOT NULL, fecha_fin_de_reserva DATE NOT NULL, fecha_creacion_reserva DATE NOT NULL, INDEX IDX_AA1DAB014E73E4 (fkcorreo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB014E73E4 FOREIGN KEY (fkcorreo_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservas');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hash_email hash_email VARCHAR(32) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
