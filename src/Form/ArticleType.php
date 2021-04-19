<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('image', FileType::class, [
                    'required' => false,
                    'mapped' => false,
                    'constraints'=> [
                        new File([
                            'maxSize' => '2M',
                            'mimeTypes' => [
                                'image/jpg',
                                'image/png'
                            ],
                            'mimeTypesMessage' => 'Extensions acceptées : jpg png',
                        ])
                    ]
            ])
            ->add('add', SubmitType::class,[
                'attr' => ['class' => 'btn btn-light mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
