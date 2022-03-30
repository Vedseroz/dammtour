<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*******************
	*  Array_Columns  *
	*******************
	
	input:
		$data = array(
			array(
				'title' => 'My title 1',
				'name'  => 'My Name 1',
				'date'  => 'My date 1'
			),
			array(
				'title' => 'My title 2',
				'name'  => 'My Name 2',
				'date'  => 'My date 2'
			),
			array(
				'title' => 'My title 3',
				'name'  => 'My Name 3',
				'date'  => 'My date 3'
			)
		);
		
		$columns_key = array('title', 'name');
		
		$index_key = array('title' => 'date');
		
	output:
		Case 1:
			array_columns($data, $columns_key);
			
			Array
			(
			    [0] => Array
			        (
			            [My date 1] => My title 1
			            [0] => My Name 1
			        )
			
			    [1] => Array
			        (
			            [My date 2] => My title 2
			            [0] => My Name 2
			        )
			
			    [2] => Array
			        (
			            [My date 3] => My title 3
			            [0] => My Name 3
			        )
			
			)
		
		Case 2:
			array_columns($data, $columns_key, $index_key);
			
			Array
			(
			    [0] => Array
			        (
			            [My date 1] => My title 1
			            [0] => My Name 1
			        )
			
			    [1] => Array
			        (
			            [My date 2] => My title 2
			            [0] => My Name 2
			        )
			
			    [2] => Array
			        (
			            [My date 3] => My title 3
			            [0] => My Name 3
			        )
			
			)
*/
if ( ! function_exists('array_columns'))
{
	function array_columns($array = array(), $columns_key = array(), $index_key = array())
	{
		if(empty($array) or empty($columns_key)) {
			return $array;
		}
		
		$new_array = array();
		foreach($array as $row) {
			$new_row = array();
			foreach($columns_key as $column_key) {
				if(array_key_exists($column_key, $index_key)) {
					$new_row[($index_key[$column_key] === $column_key) ? $column_key : $row[$index_key[$column_key]]] = $row[$column_key];
				} else {
					$new_row[] = $row[$column_key];
				}
			}
			$new_array[] = $new_row;
		}
		
		return $new_array;
	}
}


if ( ! function_exists('array_flatten'))
{
	function array_flatten($array) { 
	  if (!is_array($array)) { 
	    return FALSE; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
	    if (is_array($value)) { 
	      $result = array_merge($result, array_flatten($value)); 
	    } 
	    else { 
	      $result[$key] = $value; 
	    } 
	  } 
	  return $result; 
	}
}