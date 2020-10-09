<?php

namespace App\Entity;

use App\Adapter\Doctrine\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"visitor"="App\Entity\Visitor", "admin"="App\Entity\Admin"})
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
     * @Assert\NotBlank()
     */
    protected ?string $plainPassword = null;

    /**
     * @var DateTimeInterface
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeInterface $registeredAt;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->registeredAt = new \DateTimeImmutable();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return $this
     */
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getRegisteredAt(): ?DateTimeInterface
    {
        return $this->registeredAt;
    }
}
