<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\UseCase\AdminRegister;
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
     * @var AdminRegister
     */
    private AdminRegister $registerAdmin;

    /**
     * RegisterAdminController constructor.
     * @param AdminRegister $registerAdmin
     */
    public function __construct(AdminRegister $registerAdmin)
    {
        $this->registerAdmin = $registerAdmin;
    }


    /**
     * @Route("/admin/register", name="admin_register")
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

        return $this->render('admin/register.html.twig', [
            'controller_name' => 'AdminController - Register',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/resume", name="admin_resume")
     * @param Request $request
     * @return Response
     */
    public function resume(Request $request)
    {
        return $this->render('admin/resume.html.twig', [
            'controller_name' => 'AdminController - Resume',
        ]);
    }
}
