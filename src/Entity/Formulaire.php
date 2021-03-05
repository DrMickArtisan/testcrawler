<?php

namespace App\Entity;

use App\Repository\FormulaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FormulaireRepository::class)
 */
class Formulaire
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata
            ->addPropertyConstraint('myArray',new   Assert\NotBlank())
            ->addPropertyConstraint('myArray',new  Assert\NotNull())
            ->addPropertyConstraint('myArray',
                new Assert\Choice([
                    'callback' =>  'getAllServicesContrainst',
                    'multiple' => true,
                    'multipleMessage' => 'Le motif précisé n\'est pas le bon',
            ]));
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $myArray = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyArray(): ?array
    {
        return $this->myArray;
    }

    public function setMyArray(?array $myArray): self
    {
        $this->myArray = $myArray;

        return $this;
    }
    public function getAllServices(): array
    {
        return ['hs' =>'HS','con' => 'CON','hdj' => 'HDJ'];
    }
    //~ Renvoi les motifs d'admissions possibles pour cette clinique
    public function getAllServicesContrainst():?array {
        return array_keys($this->getAllServices());
    }


}
