<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003222457 extends AbstractMigration
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
        $this->addSql('ALTER TABLE global_option_user ADD CONSTRAINT FK_1F7E29287BC576F6 FOREIGN KEY (global_option_id) REFERENCES global_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE global_option_user ADD CONSTRAINT FK_1F7E2928A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD parent_id INT DEFAULT NULL, ADD global_option_id INT DEFAULT NULL, ADD activated TINYINT(1) DEFAULT NULL, CHANGE name name VARCHAR(100) DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649727ACA70 FOREIGN KEY (parent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497BC576F6 FOREIGN KEY (global_option_id) REFERENCES global_option (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649727ACA70 ON user (parent_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497BC576F6 ON user (global_option_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497BC576F6');
        $this->addSql('ALTER TABLE global_option_user DROP FOREIGN KEY FK_1F7E29287BC576F6');
        $this->addSql('ALTER TABLE global_option_user DROP FOREIGN KEY FK_1F7E2928A76ED395');
        $this->addSql('DROP TABLE global_option');
        $this->addSql('DROP TABLE global_option_user');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649727ACA70');
        $this->addSql('DROP INDEX IDX_8D93D649727ACA70 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6497BC576F6 ON user');
        $this->addSql('ALTER TABLE user DROP parent_id, DROP global_option_id, DROP activated, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
    }
}
