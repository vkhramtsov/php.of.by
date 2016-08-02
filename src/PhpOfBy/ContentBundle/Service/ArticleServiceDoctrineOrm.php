<?php

namespace PhpOfBy\ContentBundle\Service;

use PhpOfBy\ContentBundle\Entity\ArticleRepository;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;

class ArticleServiceDoctrineOrm implements ArticleServiceInterface
{
    const ENTITY_NAME = 'PhpOfByContentBundle:Article';

    /** @var ArticleRepository */
    private $entityManager;

    /**
     * @param DoctrineRegistry $registry
     */
    public function __construct(DoctrineRegistry $registry)
    {
        $this->entityManager = $registry->getManager()->getRepository(self::ENTITY_NAME);
    }
}
