<?php

namespace AppBundle\Service;

use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Block\BlockContextInterface;

/**
 * StatisticBlockService
 *
 * @author Artem Genvald  <genvaldartem@gmail.com>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class StatisticBlockService extends BaseBlockService
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'statistic';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());

        return $this->renderResponse(
            'backend/block_admin_list.html.twig',
            [
                'block'    => $blockContext->getBlock(),
                'settings' => $settings
            ],
            $response
        );
    }
}
