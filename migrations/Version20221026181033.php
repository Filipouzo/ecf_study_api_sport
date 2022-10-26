<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026181033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_option DROP FOREIGN KEY FK_B51715E051D7FC6');
        $this->addSql('ALTER TABLE global_option ADD CONSTRAINT FK_B51715E051D7FC6 FOREIGN KEY (patner_parent_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_option DROP FOREIGN KEY FK_B51715E051D7FC6');
        $this->addSql('ALTER TABLE global_option ADD CONSTRAINT FK_B51715E051D7FC6 FOREIGN KEY (patner_parent_id) REFERENCES user (id)');
    }
}
