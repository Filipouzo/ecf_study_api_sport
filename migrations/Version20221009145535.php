<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221009145535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE global_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, activated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_option_user (global_option_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1F7E29287BC576F6 (global_option_id), INDEX IDX_1F7E2928A76ED395 (user_id), PRIMARY KEY(global_option_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, global_option_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, activated TINYINT(1) DEFAULT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649727ACA70 (parent_id), INDEX IDX_8D93D6497BC576F6 (global_option_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE global_option_user ADD CONSTRAINT FK_1F7E29287BC576F6 FOREIGN KEY (global_option_id) REFERENCES global_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE global_option_user ADD CONSTRAINT FK_1F7E2928A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649727ACA70 FOREIGN KEY (parent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497BC576F6 FOREIGN KEY (global_option_id) REFERENCES global_option (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_option_user DROP FOREIGN KEY FK_1F7E29287BC576F6');
        $this->addSql('ALTER TABLE global_option_user DROP FOREIGN KEY FK_1F7E2928A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649727ACA70');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497BC576F6');
        $this->addSql('DROP TABLE global_option');
        $this->addSql('DROP TABLE global_option_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
