<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Item;
use App\Request\InsertItemRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ItemType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->add('name', TextType::class, ['constraints' => [new NotBlank()]])
            ->add('unit', TextType::class, ['constraints' => [new NotBlank()]])
            ->add('quantity', IntegerType::class, ['constraints' => [New NotBlank()]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => InsertItemRequest::class
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}