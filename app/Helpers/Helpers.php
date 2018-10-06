<?php

namespace App\Helpers;

class Helpers {

	public static function stepForm()
	{
		$step_form = [
            [
                'link' => 'customer',
                'name' => 'ข้อมูลลูกค้า',
            ], [
                'link' => 'service',
                'name' => 'เลือกประเภทบริการ/เทคโนโลยี',
            ], [
                'link' => 'technology',
                'name' => 'กรอกรายละเอียด',
            ], [
                'link' => 'draft',
                'name' => 'Draft Solution',
            ],
        ];
		return $step_form;
	}	
}
