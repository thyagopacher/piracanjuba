<?php
 class FuriousChecker 
	{
		static function determineType( $v )
		{
			if(self::isBoolean( $v ))
			{
				return "BOOLEAN";
			}
			if(self::isArray( $v ))
			{
				return "ARRAY";
			}
			if(self::isFloat( $v ))
			{
				return "FLOAT";
			}
			if(self::isInteger( $v ))
			{
				return "INTEGER";
			}
			if(self::isObject( $v ))
			{
				return "OBJECT";
			}
			if(self::isString( $v ))
			{
				return "STRING";
			}
		}
		static function isBoolean( $v )
		{
			if(is_bool( $v ))
			{
				return true;
			}
			return false;
		}
		static function isArray( $v )
		{
			if(is_array( $v ))
			{
				return true;
			}
			return false;
		}
		static function isFloat( $v )
		{
			if(is_float( $v ))
			{
				return true;
			}
			return false;
		}
		static function isInteger ( $v )
		{
			if(is_int( $v ))
			{
				return true;
			}
			return false;
		}
		static function isObject( $v )
		{
			if(is_object( $v ))
			{
				return true;
			}
			return false;
		}
		static function isString ( $v )
		{
			if(is_string( $v ))
			{
				return true;
			}
			return false;
		}
	}
?>