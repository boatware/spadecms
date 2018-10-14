<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RandomChatPerson
 *
 * @ORM\Table(name="random_chat_person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RandomChatPersonRepository")
 */
class RandomChatPerson
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
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="looking_for", type="string", length=255)
     */
    private $lookingFor;


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
     * Set status
     *
     * @param string $status
     *
     * @return RandomChatPerson
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return RandomChatPerson
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lookingFor
     *
     * @param string $lookingFor
     *
     * @return RandomChatPerson
     */
    public function setLookingFor($lookingFor)
    {
        $this->lookingFor = $lookingFor;

        return $this;
    }

    /**
     * Get lookingFor
     *
     * @return string
     */
    public function getLookingFor()
    {
        return $this->lookingFor;
    }
}

