<?php declare(strict_types=1);

namespace paveldanilin\PhpUtil;

class Hashtable implements \IteratorAggregate, \Countable, \ArrayAccess
{
    protected $table;
    protected $keyPathDelimiter;

    /**
     * @param array<string, mixed> $table Key-Value
     * @param string $keyPathDelimiter
     */
    public function __construct(array $table = [], string $keyPathDelimiter = '.')
    {
        $this->table = $table;
        $this->keyPathDelimiter = $keyPathDelimiter;
    }

    /**
     * @param array<string, mixed> $table
     * @param string $keyPathDelimiter
     * @return Hashtable
     */
    public static function create(array $table = [], string $keyPathDelimiter = '.'): Hashtable
    {
        return new Hashtable($table, $keyPathDelimiter);
    }

    public function all(): array
    {
        return $this->table;
    }

    public function keys(): array
    {
        return \array_keys($this->table);
    }

    /**
     * @param array<string, mixed> $table
     * @return $this
     */
    public function replace(array $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array<string, mixed> $table
     * @return $this
     */
    public function add(array $table): self
    {
        $this->table = \array_replace($this->table, $table);
        return $this;
    }

    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->table[$key] : $default;
    }

    public function set(string $key, $value): self
    {
        $this->table[$key] = $value;
        return $this;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->table);
    }

    public function remove(string $key): self
    {
        unset($this->table[$key]);
        return $this;
    }

    public function getAlpha(string $key, string $default = ''): string
    {
        return \preg_replace('/[^[:alpha:]]/', '', $this->get($key, $default));
    }

    public function getAlnum(string $key, string $default = ''): string
    {
        return \preg_replace('/[^[:alnum:]]/', '', $this->get($key, $default));
    }

    public function getDigits(string $key, string $default = ''): string
    {
        return \str_replace(['-', '+'], '', $this->filter($key, $default, FILTER_SANITIZE_NUMBER_INT));
    }

    public function getInt(string $key, int $default = 0): int
    {
        return (int) $this->get($key, $default);
    }

    public function getFloat(string $key, float $default = 0.0): float
    {
        return (float) $this->get($key, $default);
    }

    public function getBool(string $key, bool $default = false): bool
    {
        return $this->filter($key, $default, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @see https://php.net/filter-var
     * @param string $key
     * @param mixed $default
     * @param int $filter
     * @param array $options
     * @return mixed
     */
    public function filter(string $key, $default = null, int $filter = FILTER_DEFAULT, $options = [])
    {
        $value = $this->get($key, $default);

        if (!\is_array($options)) {
            $options = ['flags' => $options];
        }

        if (\is_array($value) && !isset($options['flags'])) {
            $options['flags'] = FILTER_REQUIRE_ARRAY;
        }

        return \filter_var($value, $filter, $options);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->table);
    }

    public function count(): int
    {
        return \count($this->table);
    }

    public function getPath(string $path, $default = null)
    {
        return Arr::get($path, $this->table, $default, $this->keyPathDelimiter);
    }

    public function setPath(string $path, $value): self
    {
        $this->table = Arr::set($path, $value, $this->table, $this->keyPathDelimiter);
        return $this;
    }

    public function hasPath(string $path): bool
    {
        return Arr::has($path, $this->table, $this->keyPathDelimiter);
    }

    public function hasValue($value): bool
    {
        foreach ($this as $k => $v) {
            if ($value === $v) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
