<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\AdminRepository;
use App\Entity\Admin;
use App\UseCase\AdminRegister;
use Assert\LazyAssertionException;
use Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterAdminTest
 * @package App\Tests\Unit
 */
class AdminRegisterTest extends TestCase
{
    public function testSuccessRegistration()
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new AdminRegister(new AdminRepository(), $userPasswordEncoder);

        $admin = new Admin();
        $admin
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*")
            ->setPseudo("Pseudo");

        $this->assertEquals($admin, $useCase->execute($admin));
    }

    /**
     * @dataProvider provideBadRegistration
     * @param Admin $admin
     */
    public function testBadRegistration(Admin $admin)
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new AdminRegister(new AdminRepository(), $userPasswordEncoder);

        $this->expectException(LazyAssertionException::class);

        $useCase->execute($admin);
    }

    /**
     * @return Generator
     */
    public function provideBadRegistration(): Generator
    {
        yield [
            (new Admin())
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("j")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("d")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("failure")
                ->setPlainPassword("Password123*")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("failure")
                ->setPseudo("Pseudo")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("")
        ];

        yield [
            (new Admin())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
                ->setPseudo("f")
        ];
    }
}
