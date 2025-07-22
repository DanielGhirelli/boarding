<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterCardForm Extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annualVolume', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 140px; display: inline-block;')))
            ->add('avgMonthlyVolume', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 100px; display: inline-block;')))
            ->add('highMonthlyVolume', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 100px; display: inline-block;')))
            ->add('avgTicket', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 100px; display: inline-block;')))
            ->add('highTicket', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 100px; display: inline-block;')))
            ->add('ccEquipment', ChoiceType::class, array(
                'required' => false,
                'empty_data' => '',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('compliantPci', ChoiceType::class, array(
                'empty_data' => 'n',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('pciSelfAssessment', ChoiceType::class, array(
                'required' => false,
                'empty_data' => '',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('pciSecAssessor', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 255)))
            ->add('pciCertNumber', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 255)))
            ->add('pciCertDate', DateType::class, array(
                'format' => 'MM/dd/yyyy',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "mm/dd/yyyy")))
            ->add('pciPaymentPlan', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Not Interested' => 'N',
                    'Self Assessment' => 'SA',
                    '$13.75/basic' => 'Basic',
                    '$165.00/managed' => 'Managed'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('storeCardholder', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('storePaper', CheckboxType::class, array(
                'required'=> false))
            ->add('storeElectronic', CheckboxType::class, array(
                'required'=> false))
            ->add('goodServicesOn', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Order' => 'O',
                    'Shipment' => 'S',
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('goodServicesDelivered', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Digitally' => 'D',
                    'Physically' => 'P',
                    'Both' => 'B'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('swipeF2fPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 50px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('swipeMotoPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 50px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('swipeInternetPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 50px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('accCompromise', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('accRemediation', ChoiceType::class, array(
                'required' => false,
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('merchantAdvertise', ChoiceType::class, array(
                'choices'  => array(
                    'Catalog' => 'C',
                    'Internet' => 'I',
                    'Mass/Direct Mail' => 'MM',
                    'Publications' => 'P',
                    'Telemarketing' => 'T',
                    'Word of Mouth' => 'WOM',
                    'Yellow Pages' => 'YP',
                    'Other Advertising' => 'Other'
                ),
                'multiple'=> true,
                'attr' => array('class' => 'form-control input-sm', 'style' => 'height: 95px')
            ))
            ->add('b2bPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 100px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('b2bMerchant', ChoiceType::class, array(
                'required' => false,
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('merchantAdvertiseWeb', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100, 'style' => 'margin-top: 10px; display: inline-block; width: 200px;', 'placeholder' => 'www.companywebsite.com')))
            ->add('merchantAdvertiseEmail', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 150, 'style' => 'margin-top: 10px; display: inline-block; width: 215px;', 'placeholder' => 'joe@example.com')))
            ->add('merchantAdvertiseOther', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 255, 'style' => 'margin-top: 10px; display: inline-block; width: 215px;')))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_ach'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' =>
                function (FormInterface $form) {
                    $array = [OmnifundApplications::class, 'grp_card'];

                    if ("y" == $form->getData()->getStoreCardholder()) { $array[] = 'grp_store_cardholder'; }
                    if ("y" == $form->getData()->getCompliantPci()) {
                        $array[] = 'grp_pci_yes';
                        if ("y" != $form->getData()->getPciSelfAssessment()) { $array[] = 'grp_pci_assessment'; }
                    } else {
                        $array[] = 'grp_pci_no';
                    }
                    if (in_array('Other', $form->getData()->getMerchantAdvertise()))
                    {
                        $array[] = 'grp_advertise_other';
                    }

                    return $array;
                },
        ));
    }
}