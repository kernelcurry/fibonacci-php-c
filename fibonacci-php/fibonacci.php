<?php
	/*
	 * Fibonacci Sequence Term Finder
	 * Author: Michael Curry
	 * Twitter: @kernelcurry
	 * website: http://kernelcurry.com
	 */

	if ( ! isset($argv[1]))
	{
		echo 'must include a number as a argument.';
	}
	else
	{
		// initialize variables
		$number = $argv[1];
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
		echo $next;
	}