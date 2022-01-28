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
                    Skill::CATEGORIES['One'] => Skill::CATEGORIES['One'],
                    Skill::CATEGORIES['Two'] => Skill::CATEGORIES['Two'],
                    Skill::CATEGORIES['Three'] => Skill::CATEGORIES['Three'],
                    Skill::CATEGORIES['Four'] => Skill::CATEGORIES['Four'],
                    Skill::CATEGORIES['Five'] => Skill::CATEGORIES['Five'],
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
