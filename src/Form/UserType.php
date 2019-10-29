<?php

namespace App\Form;

use App\Entity\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['userParameters'])
        {
            $builder
//                ->add('lastname')
//                ->add('firstname')
                ->remove('username')
                ->remove('usernameCanonical')
                ->remove('email')
                ->remove('password')
                ->remove('plainPassword')
                ->add('save', SubmitType::class, [
                    'attr' => ['class' => 'save'],
                ]);
            ;
        }
        else
        {
            $builder
//                ->add('lastname')
//                ->add('firstname')
                ->remove('username')
                ->remove('usernameCanonical')
            ;
        }
    }

    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => User::class,
            'userParameters'    => null,
        ]);
    }
}
