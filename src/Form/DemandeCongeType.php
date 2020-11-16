<?php

namespace App\Form;

use App\Entity\DemandeConge;
use App\Entity\Personnel;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCongeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut')
            ->add('nombreJour')
            ->add('dateReprise')
            ->add('dateFin')
            ->add('approbationChef')
            ->add('approbationDir')
            ->add('approbationAg')
            ->add('etat')
            ->add('personnel', EntityType::class, array('class'=>Personnel::class, 'choice_label'=>'nomComplet'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeConge::class,
        ]);
    }
}
