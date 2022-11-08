<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108154650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0E422675C');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0E422675C FOREIGN KEY (structure_parent_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0E422675C');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0E422675C FOREIGN KEY (structure_parent_id) REFERENCES user (id)');
    }
}
