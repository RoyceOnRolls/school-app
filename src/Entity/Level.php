<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: ClassName::class, orphanRemoval: true)]
    private Collection $classNames;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: Student::class, orphanRemoval: true)]
    private Collection $students;

    public function __construct()
    {
        $this->classNames = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ClassName>
     */
    public function getClassNames(): Collection
    {
        return $this->classNames;
    }

    public function addClassName(ClassName $className): self
    {
        if (!$this->classNames->contains($className)) {
            $this->classNames->add($className);
            $className->setLevel($this);
        }

        return $this;
    }

    public function removeClassName(ClassName $className): self
    {
        if ($this->classNames->removeElement($className)) {
            // set the owning side to null (unless already changed)
            if ($className->getLevel() === $this) {
                $className->setLevel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setLevel($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getLevel() === $this) {
                $student->setLevel(null);
            }
        }

        return $this;
    }
}
