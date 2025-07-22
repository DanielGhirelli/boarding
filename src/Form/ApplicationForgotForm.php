<?php


namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationForgotForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('businessEmail', EmailType::class, array(
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "Business Email")))
            ->add('submit', SubmitType::class, array(
                'label' => 'Recover My Application ID',
                'attr' => array('class' => 'btn btn-primary btn-block')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array(
                OmnifundApplications::class, 'grp_registration',
            ),
        ));
    }
}
