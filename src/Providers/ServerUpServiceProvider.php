<?php 
namespace Kaankilic\ServerUp\Providers;
use Illuminate\Support\ServiceProvider;
class ServerUpServiceProvider extends ServiceProvider {
  protected $defer = false;

   /**
     * Bootstrap the application services.
     *
     * @return void
    */
  public function boot(\Illuminate\Routing\Router $router){
   $this->app->bind('ServerUp', 'Kaankilic\ServerUp\Facades\ServerUp' );
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