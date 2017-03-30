<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteNAType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datevisite', 'datetime', array('widget' => 'single_text',
                                               'date_format' => 'yyyy-MM-dd  HH:i'))
                ->add('diab')->add('tension')->add('poid')->add('remarque');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\AdminBundle\Entity\VisiteNA'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'admin_adminbundle_visitena';
    }


}
