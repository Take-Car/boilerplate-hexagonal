<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231014224003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create messenger failed events table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE messenger_failed_events (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_381D5FFAFB7336F0 ON messenger_failed_events (queue_name)');
        $this->addSql('CREATE INDEX IDX_381D5FFAE3BD61CE ON messenger_failed_events (available_at)');
        $this->addSql('CREATE INDEX IDX_381D5FFA16BA31DB ON messenger_failed_events (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_failed_events.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_failed_events.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_failed_events.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_failed_events() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_failed_events\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_failed_events;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_failed_events FOR EACH ROW EXECUTE PROCEDURE notify_messenger_failed_events();');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE messenger_failed_events');
    }
}
