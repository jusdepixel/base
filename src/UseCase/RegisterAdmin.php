<?php

namespace App\UseCase;

use App\Entity\Admin;
use App\Gateway\AdminGateway;
use Assert\Assert;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterAdmin
 * @package App\UseCase
 */
class RegisterAdmin
{
    /**
     * @var AdminGateway
     */
    private AdminGateway $gateway;

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * RegisterAdmin constructor.
     * @param AdminGateway $gateway
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(AdminGateway $gateway, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->gateway = $gateway;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function execute(Admin $admin): Admin
    {
        $pwPattern = "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/";

        Assert::lazy()
            ->that($admin->getPseudo(), 'pseudo')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($admin->getFirstName(), 'firstName')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($admin->getLastName(), 'lastName')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($admin->getEmail(), 'email')
                ->notBlank()
                ->maxLength(255)
                ->email()
            ->that($admin->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->maxLength(255)
                ->regex($pwPattern)
            ->verifyNow()
        ;

        $admin->setPassword($this->passwordEncoder->encodePassword($admin, $admin->getPlainPassword()));

        $this->gateway->register($admin);

        return $admin;
    }
}
