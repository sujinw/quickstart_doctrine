<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170704024332 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE developer_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, developer_product_id INT DEFAULT NULL, developer_type_id INT DEFAULT NULL, game_id INT DEFAULT NULL, industries_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, foundation VARCHAR(255) NOT NULL, founders VARCHAR(255) NOT NULL, head_office VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, INDEX fk_developers_developers_types1_idx (developer_type_id), INDEX fk_developers_games1_idx (game_id), INDEX fk_developers_industries1_idx (industries_id), INDEX fk_developers_developers_products1_idx (developer_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, style_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_games_styles1_idx (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX fk_styles_users_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE industrie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_user (user_id INT NOT NULL, user_friend INT NOT NULL, INDEX IDX_3042E916A76ED395 (user_id), INDEX IDX_3042E91630BCB75C (user_friend), PRIMARY KEY(user_id, user_friend)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9A8F3A3E9C FOREIGN KEY (developer_product_id) REFERENCES developer_product (id)');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9AABD26A38 FOREIGN KEY (developer_type_id) REFERENCES developer_type (id)');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9AE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9AB37C96C3 FOREIGN KEY (industries_id) REFERENCES industrie (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_user ADD CONSTRAINT FK_3042E916A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_user ADD CONSTRAINT FK_3042E91630BCB75C FOREIGN KEY (user_friend) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9AABD26A38');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9AE48FD905');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CBACD6074');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9AB37C96C3');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9A8F3A3E9C');
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86AA76ED395');
        $this->addSql('ALTER TABLE user_has_user DROP FOREIGN KEY FK_3042E916A76ED395');
        $this->addSql('ALTER TABLE user_has_user DROP FOREIGN KEY FK_3042E91630BCB75C');
        $this->addSql('DROP TABLE developer_type');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE industrie');
        $this->addSql('DROP TABLE developer_product');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_user');
    }
}
