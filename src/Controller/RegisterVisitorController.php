<?php

namespace App\Controller;

use App\Entity\Visitor;
use App\Form\VisitorType;
use App\UseCase\RegisterVisitor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegisterVisitorController
 * @package App\Controller
 */
class RegisterVisitorController extends AbstractController
{
    /**
     * @var RegisterVisitor
     */
    private RegisterVisitor $registerVisitor;

    /**
     * RegisterVisitorController constructor.
     * @param RegisterVisitor $registerVisitor
     */
    public function __construct(RegisterVisitor $registerVisitor)
    {
        $this->registerVisitor = $registerVisitor;
    }

    /**
     * @Route("/register/visitor", name="register_visitor")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request)
    {
        $visitor = new Visitor();

        $form = $this->createForm(VisitorType::class, $visitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerVisitor->execute($visitor);

            return $this->redirectToRoute('index');
        }

        return $this->render('register/visitor.html.twig', [
            'controller_name' => 'RegisterVisitorController',
            'form' => $form->createView(),
        ]);
    }
}
