<?php

namespace App\Form;

use App\Entity\CardModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use App\Entity\Rank;
use App\Entity\TypeOfCard;
use App\Entity\HeroModel;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('backgroundCard', FileType::class, ['label' => 'image du Dos de carte', 'required'=> false])
            ->add('picture', FileType::class, ['label' => 'image de la carte'])
            ->add('mana')
            ->add('pa')
            ->add('hp')
            ->add('quote')
            ->add('heroModel', EntityType::class, [
                'class'=> HeroModel::class,
                'choice_label'=> 'faction.name',
            ])
            ->add('typeOfCards', EntityType::class, [
                'class'=> TypeOfCard::class,
                'choice_label'=> 'name',
                'multiple'=> true,
                'expanded'=> true,
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CardModel::class,
        ]);
    }
}
