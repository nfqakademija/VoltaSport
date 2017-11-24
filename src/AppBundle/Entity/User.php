<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255)
     */
    private $facebookId;

    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="facebook_photo", type="string", nullable=true)
     */
    private $facebookPhoto;

    /**
     * @ORM\Column(name="facebook_token", type="string")
     */
    private $facebookToken;

    /**
     * @ORM\OneToMany(targetEntity="Orders", mappedBy="user")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }
    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return mixed
     */
    public function getFacebookToken()
    {
        return $this->facebookToken;
    }

    /**
     * @param mixed $facebookToken
     */
    public function setFacebookToken($facebookToken)
    {
        $this->facebookToken = $facebookToken;
    }

    /**
     * @return mixed
     */
    public function getFacebookPhoto()
    {
        return $this->facebookPhoto;
    }

    /**
     * @param mixed $facebookPhoto
     */
    public function setFacebookPhoto($facebookPhoto)
    {
        $this->facebookPhoto = $facebookPhoto;
    }
}
