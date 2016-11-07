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
		if (is_null($Hostname)) {
			$this->setHostname(config('serverup.hostname'));
		}else{
			$this->setHostname($Hostname);
		}
		if (is_null($Port)) {
			$this->setPort(config('serverup.port'));
		}else{
			$this->setPort($Port);
		}
		if (is_null($SampleAmount)) {
			$this->setSampleAmount(config('serverup.sample_amount'));
		}else{
			$this->setSampleAmount($TimeoutDuration);
		}

		if (is_null($TimeoutDuration)) {
			$this->setTimeoutDuration(config('serverup.timeout_duration'));
		}else{
			$this->setTimeoutDuration($TimeoutDuration);
		}
	}
	public function getHostname(){
		return $this->Hostname;
	}

	public function setHostname($Hostname){
		$SchemaExpression = '#^http://|https://#';
		if (preg_match($SchemaExpression, $Hostname) === 1) {
			$Hostname = preg_replace($SchemaExpression, "", $Hostname);
		}
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
	public function ping($Hostname=NULL,$Port=NULL) {
		if (!is_null($Hostname)) {
			$this->setHostname($Hostname);
		}
		if (!is_null($Port)) {
			$this->setPort($Port);
		}
		for ($i=0; $i < $this->getSampleAmount(); $i++) { 
			$tB = microtime(true); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
			curl_setopt($ch, CURLOPT_URL,$this->getHostname()); 
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$this->getTimeoutDuration()); 
			curl_setopt($ch, CURLOPT_TIMEOUT, $this->getTimeoutDuration()); //timeout in seconds			
			curl_exec($ch);
			$isUp = false;
			if(!curl_errno($ch)){
				$isUp = true;
			}
			$ch = curl_close($ch);
		 	$tA = microtime(true);
			$this->SocketResponses[] = new SocketResponse(round((($tA - $tB) * 1000), 0),$isUp);
	 	}
	 	$this->checkAvg();
	 	return $this->SocketResponses;
	}
}
?>
