<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117193518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, data LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, confirm VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD image_id INT DEFAULT NULL, CHANGE price price NUMERIC(7, 2) NOT NULL, CHANGE brand brand VARCHAR(255) NOT NULL, CHANGE model model VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69D3DA5256D ON car (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D3DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_773DE69D3DA5256D ON car');
        $this->addSql('ALTER TABLE car DROP image_id, CHANGE price price NUMERIC(9, 2) NOT NULL, CHANGE brand brand VARCHAR(100) NOT NULL, CHANGE model model VARCHAR(100) NOT NULL');
    }
}
