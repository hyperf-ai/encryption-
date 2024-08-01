<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/encryption.
 *
 * @link     https://github.com/hyperf-ai/encryption
 * @contact  qiaohengshan@gmail.com
 * @license  https://github.com/hyperf-ai/encryption/blob/master/LICENSE
 */
namespace HyperfAi\Encryption\Contract;

interface SymmetricDriverInterface extends DriverInterface
{
    public function getKey(): string;

    public static function generateKey(array $options = []): string;
}
