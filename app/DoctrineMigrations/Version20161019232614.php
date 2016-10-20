<?php

namespace Symfony28\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161019232614 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX username_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, last_name, password, role, is_active, created_at, updated_at, first_namexx FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(50) NOT NULL COLLATE BINARY, last_name VARCHAR(100) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, role VARCHAR(50) NOT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, first_name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, last_name, password, role, is_active, created_at, updated_at, first_name) SELECT id, username, last_name, password, role, is_active, created_at, updated_at, first_namexx FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE INDEX username_idx ON user (username)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX username_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, first_name, last_name, password, role, is_active, created_at, updated_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(50) NOT NULL, last_name VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(50) NOT NULL, is_active BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, first_namexx VARCHAR(100) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, first_namexx, last_name, password, role, is_active, created_at, updated_at) SELECT id, username, first_name, last_name, password, role, is_active, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE INDEX username_idx ON user (username)');
    }
}
