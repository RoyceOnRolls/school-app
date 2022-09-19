<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 50)]
    private ?string $LastName = null;

    #[ORM\Column(length: 10)]
    private ?string $Gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $BirthDate = null;

    #[ORM\Column(length: 50)]
    private ?string $BirthPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\ManyToMany(targetEntity: Tutor::class, inversedBy: 'students')]
    private Collection $tutor;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Level $level = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClassName $className = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Payment::class, orphanRemoval: true)]
    private Collection $payments;

    public function __construct()
    {
        $this->tutor = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->BirthPlace;
    }

    public function setBirthPlace(string $BirthPlace): self
    {
        $this->BirthPlace = $BirthPlace;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection<int, Tutor>
     */
    public function getTutor(): Collection
    {
        return $this->tutor;
    }

    public function addTutor(Tutor $tutor): self
    {
        if (!$this->tutor->contains($tutor)) {
            $this->tutor->add($tutor);
        }

        return $this;
    }

    public function removeTutor(Tutor $tutor): self
    {
        $this->tutor->removeElement($tutor);

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getClassName(): ?ClassName
    {
        return $this->className;
    }

    public function setClassName(?ClassName $className): self
    {
        $this->className = $className;

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setStudent($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getStudent() === $this) {
                $payment->setStudent(null);
            }
        }

        return $this;
    }
}
