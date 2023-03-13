<?php

namespace Dolyame\Payment;

class Helper
{
	static function getMeasureCode($basketItem)
	{
		$measure = $basketItem->getField('MEASURE_CODE');
		return MeasureCodeToStringMapper::getStringValue($measure);
	}
}