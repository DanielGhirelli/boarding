<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterOwnershipForm extends AbstractType
{
    public function __construct(private StateChoiceList $stateChoiceList)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ownerFirst', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "First Name")))
            ->add('ownerLast', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "Last Name")))
            ->add('ownerDob', DateType::class, array(
                'empty_data' => null,
                'format' => 'MM/dd/yyyy',
                'invalid_message' => 'Please enter a valid date of birth.',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "mm/dd/yyyy")))
            ->add('ownerPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 90px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('ownerDl', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 20)))
            ->add('ownerDlState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('ownerSsn', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 11, 'data-mask' => '000-00-0000', 'placeholder' => "xxx-xx-xxxx")))
            ->add('ownerAddress1', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150)))
            ->add('ownerCity', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('ownerState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('ownerZip', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 10, 'data-mask' => '00000-0000')))
            ->add('ownerPhone', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('ownerEmail', EmailType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150, 'placeholder' => "joe@example.com")))
            ->add('owner2First', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "First Name")))
            ->add('owner2Last', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50, 'placeholder' => "Last Name")))
            ->add('owner2Dob', DateType::class, array(
                'format' => 'MM/dd/yyyy',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "mm/dd/yyyy")))
            ->add('owner2Percent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 90px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('owner2Dl', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 20)))
            ->add('owner2DlState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('owner2Ssn', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 11, 'data-mask' => '000-00-0000', 'placeholder' => "xxx-xx-xxxx")))
            ->add('owner2Address1', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150)))
            ->add('owner2City', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('owner2State', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('owner2Zip', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 10, 'data-mask' => '00000-0000')))
            ->add('owner2Phone', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('owner2Email', EmailType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150, 'placeholder' => "joe@example.com")))
            ->add('ownerTitle', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Manager' => 'Manager',
                    'Owner' => 'Owner',
                    'Partner' => 'Partner',
                    'President' => 'President',
                    'Secretary' => 'Secretary',
                    'Treasurer' => 'Treasurer',
                    'V. President' => 'V.President',
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('owner2Title', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Manager' => 'Manager',
                    'Owner' => 'Owner',
                    'Partner' => 'Partner',
                    'President' => 'President',
                    'Secretary' => 'Secretary',
                    'Treasurer' => 'Treasurer',
                    'V. President' => 'V.President',
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_business_bank'
            ))
            ->add('acceptCc', HiddenType::class, array(
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' =>
                function (FormInterface $form) {
                    $array = array(OmnifundApplications::class, 'grp_ownership');

                    $acceptCc = ("y" == $form->getData()->getAcceptCc() ? true : false);
                    if($acceptCc){ array_push($array, 'grp_ownership_dl'); }

                    if ($form->getData()->getOwnerPercent() >= 25 && $form->getData()->getOwnerPercent() <= 49) {
                        array_push($array, 'grp_ownership2');
                        if($acceptCc){ array_push($array, 'grp_ownership2_dl'); }
                    }

                    return $array;
                },
        ));
    }
}