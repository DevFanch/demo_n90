<?php

namespace App\Form;

use App\Entity\Season;
use App\Entity\Serie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', NumberType::class, [
                'label' => 'Number',
                'scale' => 2
            ])
            ->add('firstAirDate', DateType::class, [
                'label' => 'First Air Date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('overview', TextType::class, [
                'label' => 'Overview',
                'required' => false,
            ])
            ->add('poster', TextType::class, [
                'label' => 'Poster',
                'required' => false,
            ])
            ->add('tmdbId', NumberType::class, [
                'label' => 'Tmdb Id',
            ])
            ->add('serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => ['class' => 'btn btn-primary']
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
