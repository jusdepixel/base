<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Admin
 * @package App\Entity
 * @ORM\Entity
 */
class Admin extends User
{
    /**
     * @var string | null
     * @ORM\Column(type="string", length=255)
     */
    private ?string $pseudo = null;

    /**
     * @return string|null
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return $this
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles()
    {
        return ["ROLE_USER", 'ROLE_ADMIN'];
    }
}
