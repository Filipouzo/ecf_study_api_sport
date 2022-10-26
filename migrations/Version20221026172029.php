<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026172029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B05FD24845');
        $this->addSql('DROP INDEX IDX_5A8600B05FD24845 ON `option`');
        $this->addSql('ALTER TABLE `option` CHANGE struture_parent_id structure_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0E422675C FOREIGN KEY (structure_parent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B0E422675C ON `option` (structure_parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0E422675C');
        $this->addSql('DROP INDEX IDX_5A8600B0E422675C ON `option`');
        $this->addSql('ALTER TABLE `option` CHANGE structure_parent_id struture_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B05FD24845 FOREIGN KEY (struture_parent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B05FD24845 ON `option` (struture_parent_id)');
    }
}
