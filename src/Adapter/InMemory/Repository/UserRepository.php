<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Visitor;
use App\Entity\Admin;
use App\Entity\User;
use App\Gateway\UserGateway;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository implements UserGateway
{
    /**
     * @var User[]
     */
    public array $users = [];

    /**
     * UserRepository constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $visitor = (new Visitor())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("visitor@doe.com")
        ;

        $visitor->setPassword($userPasswordEncoder->encodePassword($visitor, "Password123!"));


        $admin = (new Admin())
            ->setFirstName("Jane")
            ->setLastName("Doe")
            ->setPseudo("JooohnDoooe")
            ->setEmail("admin@doe.com")
        ;

        $admin->setPassword($userPasswordEncoder->encodePassword($admin, "Password123!"));

        $this->users = [
            "visitor@doe.com" => $visitor,
            "admin@doe.com" => $admin
        ];
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UsernameNotFoundException();
        }

        return $this->users[$email];
    }
}