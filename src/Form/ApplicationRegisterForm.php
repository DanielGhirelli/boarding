<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class ApplicationRegisterForm extends AbstractType
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('businessEmail', EmailType::class, array(
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "Business Email")))
            ->add('isoId', HiddenType::class, array(
            ))
            ->add('confirm', HiddenType::class, array(
                'mapped' => false
            ))
            ->add('Create', SubmitType::class, array(
                'label' => 'Begin Registration',
                'attr' => array('class' => 'btn btn-primary btn-block')
            ))
            ->setMethod('POST')
            ->setAction($this->router->generate('create_application'))
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