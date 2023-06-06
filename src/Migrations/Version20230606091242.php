<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606091242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_880E0D76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76A76ED395 ON admin (user_id)');
        $this->addSql('CREATE TABLE deal (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_id INTEGER NOT NULL, team_from_id INTEGER NOT NULL, team_to_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, CONSTRAINT FK_E3FEC11699E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E3FEC11687B7A83C FOREIGN KEY (team_from_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E3FEC116F7330325 FOREIGN KEY (team_to_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E3FEC11699E6F5DF ON deal (player_id)');
        $this->addSql('CREATE INDEX IDX_E3FEC11687B7A83C ON deal (team_from_id)');
        $this->addSql('CREATE INDEX IDX_E3FEC116F7330325 ON deal (team_to_id)');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_id INTEGER DEFAULT NULL, user_id INTEGER NOT NULL, surname VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65A76ED395 ON player (user_id)');
        $this->addSql('CREATE TABLE team (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_manager_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, money DOUBLE PRECISION NOT NULL, CONSTRAINT FK_C4E0A61F46E746A6 FOREIGN KEY (team_manager_id) REFERENCES team_manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61F46E746A6 ON team (team_manager_id)');
        $this->addSql('CREATE TABLE team_manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_55D548EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55D548EA76ED395 ON team_manager (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active INTEGER NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_manager');
        $this->addSql('DROP TABLE user');
    }
}
