<?php

namespace Ajrockr\Ajfusion;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class AjFusionBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $userMappings = [
            realpath(__DIR__ . '/../config/doctrine/User') => 'Ajfusion\User\Entity',
        ];

        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['DoctrineBundle'])) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($userMappings, enabledParameter: 'ajfusion_user_enabled'));
        }
    }
}