<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SkillsFixtures extends Fixture
{
    public const SKILLS = [
        [
            'name' => 'Achat',
            'category' => 'Commerce et logistique',
        ],[
            'name' => 'Import-Export',
            'category' => 'Commerce et logistique',
        ],[
            'name' => 'Stratégie commerciale',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Vente',
            'category' => 'Commerce et logistique',
        ],[
            'name' => 'Community Manager',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Conception Rédaction',
            'category' => 'Autres',
        ],[
            'name' => 'Evénementiel',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Graphisme',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Relations publiques',
            'category' => 'Autres',
        ],[
            'name' => 'Comptabilité',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Architecte d \'intérieur',
            'category' => 'Autres',
        ],[
            'name' => 'Designer produit',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Contrôle des finances',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Crowdfunding',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Contrôle de gestion ',
            'category' => 'Administratif',
        ],[
            'name' => 'R&D',
            'category' => 'Autres',
        ],[
            'name' => 'Développement web',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Gestion de projet informatique',
            'category' => 'Administratif',
        ],[
            'name' => 'Conseil jurudique',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Fiscalité',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Service d\'avocat',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Droit des sociétés',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Contrat de travail',
            'category' => 'Droit et finance',
        ],[
            'name' => 'Analyse de data',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Pricing',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Marketing digital',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Marketing produit',
            'category' => 'Marketing et numérique',
        ],[
            'name' => 'Paie',
            'category' => 'Administratif',
        ],[
            'name' => 'Formation',
            'category' => 'Administratif',
        ],[
            'name' => 'Recrutement',
            'category' => 'Administratif',
        ],[
            'name' => 'Stratégie RH',
            'category' => 'Administratif',
        ],[
            'name' => 'Secrétariat',
            'category' => 'Administratif',
        ],[
            'name' => 'Photographie',
            'category' => 'Autres',
        ],[
            'name' => 'Affrêteur',
            'category' => 'Commerce et logistique',
        ],[
            'name' => 'Conditionnement',
            'category' => 'Commerce et logistique',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SKILLS as $key => $skills) {
            $skill = new Skills();
            $skill->setName($skills['name']);
            $skill->setCategory($skills['category']);
            $manager->persist($skill);
            $this->addReference('skill_' . $key, $skill);
        }
        $manager->flush();
    }
}
