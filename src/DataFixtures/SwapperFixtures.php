<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Swapper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Skills;

class SwapperFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $swapper = new Swapper();
        $swapper->setPrenom('Henry');
        $swapper->setNom('DECHASNEL');
        $swapper->setPresentation(", et, plus récemment, par son inclusion dans des applications de mise en page 
        de texte,         comme Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler 
        avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur 
        la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. 
        Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable
         avec celle du français standard.");
        $swapper->setPhoto('https://st.depositphotos.com/thumbs/1008939/image/1880/18807295/api_thumb_450.jpg');
        $swapper->addSkill($this->getReference('skill_0'));
        $swapper->addSkill($this->getReference('skill_8'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_17'));
        $swapper->addSkill($this->getReference('skill_23'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Bernard');
        $swapper->setNom('MINET');
        $swapper->setPresentation("plement du texte aléatoire. Il trouve ses racines dans une oeuvre de la 
        littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur 
        du Hampden-Sydney College, en Virginie , s'est intéress");
        $swapper->setPhoto('https://st.depositphotos.com/2590737/2940/i/950/depositphotos_29407191-stock-photo-
        successful-elegant-smiling-mature-casual.jpg');
        $swapper->addSkill($this->getReference('skill_1'));
        $swapper->addSkill($this->getReference('skill_2'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_14'));
        $swapper->addSkill($this->getReference('skill_23'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Bernadette');
        $swapper->setNom('SOUBIROU');
        $swapper->setPresentation("um.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire 
        de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem 
        Ipsum irréprochable. Le Lorem Ipsum ainsi ");
        $swapper->setPhoto('https://images.assetsdelivery.com/compings_v2/bowie15/bowie151506/bowie15150600238.jpg');
        $swapper->addSkill($this->getReference('skill_0'));
        $swapper->addSkill($this->getReference('skill_11'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_25'));
        $swapper->addSkill($this->getReference('skill_30'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Edith');
        $swapper->setNom('JOYEUX');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages 
        du Lorem Ipsum,et, plus récemment, par son inclusion dans des applications de mise en page de texte, 
        comme Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler avec du texte lisible 
        et contenant du sens est source de distractions,et empêche de se concentrer sur la mise en page elle-même. 
        L'avantage du Lorem Ipsum sur un texte générique comme Du texte. Du texte. Du texte.' est qu'il possède ");
        $swapper->setPhoto('https://www.wizishop.fr/media/60cc521bb35453574a9bd047/v1/img_2656_copie.jpg');
        $swapper->addSkill($this->getReference('skill_1'));
        $swapper->addSkill($this->getReference('skill_2'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_13'));
        $swapper->addSkill($this->getReference('skill_30'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Jean');
        $swapper->setNom('SANTER');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages du 
        Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme 
        Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et 
        contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. 
        L'avantage du Lorem Ipsum sur un texte générique comme Du texte.");
        $swapper->setPhoto('https://fotomelia.com/wp-content/uploads/edd/2015/09/images-gratuites-libres-de-droits18
        -1560x1170.jpg');
        $swapper->addSkill($this->getReference('skill_0'));
        $swapper->addSkill($this->getReference('skill_8'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_32'));
        $swapper->addSkill($this->getReference('skill_34'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Marilyne');
        $swapper->setNom('MONEROT');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages 
        du Lorem Ipsum , et, plus récemment, par son inclusion dans des applications de mise en page de texte, 
        comme Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler avec du texte lisible 
        et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. 
        L'avantage du Lorem Ipsum sur un texte générique comme Du texte. Du texte. Du texte.' est qu'il possède une
        distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du");
        $swapper->setPhoto('https://fotomelia.com/wp-content/uploads/edd/2015/08/photo-libre-de-droit67-1560x1040.jpg');
        $swapper->addSkill($this->getReference('skill_5'));
        $swapper->addSkill($this->getReference('skill_10'));
        $swapper->addSkill($this->getReference('skill_15'));
        $swapper->addSkill($this->getReference('skill_20'));
        $swapper->addSkill($this->getReference('skill_25'));
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Patrice');
        $swapper->setNom('DUTOIT');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages 
        du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, 
        comme Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler avec du texte lisible 
        et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-
        même.L'avantage du Lorem Ipsum sur un texte générique comm");
        $swapper->setPhoto('https://media.istockphoto.com/photos/portrait-of-serious-mid-adult-man-picture-id805011368');
        $swapper->addSkill($this->getReference('skill_3'));
        $swapper->addSkill($this->getReference('skill_10'));
        $swapper->addSkill($this->getReference('skill_12'));
        $swapper->addSkill($this->getReference('skill_33'));
        $swapper->addSkill($this->getReference('skill_34'));
        $manager->persist($swapper);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[SkillsFixtures::class];
    }
}
