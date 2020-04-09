<?php
namespace VGirol\PhpunitException\Tests;

use VGirol\PhpunitException\Exception\InvalidArgumentException;
use VGirol\PhpunitException\Exception\InvalidArgumentHelper;
use VGirol\PhpunitException\SetExceptionsTrait;

class InvalidArgumentHelperTest extends TestCase
{
    /**
     * @test
     */
    public function message()
    {
        $arg = 3;
        $type = 'string';
        $value = null;
        $expected = '/' . \sprintf(
            preg_quote(InvalidArgumentException::MESSAGE),
            $arg,
            preg_quote(' (No Value)'),
            '.*',
            '.*',
            $type
        ) . '/';

        $message = InvalidArgumentHelper::message($arg, $type, $value);

        $this->assertMatchesRegularExpression($expected, $message);
    }

    /**
     * @test
     * @dataProvider messageRegexProvider
     */
    public function messageRegex($type, $value, $expectedType, $expectedValue)
    {
        $arg = 3;
        $expected = '/' . \sprintf(
            preg_quote(InvalidArgumentException::MESSAGE),
            $arg,
            $expectedValue,
            '.*',
            '.*',
            $expectedType
        ) . '/';

        $message = InvalidArgumentHelper::messageRegex($arg, $type, $value);

        $this->assertEquals($expected, $message);
    }

    public function messageRegexProvider()
    {
        return [
            'with value' => [
                'string',
                666,
                'string',
                preg_quote(' (' . \gettype(666) . '#' . 666 . ')')
            ],
            'without value' => [
                'string',
                null,
                'string',
                '[\s\S]*'
            ],
            'expected type with special characters' => [
                'string:test',
                null,
                preg_quote('string:test'),
                '[\s\S]*'
            ]
        ];
    }

    /**
     * @test
     */
    public function factory()
    {
        $arg = 3;
        $type = 'string';
        $value = 666;
        $expected = '/' . \sprintf(
            preg_quote(InvalidArgumentException::MESSAGE),
            $arg,
            preg_quote(' (' . \gettype($value) . '#' . $value . ')'),
            '.*',
            '.*',
            $type
        ) . '/';

        $e = InvalidArgumentHelper::factory($arg, $type, $value);

        $this->assertEquals(1, preg_match($expected, $e->getMessage()));
    }

    /**
     * @test
     */
    public function setInvalidArgumentException()
    {
        $arg = 3;
        $type = 'string';
        $value = 666;

        $mock = $this->getMockForTrait(SetExceptionsTrait::class);

        $mock->expects($this->once())
             ->method('expectException')
             ->with(InvalidArgumentException::class);

        $mock->expects($this->once())
             ->method('expectExceptionMessageMatches')
             ->with(InvalidArgumentHelper::messageRegex($arg, $type, $value));

        $mock->setInvalidArgumentException($arg, $type, $value);
    }
}
