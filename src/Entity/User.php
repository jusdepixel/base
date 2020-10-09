<?php

namespace App\Entity;

use App\Adapter\Doctrine\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"visitor" = "App\Entity\Visitor", "admin" = "App\Entity\Admin"})
 */
abstract class User
{
    /**
     * @var int |null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $firstName = null;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $lastName = null;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $email = null;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $password = null;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $plainPassword = null;

    /**
     * @var DateTimeInterface
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeInterface $registeredAt;

    public function __construct()
    {
        $this->registeredAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getRegisteredAt(): ?DateTimeInterface
    {
        return $this->registeredAt;
    }
}
