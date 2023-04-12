<?php

namespace App\Form;

use App\Entity\Acts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ActsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Build the form
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('stage' , ChoiceType::class, [
                'choices' => [
                    'Main Stage' => 'Main Stage',
                    'Boiler Room' => 'Boiler Room',
                    'Marquee' => 'Marquee',
                ],
            ])
            ->add('date')
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a PNG or JPEG document',
                    ])
                ],
            ])
            ->add('description', TextType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acts::class,
        ]);
    }
}