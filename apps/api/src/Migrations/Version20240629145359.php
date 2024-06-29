<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240629145359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user_entity table with basic fields';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_entity (id BINARY(16) NOT NULL, email VARCHAR(255) NOT NULL, hashed_password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_6B7A5F55E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user_entity');
    }
}
