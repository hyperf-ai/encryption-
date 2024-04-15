<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ai/encryption.
 *
 * @link     https://github.com/hyperf-ai/encryption
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ai/encryption/blob/master/LICENSE
 */
namespace HyperfAi\Encryption\Contract;

interface DriverInterface
{
    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     *
     * @throws \HyperfAi\Encryption\Exception\EncryptException
     */
    public function encrypt($value, bool $serialize = true): string;

    /**
     * Decrypt the given value.
     *
     * @throws \HyperfExt\Encryption\Exception\DecryptException
     * @return mixed
     */
    public function decrypt(string $payload, bool $unserialize = true);
}
