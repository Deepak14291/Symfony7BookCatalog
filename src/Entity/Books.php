<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $BookName = null;

    #[ORM\Column(length: 255)]
    private ?string $BookAuthor = null;

    #[ORM\Column(length: 255)]
    private ?string $BookGenre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookName(): ?string
    {
        return $this->BookName;
    }

    public function setBookName(string $BookName): static
    {
        $this->BookName = $BookName;

        return $this;
    }

    public function getBookAuthor(): ?string
    {
        return $this->BookAuthor;
    }

    public function setBookAuthor(string $BookAuthor): static
    {
        $this->BookAuthor = $BookAuthor;

        return $this;
    }

    public function getBookGenre(): ?string
    {
        return $this->BookGenre;
    }

    public function setBookGenre(string $BookGenre): static
    {
        $this->BookGenre = $BookGenre;

        return $this;
    }
}
