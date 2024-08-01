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

interface EncryptionInterface extends DriverInterface
{
    /**
     * Get a driver instance.
     *
     * @return \HyperfAi\Encryption\Contract\DriverInterface
     */
    public function getDriver(?string $name = null): DriverInterface;
}
