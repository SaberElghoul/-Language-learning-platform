<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentLanguages
 *
 * @ORM\Table(name="student_languages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentLanguagesRepository")
 */
class StudentLanguages
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
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="StudentLanguages")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="StudentLanguages")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $languages;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
     private $level;


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
     * Set users
     *
     * @param \AppBundle\Entity\User $users
     *
     * @return StudentLanguages
     */
    public function setUsers(\AppBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set languages
     *
     * @param \AppBundle\Entity\Language $languages
     *
     * @return StudentLanguages
     */
    public function setLanguages(\AppBundle\Entity\Language $languages = null)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set level
     *
     * @param string $level
     *
     * @return StudentLanguages
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }
}
