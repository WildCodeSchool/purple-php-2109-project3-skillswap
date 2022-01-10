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
            'category' => Skills::CATEGORIES[2],
        ],[
            'name' => 'Import-Export',
            'category' => Skills::CATEGORIES[2],
        ],[
            'name' => 'Stratégie commerciale',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Vente',
            'category' => Skills::CATEGORIES[2],
        ],[
            'name' => 'Community Manager',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Conception Rédaction',
            'category' => Skills::CATEGORIES[4],
        ],[
            'name' => 'Evénementiel',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Graphisme',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Relations publiques',
            'category' => Skills::CATEGORIES[4],
        ],[
            'name' => 'Comptabilité',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Architecte d \'intérieur',
            'category' => Skills::CATEGORIES[4],
        ],[
            'name' => 'Designer produit',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Contrôle des finances',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Crowdfunding',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Contrôle de gestion ',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'R&D',
            'category' => Skills::CATEGORIES[4],
        ],[
            'name' => 'Développement web',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Gestion de projet informatique',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Conseil jurudique',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Fiscalité',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Service d\'avocat',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Droit des sociétés',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Contrat de travail',
            'category' => Skills::CATEGORIES[0],
        ],[
            'name' => 'Analyse de data',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Pricing',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Marketing digital',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Marketing produit',
            'category' => Skills::CATEGORIES[1],
        ],[
            'name' => 'Paie',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Formation',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Recrutement',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Stratégie RH',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Secrétariat',
            'category' => Skills::CATEGORIES[3],
        ],[
            'name' => 'Photographie',
            'category' => Skills::CATEGORIES[4],
        ],[
            'name' => 'Affrêteur',
            'category' => Skills::CATEGORIES[2],
        ],[
            'name' => 'Conditionnement',
            'category' => Skills::CATEGORIES[2],
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
