<?php


/**
 * Das ist das Bootstrap-File des Plugins
 *
 * Class Shopware_Plugins_Frontend_NewRelicIntegration_Bootstrap
 */
class Shopware_Plugins_Frontend_NewRelicIntegration_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{


    /**
     * returns the label
     *
     * @return string
     */
    public function getLabel()
    {
        return 'NewRelicIntegration';
    }


    /**
     * returns the version
     *
     * @return string
     */
    public function getVersion()
    {
        return '0.1.0';
    }


    /**
     * includes the info of this plugin
     *
     * @return array|mixed
     */
    public function getInfo()
    {
        return include(dirname(__FILE__) . '/Meta.php');
    }


    /**
     * the install function of this plugin
     *
     * @return bool
     */
    public function install()
    {
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch',
            'onPostDispatch',
            100
        );

        return true;
    }


    public function onPostDispatch(Enlight_Controller_ActionEventArgs $args)
    {
        $request = $args->getSubject()->Request();
        $response = $args->getSubject()->Response();

        if (!$request->isDispatched() || $response->isException()) {
            return;
        }

        if (extension_loaded('newrelic')) {
            newrelic_name_transaction($request->getControllerName() . '/' . $request->getActionName());
        }
    }
}