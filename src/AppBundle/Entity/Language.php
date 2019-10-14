<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *@ORM\OneToMany(targetEntity="StudentLanguages", mappedBy="languages", cascade={"remove"})
     *
     */
    private $StudentLanguages;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * Add studentLanguage
     *
     * @param \AppBundle\Entity\StudentLanguages $studentLanguage
     *
     * @return Language
     */
    public function addStudentLanguage(\AppBundle\Entity\StudentLanguages $studentLanguage)
    {
        $this->StudentLanguages[] = $studentLanguage;

        return $this;
    }

    /**
     * Remove studentLanguage
     *
     * @param \AppBundle\Entity\StudentLanguages $studentLanguage
     */
    public function removeStudentLanguage(\AppBundle\Entity\StudentLanguages $studentLanguage)
    {
        $this->StudentLanguages->removeElement($studentLanguage);
    }

    /**
     * Get studentLanguages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudentLanguages()
    {
        return $this->StudentLanguages;
    }




    public function __toString() {
        return $this->name;
    }
}
