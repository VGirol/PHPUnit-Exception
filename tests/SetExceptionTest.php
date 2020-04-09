<?php

declare(strict_types=1);

namespace VGirol\PhpunitException\Tests;

use PHPUnit\Framework\TestCase;
use VGirol\PhpunitException\SetExceptionsTrait;

class SetExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function setFailureWithMessage()
    {
        $class = 'Exception';
        $message = 'test';
        $code = 1;

        $mock = $this->getMockForTrait(SetExceptionsTrait::class);

        $mock->expects($this->once())
             ->method('expectException')
             ->with($class);

        $mock->expects($this->once())
             ->method('expectExceptionMessage')
             ->with($message);

        $mock->expects($this->once())
             ->method('expectExceptionCode')
             ->with($code);

        $mock->setFailure($class, $message, $code);
    }

    /**
     * @test
     */
    public function setFailureWithRegularExpression()
    {
        $class = 'Exception';
        $message = '/test/';
        $code = 1;

        $mock = $this->getMockForTrait(SetExceptionsTrait::class);

        $mock->expects($this->once())
             ->method('expectException')
             ->with($class);

        $mock->expects($this->once())
             ->method('expectExceptionMessageMatches')
             ->with($message);

        $mock->expects($this->once())
             ->method('expectExceptionCode')
             ->with($code);

        $mock->setFailure($class, $message, $code);
    }

    /**
     * @test
     */
    public function setFailureException()
    {
        $class = 'Exception';
        $message = 'test';
        $code = 1;

        $mock = $this->getMockForTrait(SetExceptionsTrait::class, [], '', true, true, true, ['setFailure']);

        $mock->expects($this->once())
             ->method('setFailure')
             ->with($class, $message, $code);

        $mock->setFailureException($class, $message, $code);
    }

    /**
     * @test
     */
    public function setFailureExceptionRegex()
    {
        $class = 'Exception';
        $message = '/test/';
        $code = 1;

        $mock = $this->getMockForTrait(SetExceptionsTrait::class, [], '', true, true, true, ['setFailure']);

        $mock->expects($this->once())
             ->method('setFailure')
             ->with($class, $message, $code);

        $mock->setFailureExceptionRegex($class, $message, $code);
    }

    /**
     * @test
     */
    public function formatAsRegex()
    {
        $message = 'A test string with asterix (*) and %s and %d.';
        $expected = '/A test string with asterix \(\*\) and .* and .*\./s';

        $mock = $this->getMockForTrait(SetExceptionsTrait::class, [], '', true, true, true, ['setFailure']);

        $result = $mock->formatAsRegex($message);

        $this->assertEquals($expected, $result);
    }
}
