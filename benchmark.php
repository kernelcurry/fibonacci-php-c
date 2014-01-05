<?php

	// php only implementation
	function fibonacci_php($num)
	{
		// initialize variables
		$number = $num;
		$first = 0;
		$second = 1;
		$next = 0;
		$count = 0;

		// calculate fibonacci sequence Term
		while(bccomp($number,$count) != -1)
		{
			if ( $count <= 1 )
				$next = $count;
			else
			{
				$next = bcadd($first,$second);
				$first = $second;
				$second = $next;
			}

			$count++;
		}

		// output fibonacci term
		return $next;
	}

	// php and c implementation
	function fibonacci_php_c($num)
	{
		return exec(dirname(__FILE__).'/fibonacci-c/bin/fibonacci '.$num);
	}

	function toCSV($results,$title)
	{
		$csv =  '"'.$title.'"'."\n";
		$csv .= '"","CT","WT","CPU","MU","PMU"'."\n";
		foreach ($results as $key => $value)
		{
			$csv .= '"'.$key.'","'.$value['ct'].'","'.$value['wt'].'","'.$value['cpu'].'","'.$value['mu'].'","'.$value['pmu'].'"'."\n";
		}

		file_put_contents('total.csv', $csv, FILE_APPEND | LOCK_EX);
	}

	function toReport($results,$title)
	{
		//$csv = '"SIZE",FUNCTION","CT","WT","CPU","MU","PMU"'."\n";
		$csv = '';
		foreach ($results as $key => $value)
		{
			if ($key == "main()==>fibonacci_php" || $key == "main()==>fibonacci_php_c")
			{
				$csv .= '"'.$title.'","'.$key.'","'.$value['ct'].'","'.$value['wt'].'","'.$value['cpu'].'","'.$value['mu'].'","'.$value['pmu'].'"'."\n";
			}
		}

		file_put_contents('report.csv', $csv, FILE_APPEND | LOCK_EX);
	}

	// lets start benchmarking
	if ( ! isset($argv[1]))
	{
		echo 'must include a number as a argument.'."\n";
	}
	else
	{
		// start profiling
		xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

		fibonacci_php($argv[1]);
		fibonacci_php_c($argv[1]);

		// stop profiler
		$xhprof_data = xhprof_disable();

		toCSV($xhprof_data, $argv[1]);
		toReport($xhprof_data, $argv[1]);
	}