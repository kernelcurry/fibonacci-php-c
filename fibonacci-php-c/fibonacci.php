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
		echo exec(dirname(__FILE__).'/../fibonacci-c/bin/fibonacci '.$argv[1]);
	}
