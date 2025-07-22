<?php

namespace App\Controller;

use App\Application\ApplicationCreate;
use App\Application\ApplicationForgot;
use App\Exception\ApplicationException;
use App\Form\ApplicationForgotForm;
use App\Form\ApplicationLoginForm;
use App\Form\ApplicationRegisterForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApplicationController extends AbstractController
{
    public function __construct(private ApplicationCreate $applicationCreate, private ApplicationForgot $applicationForgot)
    {
    }

    /**
     * @Route("/", name="index_application")
     */
    public function index(Request $request)
    {
        $iso = $request->query->get('iso');
        if($iso)
        {
            $this->addFlash('regIso', $iso);
        }

        // Register
        $form = $this->createForm(ApplicationRegisterForm::class);
        $form->handleRequest($request);

        // Continue
        $form2 = $this->createForm(ApplicationLoginForm::class);
        $form2->handleRequest($request);

        return $this->render('default/index.html.twig', [
            'registerForm' => $form->createView(),
            'continueForm' => $form2->createView()
        ]);
    }

    /**
     * @Route("/create", name="create_application", methods={"POST"})
     */
    public function create(Request $request)
    {
        try {
           return $this->applicationCreate->create($request);
        }
        catch(ApplicationException $exception) {
            $this->addFlash('errorCode', $exception->getCode());
            $this->addFlash('errorReg', $exception->getMessage());
            $this->addFlash('errorRegEmail', (string) $request->request->get('application_register_form')['businessEmail']);
            $this->addFlash('regIso', (string) $request->request->get('application_register_form')['isoId']);

            return $this->redirectToRoute('index_application');
        }
    }

    /**
     * @Route("/forgot", name="forgot_application")
     */
    public function forgot(Request $request)
    {
        $return = false;

        $form = $this->createForm(ApplicationForgotForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            try {
                $return = $this->applicationForgot->forgot($request);
            }
            catch(\Exception $exception) {
                $this->addFlash('error', $exception->getMessage());
                $this->addFlash('errorEmail', (string) $request->request->get('application_forgot_form')['businessEmail']);
            }
        }

        return $this->render('default/forgot.html.twig', [
            'form' => $form->createView(),
            'formReturn' => $return
        ]);
    }
}
