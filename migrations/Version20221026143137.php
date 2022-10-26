<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026143137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, struture_parent_id INT DEFAULT NULL, global_option_parent_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, activated TINYINT(1) DEFAULT NULL, INDEX IDX_5A8600B05FD24845 (struture_parent_id), UNIQUE INDEX UNIQ_5A8600B0EA603917 (global_option_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B05FD24845 FOREIGN KEY (struture_parent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0EA603917 FOREIGN KEY (global_option_parent_id) REFERENCES global_option (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B05FD24845');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0EA603917');
        $this->addSql('DROP TABLE `option`');
    }
}
