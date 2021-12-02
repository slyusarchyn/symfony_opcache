<?php

namespace App\Domain\User;

use App\Domain\Shared\Embeddable\Timestamps;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;
    private string $email;
    private string $password;
    private Timestamps $timestamps;

    private function __construct()
    {
        $this->timestamps = new Timestamps();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getTimestamps(): Timestamps
    {
        return $this->timestamps;
    }

    public function setTimestamps(Timestamps $timestamps): void
    {
        $this->timestamps = $timestamps;
    }

    /**
     * @param UuidInterface $uuid
     * @param string        $email
     * @param string        $passwordHash
     * @return static
     */
    public static function create(UuidInterface $uuid, string $email, string $passwordHash): self
    {
        $instance = new self();

        $instance->setId($uuid);
        $instance->setEmail($email);
        $instance->setPassword($passwordHash);

        return $instance;
    }
}