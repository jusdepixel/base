<?php

namespace App\Security;

use App\Entity\User;
use App\Gateway\UserGateway;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 * @package App\Security
 */
class UserProvider implements UserProviderInterface
{
    /**
     * @var UserGateway
     */
    private UserGateway $gateway;

    /**
     * UserProvider constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param string $username
     * @return User|UserInterface
     */
    public function loadUserByUsername(string $username)
    {
        return $this->getUserByUsername($username);
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->gateway->findByEmail($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass(string $class)
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    /**
     * @param string $username
     * @return User
     */
    private function getUserByUsername(string $username): User
    {
        return $this->gateway->findByEmail($username);
    }
}
