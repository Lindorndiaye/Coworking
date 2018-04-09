<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        // api
        if ('/api' === $pathinfo) {
            return array (  '_controller' => 'App\\Controller\\ApiController::index',  '_route' => 'api',);
        }

        // app_api_postadd
        if ('/add' === $pathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\ApiController::postaddAction',  '_route' => 'app_api_postadd',);
            if (!in_array($requestMethod, array('POST'))) {
                $allow = array_merge($allow, array('POST'));
                goto not_app_api_postadd;
            }

            return $ret;
        }
        not_app_api_postadd:

        if (0 === strpos($pathinfo, '/bien')) {
            // app_api_getlist
            if ('/bien' === $pathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\ApiController::getListAction',  '_route' => 'app_api_getlist',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_app_api_getlist;
                }

                return $ret;
            }
            not_app_api_getlist:

            // app_api_getbien
            if ('/biens' === $pathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\ApiController::getBienAction',  '_route' => 'app_api_getbien',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_app_api_getbien;
                }

                return $ret;
            }
            not_app_api_getbien:

        }

        if ('/' === $pathinfo) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
