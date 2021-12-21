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
            'category' => 'category_0',
        ],[
            'name' => 'Import-Export',
            'category' => 'category_0',
        ],[
            'name' => 'Stratégie commerciale',
            'category' => 'category_0',
        ],[
            'name' => 'Vente',
            'category' => 'category_0',
        ],[
            'name' => 'Community Manager',
            'category' => 'category_1',
        ],[
            'name' => 'Conception Rédaction',
            'category' => 'category_1',
        ],[
            'name' => 'Evénementiel',
            'category' => 'category_1',
        ],[
            'name' => 'Graphisme',
            'category' => 'category_1',
        ],[
            'name' => 'Relation presse',
            'category' => 'category_1',
        ],[
            'name' => 'Relations publiques',
            'category' => 'category_1',
        ],[
            'name' => 'Comptabilité',
            'category' => 'category_2',
        ],[
            'name' => 'Expert comptabilité',
            'category' => 'category_2',
        ],[
            'name' => 'Architecte d \'intérieur',
            'category' => 'category_3',
        ],[
            'name' => 'Designer produit',
            'category' => 'category_3',
        ],[
            'name' => 'Contrôle des finances',
            'category' => 'category_5',
        ],[
            'name' => 'Crowdfunding',
            'category' => 'category_5',
        ],[
            'name' => 'Contrôle de gestion ',
            'category' => 'category_6',
        ],[
            'name' => 'Création de sites internet',
            'category' => 'category_8',
        ],[
            'name' => 'Développement / Coding',
            'category' => 'category_8',
        ],[
            'name' => 'Gestion de projet informatique',
            'category' => 'category_8',
        ],[
            'name' => 'Développement produit',
            'category' => 'category_7',
        ],[
            'name' => 'Conseil jurudique',
            'category' => 'category_4',
        ],[
            'name' => 'Fiscalité',
            'category' => 'category_4',
        ],[
            'name' => 'Service d\'avocat',
            'category' => 'category_4',
        ],[
            'name' => 'Droit des sociétés',
            'category' => 'category_4',
        ],[
            'name' => 'Analyse de data',
            'category' => 'category_9',
        ],[
            'name' => 'Pricing',
            'category' => 'category_9',
        ],[
            'name' => 'Marketing digital',
            'category' => 'category_9',
        ],[
            'name' => 'Marketing produit',
            'category' => 'category_9',
        ],[
            'name' => 'Paie / Contrat de travail',
            'category' => 'category_11',
        ],[
            'name' => 'Formation',
            'category' => 'category_11',
        ],[
            'name' => 'Recrutement',
            'category' => 'category_11',
        ],[
            'name' => 'Stratégie RH',
            'category' => 'category_11',
        ],[
            'name' => 'Secrétariat',
            'category' => 'category_12',
        ],[
            'name' => 'Photographie',
            'category' => 'category_10',
        ],[
            'name' => 'Affrêteur',
            'category' => 'category_13',
        ],[
            'name' => 'Conditionnement',
            'category' => 'category_13',
        ],[
            'name' => 'Logistique',
            'category' => 'category_13',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SKILLS as $key => $skills) {
            $skill = new Skills();
            $skill->setName($skills['name']);
            $skill->setCategory($this->getReference($skills['category']));
            $manager->persist($skill);
            $this->addReference('skill_' . $key, $skill);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
