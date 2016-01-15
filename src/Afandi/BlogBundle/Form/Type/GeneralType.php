<?php
namespace Afandi\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GeneralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('general_name', TextType::class)
            ->add('general_value_string', TextType::class, ['required' => false])
            ->add('general_value_integer', IntegerType::class, ['required' => false])
            ->add('general_value_date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false
                ])
            ->add('general_value_text', TextareaType::class, ['required' => false])
            ->add('imageFile', FileType::class, ['required' => false])
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'Afandi\BlogBundle\Entity\General',
	    ));
	}
}