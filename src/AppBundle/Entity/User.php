<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 16/01/2017
 * Time: 03:22
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              type =  "string",
 *              name     = "email",
 *              nullable = true,
 *              unique   = true
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              type = "string",
 *              name     = "email_canonical",
 *              nullable = true,
 *              unique   = true
 *          )
 *      )
 * })
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $famille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $race;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nourriture;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="amis",
     *     joinColumns={@ORM\JoinColumn(name="user_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $amis;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->amis = new ArrayCollection();
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function getFamille()
    {
        return $this->famille;
    }

    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * @return array
     */
    public function getAmis()
    {
        return $this->amis->toArray();
    }

    /**
     * @param  User $user
     * @return void
     */
    public function addAmi(User $user)
    {
        if (!$this->amis->contains($user)) {
            $this->amis->add($user);
            $user->addAmi($this);
        }
    }

    /**
     * @param  User $user
     * @return void
     */
    public function removeAmi(User $user)
    {
        if ($this->amis->contains($user)) {
            $this->amis->removeElement($user);
            $user->removeAmi($this);
        }
    }

}