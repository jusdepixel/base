<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\UseCase\RegisterMember;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegisterMemberController
 * @package App\Controller
 */
class MemberController extends AbstractController
{
    /**
     * @var RegisterMember
     */
    private RegisterMember $registerMember;

    /**
     * RegisterMemberController constructor.
     * @param RegisterMember $registerMember
     */
    public function __construct(RegisterMember $registerMember)
    {
        $this->registerMember = $registerMember;
    }

    /**
     * @Route("/register/member", name="register_member")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request)
    {
        $member = new Member();

        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerMember->execute($member);

            return $this->redirectToRoute('index');
        }

        return $this->render('register/member.html.twig', [
            'controller_name' => 'RegisterMemberController',
            'form' => $form->createView(),
        ]);
    }
}
