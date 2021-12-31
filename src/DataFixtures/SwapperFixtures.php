<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Swapper;

class SwapperFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $swapper = new Swapper();
        $swapper->setPrenom('Henry');
        $swapper->setNom('DECHASNEL');
        $swapper->setPresentation(", et, plus récemment, par son inclusion dans des applications de mise en page de texte, 
        comme Aldus PageMaker. Pourquoi l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et contenant
         du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem 
         Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres 
         plus ou moins normale, et en tout cas comparable avec celle du français standard.");
        $swapper->setPhoto('https://st.depositphotos.com/thumbs/1008939/image/1880/18807295/api_thumb_450.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Bernard');
        $swapper->setNom('MINET');
        $swapper->setPresentation("plement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine
         classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie
         , s'est intéress");
        $swapper->setPhoto('https://st.depositphotos.com/2590737/2940/i/950/depositphotos_29407191-stock-photo-successful-elegant-smiling-mature-casual.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Bernadette');
        $swapper->setNom('SOUBIROU');
        $swapper->setPresentation("um.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots 
        latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi ");
        $swapper->setPhoto('https://images.assetsdelivery.com/compings_v2/bowie15/bowie151506/bowie15150600238.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Edith');
        $swapper->setNom('JOYEUX');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum,
         et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. Pourquoi
         l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions,
          et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 
          'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas
           ");
        $swapper->setPhoto('https://www.wizishop.fr/media/60cc521bb35453574a9bd047/v1/img_2656_copie.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Jean');
        $swapper->setNom('SANTER');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, 
        et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. Pourquoi 
        l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, 
        et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 
        'Du texte.");
        $swapper->setPhoto('https://fotomelia.com/wp-content/uploads/edd/2015/09/images-gratuites-libres-de-droits18-1560x1170.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Marilyne');
        $swapper->setNom('MONEROT');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum
        , et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. Pourquoi
         l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, 
         et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 
         'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas
          comparable avec celle du");
        $swapper->setPhoto('https://fotomelia.com/wp-content/uploads/edd/2015/08/photo-libre-de-droit67-1560x1040.jpg');
        $manager->persist($swapper);

        $swapper = new Swapper();
        $swapper->setPrenom('Patrice');
        $swapper->setNom('DUTOIT');
        $swapper->setPresentation("es années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum,
        et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. Pourquoi
         l'utiliser? On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distrac
         tions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique co
         mm");
        $swapper->setPhoto('https://media.istockphoto.com/photos/portrait-of-serious-mid-adult-man-picture-id805011368');
        $manager->persist($swapper);

        $manager->flush();
    }
}
