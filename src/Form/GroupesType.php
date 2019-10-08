<?php

namespace App\Form;

use App\Entity\Groupes;
use App\Entity\Participant;
use App\Entity\Site;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupesType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder
            ->add('nom', TextType::class)
            ->add('participants', EntityType::class, array(
                'class' => Participant::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'query_builder' => function(EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.nom', 'ASC')
                        ->where('g.pseudo != ?1')
                        ->setParameter(1, $user->getPseudo());

                }))
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupes::class,
            'user' => null
        ]);
    }


}
