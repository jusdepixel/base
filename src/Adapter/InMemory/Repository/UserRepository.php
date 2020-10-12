<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Member;
use App\Entity\Admin;
use App\Entity\User;
use App\Gateway\UserGateway;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 * @package App\Adapter\InMemory\Repository
 */
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
        $member = (new Member())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("Member@doe.com")
        ;

        $member->setPassword($userPasswordEncoder->encodePassword($member, "Password123!"));


        $admin = (new Admin())
            ->setFirstName("Jane")
            ->setLastName("Doe")
            ->setPseudo("JooohnDoooe")
            ->setEmail("admin@doe.com")
        ;

        $admin->setPassword($userPasswordEncoder->encodePassword($admin, "Password123!"));

        $this->users = [
            "Member@doe.com" => $member,
            "admin@doe.com" => $admin
        ];
    }

    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UsernameNotFoundException();
        }

        return $this->users[$email];
    }
}
