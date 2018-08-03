<?php
/*A recursive function that returns the determinant of a matrix
Raises an exception if the matrix is not square.
*/
function determinant($matrix){
	$dim = count($matrix);
	for($i=0;$i<$dim;$i++){
		if(count($matrix[$i]) != $dim){
			throw new Exception("The matrix is not square");
		}
	}
	
	return real_determinant($matrix);
}

function real_determinant($matrix){
	$dim = count($matrix);
	$total = 0;
	if($dim == 1){
		return $matrix[0][0];
	}
	else if($dim == 2){
		return ($matrix[0][0]*$matrix[1][1]) -  ($matrix[1][0]*$matrix[0][1]);
	}
	else{
		$det = 0;
		for($i=0;$i<$dim;$i++){
			$coeff = $matrix[$i][0];
			$tmp = Array();
			for($j=0; $j<$dim; $j++){
				if($j != $i){
					$a = $matrix[$j];
					array_shift($a);
					array_push($tmp, $a);
				}
			}
			$det += ((-1)**($i))*$coeff*determinant($tmp);
		}
		return $det;
	}
}

/*A function that receives as input a matrix and returns the transpose of that matrix*/
function transpose($matrix){
	$trans = Array();
	for($i=0; $i<count($matrix[0]); $i++){
		$row = Array();
		for($j=0; $j<count($matrix); $j++){
			array_push($row, $matrix[$j][$i]);
		}
		array_push($trans, $row);
	}
	return $trans;
}

function matrix_product($m1, $m2){
	$n_rows_m1 = count($m1);
	if(is_array($m1[0])){
		$n_cols_m1 = count($m1[0]);
	}
	else{
		$n_cols_m1 = 1;
	}

	$n_rows_m2 = count($m2);
	if(is_array($m2[0])){
		$n_cols_m2 = count($m2[0]);
	}
	else{
		$n_cols_m2 = 1;
	}	

	if($n_cols_m1 != $n_rows_m2){
		throw new Exception("You cannot multiply these two matrices");
	}
		
	$res = Array();
	for($i=0;$i<$n_rows_m1;$i++){
		$row = Array();
		for($j=0;$j<$n_cols_m2; $j++){
			$sum = 0;
			for($k=0;$k<$n_cols_m1; $k++){
				if(is_array($m1[$i]) && is_array($m2[$k])){
					$sum += $m1[$i][$k]*$m2[$k][$j];
				}
				else if(is_array($m1[$i])){
					$sum += $m1[$i][$k]*$m2[$k];
				}
				else if(is_array($m2[$k])){
					$sum += $m1[$i]*$m2[$k][$j];
				}
			}	
			array_push($row, $sum);
		}
		array_push($res, $row);
	}
	
	return $res;
}

/*A function that given a matrix, a row and a column, returns the cofactor for that element*/
function cofactor($matrix, $row, $col){
	$tmp = $matrix;
	$rows = count($matrix);
	for($i=0; $i<$rows; $i++){
		array_splice($tmp[$i], $col, 1);
	}
	array_splice($tmp, $row, 1);
	return determinant($tmp);
}

/*A function that receives a matrix as parameters and returns the inverse of that matrix. Can 
raise an exception if the determinant is equal to 0*/
function inverse($matrix){
	$det = determinant($matrix);
	if($det == 0){
		throw new Exception("Determinant is equal to 0, the inverse matrix does not exists");
	}
	$rows = count($matrix);
	$cols = count($matrix[0]);
	$cm = Array();
	for($i=0;$i<$rows;$i++){
		$row = Array();
		for($j=0;$j<$cols;$j++){
			array_push($row, ((-1)**($i+$j))*cofactor($matrix, $i, $j));
		}
		array_push($cm, $row);
	}
	
	$cmt = transpose($cm);
	for($i=0;$i<$cols;$i++){
		for($j=0;$j<$rows;$j++){
			$cmt[$i][$j] /= $det;
		}
	}
	
	return $cmt;
}

?>