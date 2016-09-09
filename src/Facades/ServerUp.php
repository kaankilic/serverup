<?php
namespace Kaankilic\ServerUp\Facades;
use Illuminate\Support\Facades\Facade;
 
class ServerUp extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { 
  	return 'ServerUp'; 
  }
 
}