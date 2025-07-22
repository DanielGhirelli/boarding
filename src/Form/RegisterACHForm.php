<?php


namespace App\Form;

use App\Entity\OmnifundApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterACHForm Extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debitMaxSingleAmount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('debitMaxDailyAmount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('debitMaxDailyCount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('debitMaxAmount14days', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('debitMaxCount14days', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('creditMaxSingleAmount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('creditMaxDailyAmount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('creditMaxDailyCount', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('creditMaxAmount14days', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm money')))
            ->add('creditMaxCount14days', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('style' => 'width: 120px; display: inline-block', 'class' => 'form-control input-sm', 'maxlength' => 9, 'data-mask' => '000000000')))
            ->add('sectypePpd', CheckboxType::class, array(
                'required'=> false))
            ->add('sectypeCcd', CheckboxType::class, array(
                'required'=> false))
            ->add('sectypeTel', CheckboxType::class, array(
                'required'=> false))
            ->add('sectypeWeb', CheckboxType::class, array(
                'required'=> false))
            ->add('sectypePop', CheckboxType::class, array(
                'required'=> false,
                'attr' => array('class' => 'ach_equipment')
            ))
            ->add('sectypeCheck21', CheckboxType::class, array(
                'required'=> false,
                'attr' => array('class' => 'ach_equipment')
            ))
            ->add('sectypeArc', CheckboxType::class, array(
                'required'=> false,
                'attr' => array('class' => 'ach_equipment')
            ))
            ->add('sectypeBoc', CheckboxType::class, array(
                'required'=> false,
                'attr' => array('class' => 'ach_equipment')
            ))
            ->add('sectypeRck', CheckboxType::class, array(
                'required'=> false,
                'attr' => array('class' => 'ach_equipment')
            ))
            ->add('achVerification', ChoiceType::class, array(
                'empty_data' => ' ',
                'invalid_message' => 'Please select an option.',
                'choices'  => array(
                    ' Yes   ' => 'y',
                    ' No' => 'n'
                ),
                'multiple'=> false, 'expanded' => true,
                'attr' => array('class' => 'control-label', 'style' => 'text-align: left')
            ))
            ->add('achEquipment', ChoiceType::class, array(
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
            ->add('achAvgTransaction', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 120px; display: inline-block;')))
            ->add('achAvgMonthly', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 120px; display: inline-block;')))
            ->add('achHighMonthly', TextType::class, array(
                'empty_data' => 0,
                'attr' => array('class' => 'form-control input-sm money', 'style' => 'width: 120px; display: inline-block;')))
            ->add('buyerBankStatement', TextareaType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'style' => 'width:285px; height: 110px;', 'maxlength' => 15)))
            ->add('phoneBankStatement', TextType::class, array(
                'empty_data' => '',
                'attr' => array('class' => 'form-control input-sm', 'maxlength' => 14, 'data-mask' => '(000) 000-0000', 'placeholder' => "(xxx) xxx-xxxxx")))
            ->add('Save', SubmitType::class, array(
                'label' => 'Save and Continue >',
                'attr' => array('class' => 'btn btn-primary btn-block', 'formnovalidate' => '')
            ))
            ->add('step', HiddenType::class, array(
                'data' => 'register_document'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array(
                OmnifundApplications::class, 'grp_ach',
            ),
        ));
    }
}