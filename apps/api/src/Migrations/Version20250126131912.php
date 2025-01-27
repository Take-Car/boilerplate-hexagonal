<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250126131912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create basic security user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (uuid BINARY(16) NOT NULL, username VARCHAR(64) NOT NULL, password VARCHAR(96) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
