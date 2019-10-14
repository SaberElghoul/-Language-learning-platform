<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255,nullable=true)
     */
    private $pays;



    /**
     * @var string
     *
     * @ORM\Column(name="taughtlanguage", type="string", length=255,nullable=true)
     */
    private $taughtlanguage;



    /**
     * @var string
     * @Assert\NotBlank(message=" please enter an image")
     * @Assert\Image()
     * @ORM\Column (name="image", type="string",length=255,nullable=true)
     */
    private $image;


    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255,nullable=true)
     */

    private $headline;


    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255,nullable=true)
     */

    private $phoneNumber;



    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255,nullable=true)
     */

    private $facebook;


    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255,nullable=true)
     */

    private $twitter;

    /**
     *@ORM\OneToMany(targetEntity="photo", mappedBy="user_id", cascade={"remove"})
     */
    private $photos;


    /**
     *@ORM\OneToMany(targetEntity="disponibility", mappedBy="user", cascade={"remove"})
     */
    private $disponibilities;




    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */

    private $about;


    /**
     *@ORM\OneToMany(targetEntity="StudentLanguages", mappedBy="users", cascade={"remove"})
     *
     */
    private $StudentLanguages;


    /**
     *@ORM\OneToMany(targetEntity="post", mappedBy="user", cascade={"remove"})
     *
     */
    private $posts;

    /**
     * Date/Time of the last activity
     *
     * @var \Datetime
     * @ORM\Column(name="last_activity_at", type="datetime" ,nullable=true)
     */
    protected $lastActivityAt;

    /**
     * @param \Datetime $lastActivityAt
     */
    public function setLastActivityAt($lastActivityAt)
    {
        $this->lastActivityAt = $lastActivityAt;
    }

    /**
     * @return \Datetime
     */
    public function getLastActivityAt()
    {
        return $this->lastActivityAt;
    }

    /**
     * @return Bool Whether the user is active or not
     */
    public function isActiveNow()
    {
        // Delay during wich the user will be considered as still active
        $delay = new \DateTime('2 minutes ago');

        return ( $this->getLastActivityAt() > $delay );
    }
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return User
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set headline
     *
     * @param string $headline
     *
     * @return User
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return User
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }





    /**
     * Add studentLanguage
     *
     * @param \AppBundle\Entity\StudentLanguages $studentLanguage
     *
     * @return User
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

    /**
     * Add post
     *
     * @param \AppBundle\Entity\post $post
     *
     * @return User
     */
    public function addPost(\AppBundle\Entity\post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \AppBundle\Entity\post $post
     */
    public function removePost(\AppBundle\Entity\post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\photo $photo
     *
     * @return User
     */
    public function addPhoto(\AppBundle\Entity\photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\photo $photo
     */
    public function removePhoto(\AppBundle\Entity\photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set taughtlanguage
     *
     * @param string $taughtlanguage
     *
     * @return User
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
     * Add disponibility
     *
     * @param \AppBundle\Entity\disponibility $disponibility
     *
     * @return User
     */
    public function addDisponibility(\AppBundle\Entity\disponibility $disponibility)
    {
        $this->disponibilities[] = $disponibility;

        return $this;
    }

    /**
     * Remove disponibility
     *
     * @param \AppBundle\Entity\disponibility $disponibility
     */
    public function removeDisponibility(\AppBundle\Entity\disponibility $disponibility)
    {
        $this->disponibilities->removeElement($disponibility);
    }

    /**
     * Get disponibilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisponibilities()
    {
        return $this->disponibilities;
    }
}
