<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterBusinessInfoForm extends AbstractType
{
    public function __construct(private StateChoiceList $stateChoiceList)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('businessContactFirst', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "First Name")))
            ->add('businessContactLast', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "Last Name")))
            ->add('businessName', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100)))
            ->add('businessAddress1', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150)))
            ->add('businessCity', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('businessState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('businessZip', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 10, 'data-mask' => '00000-0000')))
            ->add('businessPhone', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('businessEmail', EmailType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150, 'placeholder' => "joe@example.com")))
            ->add('businessTaxid', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('businessDba', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100)))
            ->add('useLegalAddress', CheckboxType::class, array(
                'mapped' => false))
            ->add('businessDbaAddress1', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150)))
            ->add('businessDbaCity', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('businessDbaState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('businessDbaZip', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 10, 'data-mask' => '00000-0000')))
            ->add('businessDbaPhone', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('businessFax', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('businessNumLocations', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm', 'data-mask' => '00000')))
            ->add('heardAbout', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 255, 'placeholder' => "sales rep, advertisement, friend, social media, etc...")))
            ->add('businessWebsite', UrlType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100, 'placeholder' => "companywebsite.com")))
            ->add('softwareIntegration', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Beam Software' => 'Beam Software',
                    'CRE Portals' => 'CRE Portals',
                    'ImagineTime' => 'ImagineTime',
                    'Kennelsoft' => 'Kennelsoft',
                    'MS Dynamics 365' => 'MS Dynamics 365',
                    'QuickBooks' => 'QuickBooks',
                    'Sage Intacct' => 'Sage Intacct',
                    'TurboLease' => 'TurboLease',
                    'Other...' => 'Other'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('softwareIntegrationOther', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 255)))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_business_struc'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array(
                OmnifundApplications::class, 'grp_business_info',
            ),
        ));
    }
}