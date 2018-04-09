<?php
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien", indexes={@ORM\Index(name="IDX_45EDC386924DD2B5", columns={"localite_id"}), @ORM\Index(name="IDX_45EDC386677134B4", columns={"typebien_id"})})
 * @ORM\Entity
 */
class Bien
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_bien", type="string", length=30, nullable=false)
     */
    private $nomBien;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prixlocation", type="integer", nullable=false)
     */
    private $prixlocation;

    /**
     * @var \TypeBien
     *
     * @ORM\ManyToOne(targetEntity="TypeBien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typebien_id", referencedColumnName="id")
     * })
     */
    private $typebien;

    /**
     * @var \Localite
     *
     * @ORM\ManyToOne(targetEntity="Localite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localite_id", referencedColumnName="id")
     * })
     */
    private $localite;


}
