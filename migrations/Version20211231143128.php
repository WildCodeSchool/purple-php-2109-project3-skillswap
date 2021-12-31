<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211231143128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE swapper_skills (swapper_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_72411E0298D90936 (swapper_id), INDEX IDX_72411E027FF61858 (skills_id), PRIMARY KEY(swapper_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE swapper_skills ADD CONSTRAINT FK_72411E0298D90936 FOREIGN KEY (swapper_id) REFERENCES swapper (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE swapper_skills ADD CONSTRAINT FK_72411E027FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE swapper_skills DROP FOREIGN KEY FK_72411E027FF61858');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE swapper_skills');
    }
}
