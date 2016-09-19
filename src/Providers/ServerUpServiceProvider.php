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
   $this->app->bind('ServerUp', 'Kaankilic\ServerUp\Libraries\ServerUp' );
   $this->publishes([
      __DIR__.'/../../config/serverup.php' => base_path('config/serverup.php')
    ]);
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