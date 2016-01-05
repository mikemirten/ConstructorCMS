<?php

namespace App\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\CoreBundle\Entity\PageElement;

/**
 * ContentElement
 *
 * @ORM\Table(name="content_element")
 * @ORM\Entity()
 */
class ContentElement extends PageElement
{
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

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
	
	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'core.content';
	}
}

