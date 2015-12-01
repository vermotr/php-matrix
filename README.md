# Matrix
Matrix basic implementation.

## Installation

```
composer require vermotr/php-matrix:0.1.0
```

Alternatively you can add the following to the require section of your `composer.json` manually:
```
"vermotr/php-matrix": "0.1.0"
```

## Usage

There are three ways to instantiate a matrix:
```php
use vermotr\Math\Matrix;

// Create a Matrix with its size
$matrix = new Matrix(4, 2);

// With a bi-dimensional array
$matrix = new Matrix([
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8]
]);

// With another Matrix
$matrix = new Matrix($anotherMatrix);
```

You can access each element like a bi-dimensional array and display the matrix like so:
```
$matrix[4][2] = 42;

echo $matrix;
```

To know the matrix' size, you have access to two getters:
```php
$matrix->getRows();
$matrix->getCols();
```

In this class, you will find basic operations: add, subtract and multiply (by scalars and Matrices):

```php
$addedScalar = $matrix->add(4);
$addedMatrix = $matrix->add($anotherMatrix);
$subtractedScalar = $matrix->subtract(2);
$subtractedMatrix = $matrix->subtract($anotherMatrix);
$multipliedByScalar = $matrix->multiply(2);
$multipliedByMatrix = $matrix->multiply($anotherMatrix);
```

You can also compare two matrices with the `equals` method:
```php
if ($matrix1->equals($matrix2)) {
    // Do something!
}
```

There are some useful methods implemented in this class:

```php
$matrix->adjugate();
$matrix->cofactor();
$matrix->determinant();
$matrix->inverse();
$matrix->subMatrix();
$matrix->transpose();
```

# Changelog

- 0.1.0
    - Created the Matrix type
    - Scalar Addition
    - Matrix Addition
    - Scalar Subtraction
    - Matrix Subtraction
    - Scalar Multiplication
    - Matrix Multiplication
    - Adjugate
    - Cofactor
    - Determinant
    - Inverse
    - Submatrix
    - Transpose
