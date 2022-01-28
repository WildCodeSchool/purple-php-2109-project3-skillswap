<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

/**
* list of skills
*/
class SkillFixtures extends Fixture
{
    public const SKILLS = [
        [
            'name' => 'Achat vente',
            'category' => Skill::CATEGORIES['Three'],
        ],[
            'name' => 'Import-export',
            'category' => Skill::CATEGORIES['Three'],
        ],[
            'name' => 'Stratégie commerciale',
            'category' => Skill::CATEGORIES['Three'],
        ],[
            'name' => 'Conception-rédaction',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Evénementiel',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Graphisme',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Relations publiques',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Comptabilité',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Architecte d \'intérieur',
            'category' => Skill::CATEGORIES['Five'],
        ],[
            'name' => 'Design produit',
            'category' => Skill::CATEGORIES['Five'],
        ],[
            'name' => 'Contrôle financier',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Crowdfunding',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Contrôle de gestion ',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'R&D',
            'category' => Skill::CATEGORIES['Five'],
        ],[
            'name' => 'Développement web',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Gestion de projet informatique',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Conseil jurudique',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Fiscalité',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Avocat',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Droit des sociétés',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Droit du travail',
            'category' => Skill::CATEGORIES['One'],
        ],[
            'name' => 'Analyse de data',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Pricing',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Marketing digital',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Marketing produit',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Paie',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Formation',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Recrutement',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Stratégie RH',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Secrétariat',
            'category' => Skill::CATEGORIES['Four'],
        ],[
            'name' => 'Photographie',
            'category' => Skill::CATEGORIES['Five'],
        ],[
            'name' => 'Affrêtement',
            'category' => Skill::CATEGORIES['Three'],
        ],[
            'name' => 'Conditionnement',
            'category' => Skill::CATEGORIES['Three'],
        ],[
            'name' => 'Relation presse',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Réseaux sociaux',
            'category' => Skill::CATEGORIES['Two'],
        ],[
            'name' => 'Business coaching',
            'category' => Skill::CATEGORIES['Five'],
        ],[
            'name' => 'Psychologie',
            'category' => Skill::CATEGORIES['Five'],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SKILLS as $key => $skills) {
            $skill = new Skill();
            $skill->setName($skills['name']);
            $skill->setCategory($skills['category']);
            $manager->persist($skill);
            $this->addReference('skill_' . $key, $skill);
        }
        $manager->flush();
    }
}
