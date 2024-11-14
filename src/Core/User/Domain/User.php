<?php

namespace App\Core\User\Domain;

use App\Common\EventManager\EventsCollectorTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    use EventsCollectorTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=300, nullable=false)
     */
    private string $email;

     /**
     * @ORM\Column(type="smallint", nullable=false, options={"default" : 0})
     */
    private bool $isActive = false;

    public function __construct(string $email)
    {
        $this->id = null;
        $this->email = $email;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setIsActive(): self
    {
        $this->isActive = true;
        return $this;
    }

    public function getIsActive(): bool
    {
        return boolval($this->isActive);
    }
}
