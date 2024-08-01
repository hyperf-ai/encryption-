<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/encryption.
 *
 * @link     https://github.com/hyperf-ext/encryption
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/encryption/blob/master/LICENSE
 */
namespace HyperfAi\Encryption;

use Hyperf\Contract\ConfigInterface;
use HyperfAi\Encryption\Contract\DriverInterface;
use HyperfAi\Encryption\Contract\EncryptionInterface;
use HyperfExt\Encryption\Driver\AesDriver;
use InvalidArgumentException;
use function Hyperf\Support\make;
class EncryptionManager implements EncryptionInterface
{
    /**
     * The config instance.
     *
     * @var \Hyperf\Contract\ConfigInterface
     */
    protected $config;

    /**
     * The array of created "drivers".
     *
     * @var \HyperfExt\Encryption\Contract\DriverInterface[]
     */
    protected $drivers = [];

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function encrypt($value, bool $serialize = true): string
    {
        return $this->getDriver()->encrypt($value, $serialize);
    }

    public function decrypt(string $payload, bool $unserialize = true)
    {
        return $this->getDriver()->decrypt($payload, $unserialize);
    }

    /**
     * Get a driver instance.
     *
     * @return \HyperfExt\Encryption\Contract\AsymmetricDriverInterface|\HyperfExt\Encryption\Contract\SymmetricDriverInterface
     */
    public function getDriver(?string $name = null): DriverInterface
    {
        if (isset($this->drivers[$name]) && $this->drivers[$name] instanceof DriverInterface) {
            return $this->drivers[$name];
        }

        $name = $name ?: $this->config->get('encryption.default', 'aes');

        $config = $this->config->get("encryption.driver.{$name}");
        if (empty($config) or empty($config['class'])) {
            throw new InvalidArgumentException(sprintf('The encryption driver config %s is invalid.', $name));
        }

        $driverClass = $config['class'] ?? AesDriver::class;

        $driver = make($driverClass, ['options' => $config['options'] ?? []]);

        return $this->drivers[$name] = $driver;
    }
}
