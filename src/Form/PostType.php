<?php

namespace App\Form;


use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'constraints' => [new Assert\Length(['min' => 3, 'max' => 150])],
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'constraints' => [new Assert\Length(['min' => 3])],
            ])
            ->add('price', TextType::class, [
                'required' => true,
                'constraints' => [new Assert\Positive()],
            ])
            ->add('author', TextType::class, [
                'required' => false,
                'constraints' => [new Assert\Length(['min' => 2, 'max' => 128])],
            ])
            ->add('sku', TextType::class, [
                'required' => false,
                'constraints' => [new Assert\Length(['min' => 3, 'max' => 128])],
            ])
            ->add('save', SubmitType::class, ['label' => 'Save new Product'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
