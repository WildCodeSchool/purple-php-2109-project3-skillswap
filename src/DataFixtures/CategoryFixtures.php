<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{

    public const CATEGORIES = [
        'Commercial',
        'Communication',
        'Comptabilité',
        'Design',
        'Droit',
        'Finance',
        'Gestion',
        'Ingénierie',
        'IT',
        'Marketing',
        'Photographie',
        'Ressources humaines',
        'Secrétariat',
        'Transport',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }

        $manager->flush();
    }
}
