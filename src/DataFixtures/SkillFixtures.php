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
            'name' => 'Achat',
            'category' => Skill::CATEGORIES[2],
        ],[
            'name' => 'Import-Export',
            'category' => Skill::CATEGORIES[2],
        ],[
            'name' => 'Stratégie commerciale',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Vente',
            'category' => Skill::CATEGORIES[2],
        ],[
            'name' => 'Community Manager',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Conception Rédaction',
            'category' => Skill::CATEGORIES[4],
        ],[
            'name' => 'Evénementiel',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Graphisme',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Relations publiques',
            'category' => Skill::CATEGORIES[4],
        ],[
            'name' => 'Comptabilité',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Architecte d \'intérieur',
            'category' => Skill::CATEGORIES[4],
        ],[
            'name' => 'Designer produit',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Contrôle des finances',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Crowdfunding',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Contrôle de gestion ',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'R&D',
            'category' => Skill::CATEGORIES[4],
        ],[
            'name' => 'Développement web',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Gestion de projet informatique',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Conseil jurudique',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Fiscalité',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Service d\'avocat',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Droit des sociétés',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Contrat de travail',
            'category' => Skill::CATEGORIES[0],
        ],[
            'name' => 'Analyse de data',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Pricing',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Marketing digital',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Marketing produit',
            'category' => Skill::CATEGORIES[1],
        ],[
            'name' => 'Paie',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Formation',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Recrutement',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Stratégie RH',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Secrétariat',
            'category' => Skill::CATEGORIES[3],
        ],[
            'name' => 'Photographie',
            'category' => Skill::CATEGORIES[4],
        ],[
            'name' => 'Affrêteur',
            'category' => Skill::CATEGORIES[2],
        ],[
            'name' => 'Conditionnement',
            'category' => Skill::CATEGORIES[2],
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
