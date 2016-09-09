<?php 
namespace Kaankilic\ServerUp\Libraries;
class SocketResponse{
	protected $AvailibilityTime;
	protected $isUp;
	public function __construct($AvailibilityTime=NULL,$isUp=NULL){
		$this->setAvailibilityTime($AvailibilityTime);
		$this->setIsUp($isUp);
	}
	public function getAvailibilityTime(){
		return $this->AvailibilityTime;
	}

	public function setAvailibilityTime($AvailibilityTime){
		$this->AvailibilityTime = $AvailibilityTime;
	}

	public function getIsUp(){
		return $this->isUp;
	}

	public function setIsUp($isUp){
		$this->isUp = $isUp;
	}
	public function __toString(){
		return $this->getAvailibilityTime()." ms - ".$this->getPort();
	}
}
?>