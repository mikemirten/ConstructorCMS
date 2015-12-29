<?php

namespace App\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentElement
 *
 * @ORM\Table(name="content_element")
 * @ORM\Entity()
 */
class ContentElement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

	/**
	 * Set id
	 * 
	 * @param  string
	 * @return ContentElement
	 */
	public function setId($id)
	{
		$this->id = $id;
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
     * Set content
     *
     * @param  string $content
     * @return ContentElement
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

