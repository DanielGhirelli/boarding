<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterBusinessStrucForm Extends AbstractType
{
    public function __construct(private MccCodeList $codeList)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ownershipType', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'C Corporation' => 'Corporation',
                    'S Corporation' => 'S Corporation',
                    'Government' => 'Government Entity',
                    'Limited Liability Corporation' => 'LLC',
                    'Limited Liability Partnership' => 'LLP',
                    'Not For Profit' => 'Non-Profit',
                    'Partnership' => 'Partnership',
                    'Sole Proprietorship' => 'Sole Proprietor',
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('businessOpenDate', DateType::class, array(
                'empty_data' => null,
                'format' => 'MM/dd/yyyy',
                'invalid_message' => 'Please enter a business open date.',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'form-control input-sm', 'placeholder' => "mm/dd/yyyy")
            ))
            ->add('acceptCC', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('currentlyProcessingCc', ChoiceType::class, array(
                'required' => false,
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('acceptAch', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('currentlyProcessingAch', ChoiceType::class, array(
                'required' => false,
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('mccCode', ChoiceType::class, array(
                'required' => false,
                'choices' => $this->codeList->load(),
                'attr' => array('class' => 'form-control input-sm combobox', 'style' => 'width: 100px')
            ))
            ->add('acceptAdvance', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('advanceDaysDepositPaid', ChoiceType::class, array(
                'choices'  => array(
                    '' => null,
                    '0-2 days' => 1,
                    '3-30 days' => 3,
                    '31-60 days' => 31,
                    '61-90 days' => 61,
                    'Over 90 days' => 91
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('seasonal', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('fulfillmentPerformedBy', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Our business   ' => 'Our business',
                    ' Vendor' => 'Vendor'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('fulfillmentVendor', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100)))
            ->add('fulfillmentContact', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 100)))
            ->add('fulfillmentPci', ChoiceType::class, array(
                'required' => false,
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('fulfillmentPercent', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 70px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 3, 'data-mask' => '000')))
            ->add('businessDescription', TextareaType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'style' => 'width:285px; height: 110px;', 'maxlength' => 500)))
            ->add('refundPolicy', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'No Refund' => 'N',
                    'Merchandise Exchange only' => 'ME',
                    'Refund in 30 days or less' => 'R30',
                    'Other...' => 'O'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('refundPolicyOther', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('locationType', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Industrial Building' => 'I',
                    'Office Building' => 'O',
                    'Residence' => 'R',
                    'Retail Store Front' => 'RS',
                    'Trade Show' => 'T'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('activeMonths', ChoiceType::class, array(
                'choices'  => array(
                    'January' => 'JAN',
                    'February' => 'FEB',
                    'March' => 'MAR',
                    'April' => 'APR',
                    'May' => 'MAY',
                    'June' => 'JUN',
                    'July' => 'JUL',
                    'August' => 'AUG',
                    'September' => 'SEP',
                    'October' => 'OCT',
                    'November' => 'NOV',
                    'December' => 'DEC'
                ),
                'multiple'=> true,
                'attr' => array('class' => 'form-control input-sm', 'style' => 'height: 95px')
            ))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_ownership_info'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' =>
                function (FormInterface $form) {
                    $array = [OmnifundApplications::class, 'grp_business_struc'];

                    if ("y" == $form->getData()->getAcceptAdvance()) { $array[] = 'grp_accept_advance'; }
                    if ("y" == $form->getData()->getSeasonal()) { $array[] = 'grp_seasonal'; }
                    if ("Vendor" == $form->getData()->getFulfillmentPerformedBy()) { $array[] = 'grp_fulfillment_vendor'; }

                    return $array;
                },
        ));
    }
}