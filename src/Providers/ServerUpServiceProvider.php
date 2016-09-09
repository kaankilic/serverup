<?php 
namespace Kaankilic\InstaPack\Providers;
use Illuminate\Support\ServiceProvider;
use Config;
class InstaPackServiceProvider extends ServiceProvider {
  protected $defer = false;

   /**
     * Bootstrap the application services.
     *
     * @return void
    */
  public function boot(\Illuminate\Routing\Router $router){
    $this->app['ServerUp'] = $this->app->share(function($app){
      return new ServerUp();
    });
  }
 
  /**
    * Register the application services.
    *
    * @return void
  */
  public function register(){
    return array('ServerUp');
  }
}