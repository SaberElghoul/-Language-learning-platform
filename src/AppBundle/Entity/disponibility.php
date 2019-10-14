<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * disponibility
 *
 * @ORM\Table(name="disponibility")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\disponibilityRepository")
 */
class disponibility
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
     * @var \DateTime
     *
     * @ORM\Column(name="starttime", type="time")
     */
    private $starttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endtime", type="time")
     */
    private $endtime;

    /**
     * @var string
     *
     * @ORM\Column(name="taughtlanguage", type="string", length=255)
     */
    private $taughtlanguage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Day", type="date")
     */
    private $day;




    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="disponibilities")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;






    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set starttime
     *
     * @param \DateTime $starttime
     *
     * @return disponibility
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return \DateTime
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Set endtime
     *
     * @param \DateTime $endtime
     *
     * @return disponibility
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return \DateTime
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Set taughtlanguage
     *
     * @param string $taughtlanguage
     *
     * @return disponibility
     */
    public function setTaughtlanguage($taughtlanguage)
    {
        $this->taughtlanguage = $taughtlanguage;

        return $this;
    }

    /**
     * Get taughtlanguage
     *
     * @return string
     */
    public function getTaughtlanguage()
    {
        return $this->taughtlanguage;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     *
     * @return disponibility
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return disponibility
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
