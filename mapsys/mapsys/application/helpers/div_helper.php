<?php

 
function div( $a, $b ){
	if( $b==0 )
	{	
		throw new SoapFault(-1,"不能为0");
	}
	return $a/$b;
}