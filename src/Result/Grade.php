<?php

namespace WebChemistry\Fmp\Result;

enum Grade: string
{

	case Buy = 'Buy';
	case Sell = 'Sell';
	case Hold = 'Hold';
	case StrongBuy = 'Strong Buy';
	case StrongSell = 'Strong Sell';

}
