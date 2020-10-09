<?php

namespace App\UseCase;

use App\Entity\Admin;
use App\Gateway\AdminGateway;
use Assert\Assert;

class RegisterAdmin
{
    /**
     * @var AdminGateway
     */
    private AdminGateway $gateway;

    /**
     * RegisterAdmin constructor.
     * @param AdminGateway $gateway
     */
    public function __construct(AdminGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function execute(Admin $admin): Admin
    {
        Assert::lazy()
            ->that($admin->getFirstName(), 'firstName')
                ->notBlank()
                ->minLength(2)
            ->that($admin->getLastName(), 'lastName')
                ->notBlank()
                ->minLength(2)
            ->that($admin->getEmail(), 'email')
                ->notBlank()
                ->email()
            ->that($admin->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->regex(
                    "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
                )
            ->that($admin->getPseudo(), 'pseudo')
                ->notBlank()
                ->minLength(2)
            ->verifyNow()
        ;

        $this->gateway->register($admin);

        return $admin;
    }
}