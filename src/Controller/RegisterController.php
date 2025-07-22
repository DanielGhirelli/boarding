<?php

namespace App\Controller;

use App\Register\RegisterComplete;
use App\Register\RegisterDocumentAWS;
use App\Register\RegisterStep;
use App\Register\RegisterUpdate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController Extends AbstractController
{
    public function __construct(private RegisterStep $registerStep, private RegisterUpdate $registerUpdate, private RegisterDocumentAWS $documentAWS, private RegisterComplete $registerComplete)
    {
    }

    /**
     * @Route("/register/", name="index_register", methods={"GET", "POST"})
     */
    public function index(Request $request)
    {
        return $this->redirectToRoute($this->registerStep->route());
    }

    /**
     * @Route("/register/welcome/", name="register_welcome", methods={"GET", "POST"})
     */
    public function registerWelcome(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterWelcomeForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/welcome.html.twig', [
            'form' => $form->createView(),
            'title' => "Welcome"
        ]);
    }

    /**
     * @Route("/register/business-info/", name="register_business_info", methods={"GET", "POST"})
     */
    public function registerBusinessInfo(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterBusinessInfoForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/business_info.html.twig', [
            'form' => $form->createView(),
            'title' => "Business Information"
        ]);
    }

    /**
     * @Route("/register/business-structure/", name="register_business_struc", methods={"GET", "POST"})
     */
    public function registerBusinessStruc(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterBusinessStrucForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/business_struc.html.twig', [
            'form' => $form->createView(),
            'title' => "Business Structure"
        ]);
    }

    /**
     * @Route("/register/ownership-info/", name="register_ownership_info", methods={"GET", "POST"})
     */
    public function registerOwnershipInfo(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterOwnershipForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/ownership.html.twig', [
            'form' => $form->createView(),
            'title' => "Ownership Information"
        ]);
    }

    /**
     * @Route("/register/business-bank/", name="register_business_bank", methods={"GET", "POST"})
     */
    public function registerBank(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterBankForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/bank.html.twig', [
            'form' => $form->createView(),
            'title' => "Business Bank Information"
        ]);
    }

    /**
     * @Route("/register/card/", name="register_card", methods={"GET", "POST"})
     */
    public function registerCard(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterCardForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        if("y" != $form->getData()->getAcceptCC())
        {
            return $this->redirectToRoute('register_ach');
        }

        return $this->render('default/card.html.twig', [
            'form' => $form->createView(),
            'title' => "Credit Card Processing"
        ]);
    }

    /**
     * @Route("/register/ach/", name="register_ach", methods={"GET", "POST"})
     */
    public function registerACH(Request $request)
    {
        $form = $this->registerUpdate->update($request, 'App\Form\RegisterACHForm');
        if($form == "success")
        {
            return $this->redirectToRoute($this->registerStep->route());
        }

        if("y" != $form->getData()->getAcceptAch())
        {
            return $this->redirectToRoute('register_document');
        }

        return $this->render('default/ach.html.twig', [
            'form' => $form->createView(),
            'title' => "ACH/eCheck/Check 21 Processing"
        ]);
    }

    /**
     * @Route("/register/document/", name="register_document", methods={"GET", "POST"})
     */
    public function registerDocument(Request $request)
    {
        $form = $this->documentAWS->upload($request);
        if($form == "success")
        {
            $this->registerComplete->complete($request);
            return $this->redirectToRoute($this->registerStep->route());
        }

        return $this->render('default/document.html.twig', [
            'form' => $form->createView(),
            'title' => "Document Upload"
        ]);
    }

    /**
     * @Route("/register/complete/", name="register_complete", methods={"GET"})
     */
    public function registerComplete(Request $request)
    {
        return $this->render('default/complete.html.twig', [
            'title' => "Registration Complete"
        ]);
    }
}