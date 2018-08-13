<?

class Profiler
{
	public function __construct(){}

	public function show()
	{
		$kernel = &get_instance();
		$profile = [];
		$markers = $kernel->Benchmark->getMarkers();

		foreach($markers as $key => $val)
		{
			if(preg_match('/(.+?)_end$/i', $key, $match) && isset($markers[$match[1].'_end'], $markers[$match[1].'_start']))
			{
				$profile[$match[1]] = $kernel->Benchmark->elapsedTime($match[1].'_start', $key);
			}
		}

		$result = '<div style="position: relative; z-index: 9999; background-color: #fff; padding: 20px;">';
		$result .= "\n\n"
			.'<fieldset id="ci_profiler_benchmarks" style="border:1px solid #900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			."\n"
			.'<legend style="color:#900;">&nbsp;&nbsp; Benchmarks &nbsp;&nbsp;</legend>'
			."\n\n\n<table style=\"width:100%;\">\n";

		foreach($profile as $key => $val)
		{
			$key = ucwords(str_replace(array('_', '-'), ' ', $key));
			$result .= '<tr><td style="padding:5px;width:50%;color:#000;font-weight:bold;background-color:#ddd;">'
					.$key.'&nbsp;&nbsp;</td><td style="padding:5px;width:50%;color:#900;font-weight:normal;background-color:#ddd;">'
					.$val."</td></tr>\n";
		}

	 	$result .= "</table>\n</fieldset>";
		$result .= '</div>';

		return $result;
	}
}