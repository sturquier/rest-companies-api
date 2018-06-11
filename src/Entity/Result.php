<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 */
class Result
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ca;

    /**
     * @ORM\Column(type="integer")
     */
    private $margin;

    /**
     * @ORM\Column(type="integer")
     */
    private $ebitda;

    /**
     * @ORM\Column(type="integer")
     */
    private $loss;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    public function getId()
    {
        return $this->id;
    }

    public function getCa(): ?int
    {
        return $this->ca;
    }

    public function setCa(int $ca): self
    {
        $this->ca = $ca;

        return $this;
    }

    public function getMargin(): ?int
    {
        return $this->margin;
    }

    public function setMargin(int $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    public function getEbitda(): ?int
    {
        return $this->ebitda;
    }

    public function setEbitda(int $ebitda): self
    {
        $this->ebitda = $ebitda;

        return $this;
    }

    public function getLoss(): ?int
    {
        return $this->loss;
    }

    public function setLoss(int $loss): self
    {
        $this->loss = $loss;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
