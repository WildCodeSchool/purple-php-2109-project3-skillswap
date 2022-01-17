<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices'  => [
                    Skill::CATEGORIES[0] => Skill::CATEGORIES[0],
                    Skill::CATEGORIES[1] => Skill::CATEGORIES[1],
                    Skill::CATEGORIES[2] => Skill::CATEGORIES[2],
                    Skill::CATEGORIES[3] => Skill::CATEGORIES[3],
                    Skill::CATEGORIES[4] => Skill::CATEGORIES[4],
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
