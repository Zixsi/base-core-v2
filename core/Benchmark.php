<?
class Benchmark
{
	private $markers = [];

	public function __construct(){}

	public function mark($name)
	{
		$this->markers[$name] = microtime(true);
	}

	public function elapsedTime($mark1, $mark2, $decimails = 4)
	{
		if(isset($this->markers[$mark1]) && isset($this->markers[$mark2]))
		{
			return number_format($this->markers[$mark2] - $this->markers[$mark1], intval($decimails));
		}

		return null;
	}

	public function getMarkers()
	{
		return $this->markers;
	}
}