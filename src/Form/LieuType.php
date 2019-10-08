<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                "label_format" => "Nom"
            ])
            ->add('rue', null, [
                "label_format" => "Rue"
            ])
            ->add('latitude', NumberType::class, [
                "label_format" => "Latitude"
            ])
            ->add('longitude', NumberType::class, [
                "label_format" => "Longitude"
            ])
            ->add('ville', EntityType::class, array(
                "label_format" => "Ville",
                'class' => Ville::class,
            //Attribut utilisé pour l'affichage
                'choice_label' => 'nom',

            //Fait une requête particulière
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nom', 'ASC');
                }

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
