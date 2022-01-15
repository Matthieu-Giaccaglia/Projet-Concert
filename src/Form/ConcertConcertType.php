<?php

namespace App\Form;

use App\Entity\ConcertConcert;
use App\Entity\ConcertGroup;
use App\Entity\ConcertHall;
use App\Entity\ConcertOrganizer;
use App\Entity\ConcertTicketOffice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbTicket', NumberType::class,[
                'attr' => ['min' => 1],
                'label' => 'Nombre de ticket'
            ])
            ->add('datetimeBegin', DateTimeType::class, [
                'label' => 'Date et Heure du début'
            ])
            ->add('datetimeEnd', DateTimeType::class, [
                'label' => 'Date et Heure de fin'
            ])
            ->add('concertGroup', EntityType::class, [
                'class' => ConcertGroup::class,
                'choice_label' => 'name',
                'label' => 'Groupe de musique'
            ])
            ->add('concertOrganizer', EntityType::class, [
                'class' => ConcertOrganizer::class,
                'choice_label' => 'name',
                'label' => 'Organisateurs du concert'
            ])
            ->add('concertTicketoffice', EntityType::class, [
                'class' => ConcertTicketOffice::class,
                'label' => 'Billeterie',
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('concertHall', EntityType::class, [
                'class' => ConcertHall::class,
                'label' => 'Salle du concert',
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConcertConcert::class,
        ]);
    }
}
