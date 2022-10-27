<?php


namespace App;


class Module
{
    protected $loadedModules;

    public function loadModules ($modules, $defaultRoutes) {
        $this->loadedModules = $modules;
        $routes = isset($defaultRoutes) ? ['app'=> $defaultRoutes] : [];
        foreach ($modules as $module) {
            $module_config = $this->getModuleConfig($module);
            $routes = array_merge_recursive($routes, [strtolower($module) =>$module_config['routes']]);
        }

        return $routes;

    }

    public function getModuleConfig($name) {
        return include 'modules/src/'.$name.'/module.config.php';
    }
}