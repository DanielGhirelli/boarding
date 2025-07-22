<?php

namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterBankForm extends AbstractType
{
    public function __construct(private StateChoiceList $stateChoiceList)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bankNameOnAccount', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('bankName', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('bankPhone', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('bankCity', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 50)))
            ->add('bankState', ChoiceType::class, array(
                'choices' => $this->stateChoiceList->load(),
                'attr' => array('class' => 'form-control input-sm')))
            ->add('bankRouting', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('bankAccount', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 20, 'data-mask' => '00000000000000000000')))
            ->add('bankType', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Checking' => 'C',
                    'Savings' => 'S'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('bank2', ChoiceType::class, array(
                'required' => false,
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => ''
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('bank2Routing', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('bank2Account', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 20, 'data-mask' => '00000000000000000000')))
            ->add('bank2Usedfor', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Chargebacks' => 'Chargebacks',
                    'Credits' => 'Credits',
                    'Discount' => 'Discount',
                    'Fees' => 'Fees',
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('bank2Type', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Checking' => 'C',
                    'Savings' => 'S'
                ),
                'attr' => array('class' => 'form-control input-sm')
            ))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_card'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' =>
                function (FormInterface $form) {
                    $array = [OmnifundApplications::class, 'grp_business_bank'];

                    if("y" === $form->getData()->getBank2())
                    {
                        $array[] = 'grp_business_bank2';
                    }

                    return $array;
                },
        ));
    }
}