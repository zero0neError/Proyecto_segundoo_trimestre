<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217072003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tipo_producto (id INT AUTO_INCREMENT NOT NULL, nombre_id INT NOT NULL, UNIQUE INDEX UNIQ_717E5CDCC2D4D747 (nombre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tipo_producto ADD CONSTRAINT FK_717E5CDCC2D4D747 FOREIGN KEY (nombre_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE producto ADD img VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tipo_producto');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE producto DROP img, CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(300) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE talla talla VARCHAR(2) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE resolucion resolucion VARCHAR(5) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo_producto tipo_producto VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hash_email hash_email VARCHAR(32) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
