<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125153242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("TRUNCATE TABLE skill");
        $this->addSql("INSERT INTO `skill` (`id`, `name`, `category`) VALUES
            (1, 'Achat vente', 'Commerce et logistique'),
            (2, 'Import-export', 'Commerce et logistique'),
            (3, 'Stratégie commerciale', 'Commerce et logistique'),
            (4, 'Conception-rédaction', 'Marketing et numérique'),
            (5, 'Evénementiel', 'Marketing et numérique'),
            (6, 'Graphisme', 'Marketing et numérique'),
            (7, 'Relations publiques', 'Marketing et numérique'),
            (8, 'Comptabilité', 'Droit et finance'),
            (9, 'Architecte d \'intérieur', 'Autres'),
            (10, 'Design produit', 'Autres'),
            (11, 'Contrôle financier', 'Droit et finance'),
            (12, 'Crowdfunding', 'Droit et finance'),
            (13, 'Contrôle de gestion ', 'Administratif'),
            (14, 'R&D', 'Autres'),
            (15, 'Développement web', 'Marketing et numérique'),
            (16, 'Gestion de projet informatique', 'Administratif'),
            (17, 'Conseil jurudique', 'Droit et finance'),
            (18, 'Fiscalité', 'Droit et finance'),
            (19, 'Avocat', 'Droit et finance'),
            (20, 'Droit des sociétés', 'Droit et finance'),
            (21, 'Droit du travail', 'Droit et finance'),
            (22, 'Analyse de data', 'Marketing et numérique'),
            (23, 'Pricing', 'Marketing et numérique'),
            (24, 'Marketing digital', 'Marketing et numérique'),
            (25, 'Marketing produit', 'Marketing et numérique'),
            (26, 'Paie', 'Administratif'),
            (27, 'Formation', 'Administratif'),
            (28, 'Recrutement', 'Administratif'),
            (29, 'Stratégie RH', 'Administratif'),
            (30, 'Secrétariat', 'Administratif'),
            (31, 'Photographie', 'Autres'),
            (32, 'Affrêtement', 'Commerce et logistique'),
            (33, 'Conditionnement', 'Commerce et logistique'),
            (34, 'Relation presse', 'Marketing et numérique'),
            (35, 'Réseaux sociaux', 'Marketing et numérique'),
            (36, 'Business coaching', 'Autres'),
            (37, 'Psychologie', 'Autres');"
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE skill');
    }
}
