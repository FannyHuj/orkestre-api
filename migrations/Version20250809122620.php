<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250809122620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id SERIAL NOT NULL, organizer_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, evenement_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, location VARCHAR(255) DEFAULT NULL, max_capacity INT DEFAULT NULL, price INT DEFAULT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B26681E876C4DDA ON evenement (organizer_id)');
        $this->addSql('CREATE TABLE evenement_user (evenement_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(evenement_id, user_id))');
        $this->addSql('CREATE INDEX IDX_2EC0B3C4FD02F13 ON evenement_user (evenement_id)');
        $this->addSql('CREATE INDEX IDX_2EC0B3C4A76ED395 ON evenement_user (user_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E876C4DDA FOREIGN KEY (organizer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement_user ADD CONSTRAINT FK_2EC0B3C4FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement_user ADD CONSTRAINT FK_2EC0B3C4A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681E876C4DDA');
        $this->addSql('ALTER TABLE evenement_user DROP CONSTRAINT FK_2EC0B3C4FD02F13');
        $this->addSql('ALTER TABLE evenement_user DROP CONSTRAINT FK_2EC0B3C4A76ED395');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_user');
        $this->addSql('DROP TABLE "user"');
    }
}
