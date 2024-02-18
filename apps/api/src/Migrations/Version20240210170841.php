<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * TODO: remove this file after forking the project
 */
final class Version20240210170841 extends AbstractMigration
{
    #[\Override]
    public function getDescription(): string
    {
        return 'Create movies table';
    }

    #[\Override]
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE movies (title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, release_date DATETIME NOT NULL, uuid BINARY(16) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8');
    }

    #[\Override]
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE movies');
    }
}
