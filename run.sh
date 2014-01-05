#!/bin/bash
i="0"

while [ $i -le 100000 ]
	do
		for k in {1..4}
			do
				php ./benchmark.php $i
				echo "$k : $i"
		done
		i=$[$i+1000]
done
