<?php

namespace App\Form;

use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                "label_format" => "Nom"
            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                "label_format" => "Heure de début",
                'widget' => 'single_text'
            ])

            ->add('dateLimiteInscription', DateType::class, [
                "label_format" => "Date limite d'inscription",
                'widget' => 'single_text'
            ])
            ->add('nbInscriptionsMax', IntegerType::class, [
                "label_format" => "Nombre maximum d'inscriptions"
            ])
            ->add('duree', IntegerType::class, [
                "label_format" => "durée"
            ])
            ->add('infosSortie', TextareaType::class, [
                "label_format" => "Infos sur la sortie"
            ])
            //->add('etat', null, ["label_format" => "Etat de la sortie"])
            //->add('lieu', EntityType::class, array(
            //    "label_format" => "Lieu",
            //    'class' => Lieu::class,
                //Attribut utilisé pour l'affichage
            //    'choice_label' => 'nom'

            //))
            //->add('ville', EntityType::class, array(
            //    "label_format" => "ville",
            //    'class' => Ville::class,
                //Attribut utilisé pour l'affichage
            //    'choice_label' => 'nom',

                //Fait une requête particulière
            //    'query_builder' => function (EntityRepository $er) {
            //        return $er->createQueryBuilder('c')
            //            ->orderBy('c.nom', 'ASC');
            //    }

            //))
             //->add('organisateur', EntityType::class, ["label_format" => "Etat",'class' => Ville::class,'choice_label' => 'libelle'])

            ->add('etat', EntityType::class, ["label_format" => "Etat",'class' => Etat::class,'choice_label' => 'libelle'])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}