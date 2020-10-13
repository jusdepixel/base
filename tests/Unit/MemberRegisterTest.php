<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\MemberRepository;
use App\Entity\Member;
use App\UseCase\MemberRegister;
use Assert\LazyAssertionException;
use Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterMemberTest
 * @package App\Tests\Unit
 */
class MemberRegisterTest extends TestCase
{
    public function testSuccessRegistration()
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new MemberRegister(new MemberRepository(), $userPasswordEncoder);

        $member = new Member();
        $member
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*");

        $this->assertEquals($member, $useCase->execute($member));
    }

    /**
     * @dataProvider provideBadRegistration
     * @param Member $member
     */
    public function testBadRegistration(Member $member)
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new MemberRegister(new MemberRepository(), $userPasswordEncoder);

        $this->expectException(LazyAssertionException::class);

        $useCase->execute($member);
    }

    /**
     * @return Generator
     */
    public function provideBadRegistration(): Generator
    {
        yield [
            (new Member())
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("j")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("d")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("failure")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("")
        ];

        yield [
            (new Member())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("failure")
        ];
    }
}
