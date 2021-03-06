<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Representation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('description', TextareaType::class, ['label' => 'Description'])
            ->add('duration', IntegerType::class, ['label' => 'Durée (en min)'])
/*            ->add('priceChildren', IntegerType::class, ['label' => 'Prix enfant'])
            ->add('priceAdult', IntegerType::class, ['label' => 'Prix adulte'])*/
            ->add('basisPrice', IntegerType::class, ['label' => 'Prix de base'])
            ->add('pictureFile', VichFileType::class, [
                'label'             => 'Image',
                'download_link'     => false,
                'allow_delete'      => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
