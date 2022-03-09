<?php namespace Mocono\Enums;

class Boolean {
	const ACTIVE  = 1;
	const DISABLE = 0;
	const YES  = 'yes';
	const NO = 'no';
	
	const STATUS =[
		self::ACTIVE => 'Active',
		self::DISABLE => 'DeActive',
		self::YES => 'Active',
		self::NO => 'DeActive',
	];
}
