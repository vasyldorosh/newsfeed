<?php
namespace App\Services\Parser;

class ParserFactory
{	
	public static function build($type)
    {
        $class = '\\App\\Services\\Parser\\Resources\\' . ucfirst($type);

        if (class_exists($class)) {
            return new $class;
        } else {
            throw new \Exception('Parser type error');
        }
    }		
}