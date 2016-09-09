<?php 
namespace Kaankilic\ServerUp\Libraries;
use Illuminate\Support\Collection;

class ServerUp{
	protected $Hostname;
	protected $Port;
	protected $TimeoutDuration;
	protected $SampleAmount;

	protected $SocketResponses = array();
	protected $AvgDuration;
	protected $isTotalyAvail;
	const DEFAULT_SAMPLE_AMOUNT=10;
	const DEFAULT_TIMEOUT_DURATION=10;

	public function __construct($Hostname=NULL,$Port=NULL,$SampleAmount=NULL,$TimeoutDuration=NULL){
		$this->setHostname($Hostname);
		$this->setPort($Port);
		if (is_null($SampleAmount)) {
			$this->setSampleAmount(self::DEFAULT_SAMPLE_AMOUNT);
		}else{
			$this->setSampleAmount($TimeoutDuration);
		}

		if (is_null($TimeoutDuration)) {
			$this->setTimeoutDuration(self::DEFAULT_TIMEOUT_DURATION);
		}else{
			$this->setTimeoutDuration($TimeoutDuration);
		}
	}
	public function getHostname(){
		return $this->Hostname;
	}

	public function setHostname($Hostname){
		$this->Hostname = $Hostname;
	}

	public function getPort(){
		return $this->Port;
	}

	public function setPort($Port){
		$this->Port = $Port;
	}

	public function getTimeoutDuration(){
		return $this->TimeoutDuration;
	}

	public function setTimeoutDuration($TimeoutDuration){
		$this->TimeoutDuration = $TimeoutDuration;
	}
	public function getSampleAmount(){
		return $this->SampleAmount;
	}

	public function setSampleAmount($SampleAmount){
		$this->SampleAmount = $SampleAmount;
	}
	public function getIsTotalyAvail(){
		return $this->isTotalyAvail;
	}
	public function setIsTotalyAvail($isAvailable){
		$this->isTotalyAvail = $isAvailable;
	}
	public function checkAvg(){
		$this->AvgDuration = 0;
		$TotalLoad = 0;
		$this->setIsTotalyAvail(true);
		foreach ($this->SocketResponses as $key => $value) {
			$TotalLoad += $value->getAvailibilityTime();
			if ($value->getIsUp()==false) {
				$this->setIsTotalyAvail(false);
			}

		}
		$this->AvgDuration = 0;
		if ($TotalLoad!=0) {
			$this->AvgDuration = $TotalLoad/$this->getSampleAmount();
		}
		return $this->AvgDuration;
	}
	function ping() {
		for ($i=0; $i < $this->getSampleAmount(); $i++) { 
			$tB = microtime(true); 
			$fP = @fSockOpen($this->getHostname(), $this->getPort(), $errno, $errstr, $this->getTimeoutDuration());
			$isUp = true;
			if (!$fP) { 
				$isUp = false;
			} 
		 	$tA = microtime(true);
			$this->SocketResponses[] = new SocketResponse(round((($tA - $tB) * 1000), 0),$isUp);
	 	}
	 	return $this->SocketResponses;
	}
}
?>