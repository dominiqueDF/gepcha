<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212122610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__owner AS SELECT id, gender, last_name, first_name, email, phone_number, address_line1, address_line2, city, postal_code FROM owner');
        $this->addSql('DROP TABLE owner');
        $this->addSql('CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL COLLATE BINARY, first_name VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, phone_number VARCHAR(10) NOT NULL COLLATE BINARY, address_line1 VARCHAR(255) NOT NULL COLLATE BINARY, address_line2 VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) NOT NULL COLLATE BINARY, title VARCHAR(8) NOT NULL, post_code VARCHAR(5) NOT NULL)');
        $this->addSql('INSERT INTO owner (id, title, last_name, first_name, email, phone_number, address_line1, address_line2, city, post_code) SELECT id, gender, last_name, first_name, email, phone_number, address_line1, address_line2, city, postal_code FROM __temp__owner');
        $this->addSql('DROP TABLE __temp__owner');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__owner AS SELECT id, title, last_name, first_name, email, phone_number, address_line1, address_line2, city, post_code FROM owner');
        $this->addSql('DROP TABLE owner');
        $this->addSql('CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(10) NOT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, gender VARCHAR(8) NOT NULL COLLATE BINARY, postal_code VARCHAR(5) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO owner (id, gender, last_name, first_name, email, phone_number, address_line1, address_line2, city, postal_code) SELECT id, title, last_name, first_name, email, phone_number, address_line1, address_line2, city, post_code FROM __temp__owner');
        $this->addSql('DROP TABLE __temp__owner');
    }
}
