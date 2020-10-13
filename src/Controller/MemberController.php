<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\UseCase\MemberRegister;
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
     * @var MemberRegister
     */
    private MemberRegister $registerMember;

    /**
     * RegisterMemberController constructor.
     * @param MemberRegister $registerMember
     */
    public function __construct(MemberRegister $registerMember)
    {
        $this->registerMember = $registerMember;
    }

    /**
     * @Route("/member/register", name="member_register")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function register(Request $request)
    {
        $member = new Member();

        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerMember->execute($member);

            return $this->redirectToRoute('index');
        }

        return $this->render('member/register.html.twig', [
            'controller_name' => 'MemberController - Register',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("member/resume", name="member_resume")
     * @param Request $request
     * @return Response
     */
    public function resume(Request $request)
    {
        return $this->render('admin/resume.html.twig', [
            'controller_name' => 'MemberController - Resume',
        ]);
    }
}
