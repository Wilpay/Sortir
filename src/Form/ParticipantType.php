<?php

namespace App\Form;

use App\Entity\Participant;
use App\Entity\Profil;
use App\Entity\Site;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('pseudo', TextType::class)
            ->add('telephone', TextType::class)
            ->add('mail', EmailType::class)
            ->add('site', EntityType::class, array(
                'class' => Site::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.nom', 'ASC');
                },
                'choice_label' => 'nom'
            ))
            ->add('passwordPlain', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Vos mots de passe ne correspondent pas!'
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider'))

        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}