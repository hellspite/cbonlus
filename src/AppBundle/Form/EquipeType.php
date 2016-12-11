<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EquipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('role')
            ->add('text', CKEditorType::Class, array(
                'config_name' => 'cbonlus_config',
                'config' => array(
                    'filebrowserBrowserRoute' => 'elfinder',
                    'filebrowserBrowserRouteParameters' => array(
                        'instance' => 'default',
                        'homeFolder' => ''
                    )
                ),
            ))        
            ->add('file', VichImageType::class, array('required' => false))
            ->add('email')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Equipe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_equipe';
    }


}
