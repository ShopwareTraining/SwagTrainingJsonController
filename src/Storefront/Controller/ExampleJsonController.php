<?php declare(strict_types=1);

namespace SwagTraining\JsonController\Storefront\Controller;

use Psr\Container\ContainerInterface;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Routing\Annotation\Since;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class ExampleJsonController extends StorefrontController
{
    private SystemConfigService $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @Since("6.4.0.0")
     * @Route("/swag-training/json-controller", name="frontend.swag-training.json", methods={"GET"}, defaults={"XmlHttpRequest"=true})
     */
    public function getData(Request $request, Context $context): JsonResponse
    {
        $instance = $this->systemConfigService->get('SwagTrainingPluginConfig.config.instance');

        return new JsonResponse(
            [
                'instance' => $instance,
            ]);
    }

    /**
     * @required
     */
    public function setContainer(ContainerInterface $container): ?ContainerInterface
    {
        $previous = $this->container;
        $this->container = $container;

        return $previous;
    }
}
