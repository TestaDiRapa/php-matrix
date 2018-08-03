# php-matrix
A library of functions written in PHP to handle matrices.

## Getting Started
To use the library download the phpmatrix.php file and import it in your project.

## Matrices and Vectors
A matrix is just a vector of vectors:
```
$matrix = Array(Array(1,2,3),Array(4,5,6));
```		  
is the matrix |1 2 3| 
              |4 5 6|

so each of the inner vector represents a row and each of their elements a column.
This library (as for now) is limited to the matrices management, so you have to create them yourself.
A 1-column, n-rows matrix is just a vector:
```
$matrix1n = Array(1,2,3);
```	
represents the column vector |1|
                             |2|
							 |3|

In the same way a n-columns, 1-row vector is a vector that contains a single vector of n elements:
```
$matrixn1 = Array(Array(1,2,3));
```	
represents the matrix |1 2 3|.

## Functions
The functions in the library are:
	* determinant
	* transpose
	* matrix_product
	* cofactor
	* inverse
	
## Version
V1.0 

## Authors
* **Vincenzo Pierro** - [DevThis](http://www.devthis.it/)