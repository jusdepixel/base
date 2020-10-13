<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\UseCase\RegisterAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends AbstractController
{
    /**
     * @var RegisterAdmin
     */
    private RegisterAdmin $registerAdmin;

    /**
     * RegisterAdminController constructor.
     * @param RegisterAdmin $registerAdmin
     */
    public function __construct(RegisterAdmin $registerAdmin)
    {
        $this->registerAdmin = $registerAdmin;
    }


    /**
     * @Route("/register/admin", name="register_admin")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function register(Request $request)
    {
        $admin = new Admin();

        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerAdmin->execute($admin);

            return $this->redirectToRoute('index');
        }

        return $this->render('register/admin.html.twig', [
            'controller_name' => 'RegisterAdminController',
            'form' => $form->createView(),
        ]);
    }
}
