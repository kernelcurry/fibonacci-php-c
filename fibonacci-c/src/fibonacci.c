/*
 * Fibonacci Sequence Term Finder
 * Author: Michael Curry
 * Twitter: @kernelcurry
 * website: http://kernelcurry.com
 */

#include <stdio.h>
#include <stdlib.h>
#include <gmp.h>

int main( int argc, char *argv[] )
{
	if ( argc != 2 ) /* argument count should be 2 */
	{
		printf( "usage: %s <integer> \n", argv[0] );
	}
	else
	{
		// initialize variables
		mpz_t one, number, count, first, second, next;
		mpz_init(one);
		mpz_init(number);
		mpz_init(count);
		mpz_init(first);
		mpz_init(second);
		mpz_init(next);
		mpz_set_si(one, 1);
		mpz_set_si(second, 1);
		mpz_set_str(number,argv[1],10);

		// calculate fibonacci sequence Term
		while(mpz_cmpabs(number, count) > -1)
		{
			if ( mpz_get_si(count) <= 1 )
				mpz_set(next, count);
			else
			{
				mpz_add(next, first ,second);
				mpz_set(first, second);
				mpz_set(second, next);
			}
			mpz_add(count,count,one);
		}

		// output fibonacci term
		char * str = mpz_get_str(NULL,10,next);
		printf("%s\n",str);

		// clear variables
		mpz_clear(one);
		mpz_clear(number);
		mpz_clear(count);
		mpz_clear(first);
		mpz_clear(second);
		mpz_clear(next);
	}
	return 0;
}

