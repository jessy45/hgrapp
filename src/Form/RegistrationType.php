<?php

namespace App\Form;

use App\Entity\Personnel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, ['label'=>false])
            ->add('username', null, ['label'=>false])
            ->add('password', PasswordType::class, ['label'=>false])
            ->add('confirm_password',PasswordType::class, ['label'=>false])
            ->add('personnel',EntityType::class, ['class'=>Personnel::class, 'choice_label'=>'nomComplet'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
