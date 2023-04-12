<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407111146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD address VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, DROP adres, DROP postcode, DROP stad, DROP naam');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD adres VARCHAR(255) NOT NULL, ADD postcode VARCHAR(255) NOT NULL, ADD stad VARCHAR(255) NOT NULL, ADD naam VARCHAR(255) NOT NULL, DROP address, DROP zipcode, DROP city, DROP name');
    }
}
