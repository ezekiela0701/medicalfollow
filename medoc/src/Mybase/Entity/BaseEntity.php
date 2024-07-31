<?php

namespace App\Mybase\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
class BaseEntity
{
    // /**
    //  * @var string
    //  *
    //  * @ORM\Column(name="uid", type="string", length=35, nullable=false)
    //  */
    // protected $uid;

    /**
     *@Groups("post:read")
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $updated;

    public function __construct() {
        $this->uid = md5(uniqid(microtime()));
        $this->created = new DateTime('');
        $this->updated = new DateTime('');
    }

    // /**
    //  * Mise a jour auto uts
    //  * @ORM\PrePersist()
    //  * @ORM\PreUpdate
    //  */
    // public function updateUts()
    // {
    //     $this->uts = new DateTime();
    // }


    // public function getUid(): ?string
    // {
    //     return $this->uid;
    // }

    // public function setUid(string $uid): self
    // {
    //     $this->uid = $uid;

    //     return $this;
    // }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

}
