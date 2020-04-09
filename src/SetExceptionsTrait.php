<?php

declare(strict_types=1);

namespace VGirol\PhpunitException;

use VGirol\PhpunitException\Exception\InvalidArgumentException;
use VGirol\PhpunitException\Exception\InvalidArgumentHelper;

/**
 * Some helpers for testing
 */
trait SetExceptionsTrait
{
    /**
     * Set the class name of the expected exception
     *
     * @see \PHPUnit\Framework\TestCase::expectException
     *
     * @param string $exception
     *
     * @return void
     */
    abstract public function expectException(string $exception): void;

    /**
     * Set the message of the expected exception
     *
     * @see \PHPUnit\Framework\TestCase::expectExceptionMessage
     *
     * @param string $message
     *
     * @return void
     */
    abstract public function expectExceptionMessage(string $message): void;

    /**
     * Set the a regular expression for the message of the expected exception
     *
     * @see \PHPUnit\Framework\TestCase::expectExceptionMessageMatches
     *
     * @param string $messageRegExp
     *
     * @return void
     */
    abstract public function expectExceptionMessageMatches(string $messageRegExp): void;

    /**
     * Set the code of the expected exception
     *
     * @see \PHPUnit\Framework\TestCase::expectExceptionCode
     *
     * @param int|string $code
     *
     * @return void
     */
    abstract public function expectExceptionCode($code): void;

    /**
     * Set the expected exception and message when defining a test that will fail.
     *
     * @param string          $className
     * @param string|null     $message The failure message could be either a string or a regular expression.
     * @param int|string|null $code
     *
     * @return void
     */
    public function setFailure(string $className, ?string $message = null, $code = null): void
    {
        $this->expectException($className);
        if ($message !== null) {
            $this->setExpectedMessage($message);
        }
        if ($code !== null) {
            $this->expectExceptionCode($code);
        }
    }

    /**
     * Set the expected exception and message when defining a test that will fail.
     *
     * @param string          $className
     * @param string|null     $message
     * @param int|string|null $code
     *
     * @return void
     */
    public function setFailureException(string $className, ?string $message = null, $code = null): void
    {
        $this->setFailure($className, $message, $code);
    }

    /**
     * Set the expected exception and message when defining a test that will fail.
     *
     * @param string|null $message
     *
     * @return void
     */
    public function setFailureExceptionRegex(string $className, ?string $message = null, $code = null): void
    {
        $this->setFailure($className, $message, $code);
    }

    /**
     * Set the expected exception and message when testing a call with invalid arguments to a method.
     *
     * @param integer $arg
     * @param string  $type
     * @param mixed   $value
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function setInvalidArgumentException(int $arg, string $type, $value = null): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches(InvalidArgumentHelper::messageRegex($arg, $type, $value));
    }

    /**
     * Format the failure message as a regular expression.
     *
     * @param string $message A format string used by the sprintf function
     *
     * @return string
     */
    public function formatAsRegex(string $message): string
    {
        return '/' . preg_replace(
            "!\%(\+?)('.|[0 ]|)(-?)([1-9][0-9]*|)(\.[1-9][0-9]*|)([%a-zA-Z])!u",
            '.*',
            preg_quote($message)
        ) . '/s';
    }

    /**
     * Set the message of the expected exception.
     *
     * @param string $message
     *
     * @return void
     */
    private function setExpectedMessage(string $message): void
    {
        $method = (strpos($message, '/') === 0) ? 'expectExceptionMessageMatches' : 'expectExceptionMessage';
        $this->{$method}($message);
    }
}
