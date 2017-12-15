<?php
namespace Abiodunjames\Prodigypdf;

use DOMPDF;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @throws \Exception
     * @return void
     */

    public function boot()
    {

        $configPath = __DIR__ . '/Config/dompdf.php';
        $this->publishes([$configPath => config_path('dompdf.php')], 'config');

    }

    public function register()
    {
        $configPath = __DIR__ . '/Config/dompdf.php';
        $this->mergeConfigFrom($configPath, 'dompdf');
        $this->loadViewsFrom(__DIR__ . '/Views','prodigypdf');


        $this->requireDomPdfPackageConfig();

        $this->defineDomPdfOptions();


        $this->app->bind('dompdf', function () {
            $dompdf = new DOMPDF();
            $dompdf->set_base_path(public_path());
            return $dompdf;
        });


        $this->app->alias('dompdf', DOMPDF::class);

        $this->app->bind('prodigypdf', function ($app) {
            return new PDF($app['dompdf'], $app['config'], $app['files'], $app['view']);
        });

    }

    /**
     * @return void
     */
    private function defineDomPdfOptions()
    {
        $defines = $this->app['config']->get('dompdf.defines');
        if ($defines) {
            foreach ($defines as $key => $value) {
                $this->define($key, $value);
            }
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function requireDomPdfPackageConfig()
    {
        $config_file = $this->app['config']->get('dompdf.config_file') ?: $this->app['path.base'] . '/vendor/dompdf/dompdf/dompdf_config.inc.php';
        if (file_exists($config_file)) {
            require_once $config_file;
            return;
        }
        throw  new \Exception("Unable to include package config files");
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('dompdf', 'prodigypdf', 'dompdf.options');
    }

    /**
     * Define a value, if not already defined
     *
     * @param string $name
     * @param string $value
     */
    protected function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

}
