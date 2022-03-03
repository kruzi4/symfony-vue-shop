<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303154450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE "user" SET is_deleted=\'0\' WHERE is_deleted IS NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE "user" SET is_deleted=NULL WHERE is_deleted IS NOT NULL');
    }
}
