<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118160050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE swap (id INT AUTO_INCREMENT NOT NULL, asker_id INT NOT NULL, helper_id INT NOT NULL, skill_id INT NOT NULL, date DATETIME NOT NULL, message LONGTEXT NOT NULL, is_accepted TINYINT(1) DEFAULT \'0\' NOT NULL, is_done TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_25938561CF34C66B (asker_id), INDEX IDX_25938561D7693E95 (helper_id), INDEX IDX_259385615585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE swap ADD CONSTRAINT FK_25938561CF34C66B FOREIGN KEY (asker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE swap ADD CONSTRAINT FK_25938561D7693E95 FOREIGN KEY (helper_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE swap ADD CONSTRAINT FK_259385615585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE swap');
    }
}
