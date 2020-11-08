<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201108192338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE family_tree_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stored_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE family_tree (id INT NOT NULL, uuid UUID NOT NULL, members INT DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, first_location VARCHAR(255) DEFAULT NULL, current_location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C349FCF8D17F50A6 ON family_tree (uuid)');
        $this->addSql('CREATE TABLE stored_event (id INT NOT NULL, family_tree_id UUID NOT NULL,  event_type VARCHAR(255) NOT NULL, event_data JSON NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE family_tree_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stored_event_id_seq CASCADE');
        $this->addSql('DROP TABLE family_tree');
        $this->addSql('DROP TABLE stored_event');
    }
}
