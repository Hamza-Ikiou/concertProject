<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Band;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('date_of_birth', DateType::class, [
                'format' => 'dd/MM/yyyy'
            ])
            ->add('band', EntityType::class, [
                'class' => Band::class,
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
