<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Fonction;
use App\Entity\Genre;
use App\Entity\Grade;
use App\Entity\NiveauEtude;
use App\Entity\Personnel;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Countries::getNames();
        $builder
            ->add('nomComplet')
            ->add('dateNaissance', BirthdayType::class, ['widget' => 'single_text',])
            ->add('lieuNaissance')
            ->add('dateEngagement', BirthdayType::class, ['widget' => 'single_text',])
            ->add('salaire', ChoiceType::class, ['choices'=>['Oui'=>'Oui', 'Non'=>'Non']])
            ->add('acteNomination')
//            ->add('etat')
            ->add('fonction', EntityType::class, ['class'=>Fonction::class, 'choice_label'=>'nom'])
            ->add('grade', EntityType::class, ['class'=>Grade::class, 'choice_label'=>'nom'])
            ->add('niveauEtude', EntityType::class, ['class'=>NiveauEtude::class, 'choice_label'=>'nom'])
            ->add('departement',EntityType::class, ['class'=>Departement::class, 'choice_label'=>'nomDepartement'])
            ->add('genre', EntityType::class, ['class'=>Genre::class, 'choice_label'=>'description'])
            ->add('status',EntityType::class, ['class'=>Status::class, 'choice_label'=>'description'])
            ->add('nationalite', ChoiceType::class, array('choices'=>array_flip($countries)))
            ->add('nombreEnfant')
            ->add('telephone')
            ->add('email')
            ->add('avenue')
            ->add('numero')
            ->add('commune')
            ->add('matricule')
            ->add('positionAdmin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
