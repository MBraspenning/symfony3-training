<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Serializer;

/**
* User
*
* @ORM\Table(name="user")
* @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
*/

class User implements UserInterface, \Serializable
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
    * @ORM\Column(name="username", type="string", length=255, unique=true)
    */
    private $username;
    
    /**
    * @var string
    *
    * @ORM\Column(name="password", type="string", length=64)
    */
    private $password;
    
    /**
    * @var string
    *
    * @ORM\Column(name="email", type="string", length=255)
    */
    private $email;
    
    /**
    * Get username
    *
    * @return string
    */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        
        return $this;
    }
    
    /**
    * Get password
    *
    * @return string
    */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        
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
    
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ));
    }
    
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ) = unserialize($serialized);
    }
    
    public function getSalt()
    {
        return null;
    }
    
    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    
    public function eraseCredentials()
    {
    }
}