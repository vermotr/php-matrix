<?php

namespace vermotr\Math;

/**
 * Matrix Test Suite
 *
 * @author Romain Vermot <romain@vermot.eu>
 * @license MIT
 */
class MatrixTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructionWithArray()
    {
        $matrix = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);
        $this->assertTrue(true);

        for ($r = 0, $i = 1; $r < 3; $r++) {
            for ($c = 0; $c < 4; $c++, $i++) {
                $this->assertEquals($i, $matrix[$r][$c]);
            }
        }
    }

    public function testConstructionWithMatrix()
    {
        $m1 = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);
        $m2 = new Matrix($m1);

        $this->assertTrue(true);

        for ($r = 0, $i = 1; $r < 3; $r++) {
            for ($c = 0; $c < 4; $c++, $i++) {
                $this->assertEquals($i, $m2[$r][$c]);
            }
        }
    }

    public function testConstructionWithSize()
    {
        $matrix = new Matrix(1, 2);

        $this->assertTrue(true);
        $this->assertEquals(0, $matrix[0][0]);
        $this->assertEquals(0, $matrix[0][1]);
    }

    public function testBadConstruction()
    {
        try {
            $matrix = new Matrix(0, 42);
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');

        try {
            $matrix = new Matrix(42, 0);
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');

        try {
            $matrix = new Matrix("Yeah!");
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');
    }

    public function testAddMatrix()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [7, 8, 9],
            [10, 11, 12]
        ]);

        $added = $m1->add($m2);

        $result = new Matrix([
            [8, 10, 12],
            [14, 16, 18]
        ]);

        $this->assertTrue($added->equals($result));
    }

    public function testAddScalar()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $added = $matrix->add(42);

        $result = new Matrix([
            [43, 44, 45],
            [46, 47, 48]
        ]);

        $this->assertTrue($added->equals($result));
    }

    public function testAddException()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [7, 8],
            [9, 10],
            [11, 12]
        ]);

        try {
            $m1->add($m2);
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');
    }

    public function testSubtractMatrix()
    {
        $m1 = new Matrix([
            [7, 8, 9],
            [10, 11, 12],
        ]);

        $m2 = new Matrix([
            [2, 7, 5],
            [3, 1, 0]
        ]);

        $subtracted = $m1->subtract($m2);

        $result = new Matrix([
            [5, 1, 4],
            [7, 10, 12]
        ]);

        $this->assertTrue($subtracted->equals($result));
    }

    public function testSubtractScalar()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $subtracted = $matrix->subtract(2);

        $result = new Matrix([
            [-1, 0, 1],
            [2, 3, 4]
        ]);

        $this->assertTrue($subtracted->equals($result));
    }

    public function testSubtractException()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [7, 8],
            [9, 10],
            [11, 12]
        ]);

        try {
            $m1->subtract($m2);
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');
    }

    public function testMultiplyMatrix()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [7, 8],
            [9, 10],
            [11, 12]
        ]);

        $multiplied = $m1->multiply($m2);

        $result = new Matrix([
            [58, 64],
            [139, 154]
        ]);

        $this->assertTrue($multiplied->equals($result));
    }

    public function testMultiplyScalar()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $multiplied = $matrix->multiply(2);

        $result = new Matrix([
            [2, 4, 6],
            [8, 10, 12]
        ]);

        $this->assertTrue($multiplied->equals($result));
    }

    public function testMultiplyException()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [7, 8],
            [9, 10]
        ]);

        try {
            $m1->multiply($m2);
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');
    }

    public function testSubmatrix()
    {
        $matrix = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);

        $subMatrix = $matrix->submatrix(1, 2);

        $result = new Matrix([
            [1, 2, 4],
            [9, 10, 12]
        ]);

        $this->assertTrue($subMatrix->equals($result));
    }

    public function testDeterminant()
    {
        $matrix = new Matrix([
            [1, 4, 3],
            [4, 2, 2],
            [1, 2, 0]
        ]);

        $this->assertEquals(22, $matrix->determinant());
    }

    public function testDeterminantException()
    {
        $matrix = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);

        try {
            $matrix->determinant();
        } catch (MatrixException $exception) {
            return;
        }
        $this->fail('MatrixException not raised.');
    }

    public function testCofactor()
    {
        $matrix = new Matrix([
            [3, 0, 2],
            [2, 0, -2],
            [0, 1, 1]
        ]);

        $cofactored = $matrix->cofactor();

        $result = new Matrix([
            [2, -2, 2],
            [2, 3, -3],
            [0, 10, 0]
        ]);

        $this->assertTrue($cofactored->equals($result));
    }

    public function testTranspose()
    {
        $matrix = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);

        $transposed = $matrix->transpose();

        $result = new Matrix([
            [1, 5, 9],
            [2, 6, 10],
            [3, 7, 11],
            [4, 8, 12]
        ]);

        $this->assertTrue($transposed->equals($result));
    }

    public function testAdjugate()
    {
        $matrix = new Matrix([
            [3, 0, 2],
            [2, 0, -2],
            [0, 1, 1]
        ]);

        $adjugated = $matrix->adjugate();

        $result = new Matrix([
            [2, 2, 0],
            [-2, 3, 10],
            [2, -3, 0]
        ]);

        $this->assertTrue($adjugated->equals($result));
    }

    public function testInverse()
    {
        $matrix = new Matrix([
            [1, 0, 5],
            [2, 1, 6],
            [3, 4, 0]
        ]);

        $inverted = $matrix->inverse();

        $result = new Matrix([
            [-24, 20, -5],
            [18, -15, 4],
            [5, -4, 1]
        ]);

        $this->assertTrue($inverted->equals($result));
    }

    public function testToString()
    {
        $matrix = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $this->assertEquals("1\t2\t3\n4\t5\t6\n", (string)$matrix);
    }

    public function testSize()
    {
        $matrix = new Matrix([
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12]
        ]);

        $this->assertEquals(3, $matrix->getRows());
        $this->assertEquals(4, $matrix->getCols());
    }

    public function testEquals()
    {
        $m1 = new Matrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $m2 = new Matrix([
            [1, 2, 3],
            [4, 5, 42]
        ]);

        $this->assertTrue($m1->equals($m1));
        $this->assertFalse($m1->equals($m2));
    }
}
