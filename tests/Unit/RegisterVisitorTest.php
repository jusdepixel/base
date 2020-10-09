<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\VisitorRepository;
use App\Entity\Visitor;
use App\UseCase\RegisterVisitor;
use Assert\LazyAssertion;
use Assert\LazyAssertionException;
use Generator;
use PHPUnit\Framework\TestCase;

class RegisterVisitorTest extends TestCase
{
    public function testSuccessRegistration()
    {
        $useCase = new RegisterVisitor(new VisitorRepository());

        $visitor = new Visitor();
        $visitor
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*");

        $this->assertEquals($visitor, $useCase->execute($visitor));
    }

    /**
     * @dataProvider provideBadRegistration
     * @param Visitor $visitor
     */
    public function testBadRegistration(Visitor $visitor)
    {
        $useCase = new RegisterVisitor(new VisitorRepository());

        $this->expectException(LazyAssertionException::class);

        $useCase->execute($visitor);
    }

    /**
     * @return Generator
     */
    public function provideBadRegistration(): Generator
    {
        yield [
            (new Visitor())
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("j")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("d")
                ->setEmail("john@doe.com")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("failure")
                ->setPlainPassword("Password123*")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("")
        ];

        yield [
            (new Visitor())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("john@doe.com")
                ->setPlainPassword("failure")
        ];
    }
}
