<?php

class Model
{
    protected $pdo;

    public static function make()
    {
        $instance = new static;

        // Connect to database using the specified configuration values
        $config = require __DIR__.'/../config.php';

        $dsn = 'mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'];
        if ($config['database']['port']) $dsn .= ';port='.$config['database']['port'];

        $instance->pdo = new PDO($dsn,
            $config['database']['username'],
            $config['database']['password'],
            $config['database']['options']
        );

        return $instance;
    }

    public function generateVoucherCode(): string
    {
        do {
            $salt = sha1(time().mt_rand());
            $newKey = strtoupper(substr($salt, 0, 8));
        } // Already in the DB? Fail. Try again
        while ($this->voucherCodeExists($newKey));

        return $newKey;
    }

    public function voucherCodeExists($code): bool
    {
        $fetch = $this->pdo->query("select * from users where voucher_code = ".$this->pdo->quote($code), PDO::FETCH_ASSOC);

        return $fetch->fetch() !== false;
    }

    public function save($attributes): bool
    {
        $fieldNames = array_keys($attributes);
        $fields = implode(', ', $fieldNames);
        $values = ':'.implode(', :', $fieldNames);

        $saved = $this->pdo
            ->prepare('INSERT INTO users ('.$fields.') VALUES ('.$values.')')
            ->execute($attributes);

        if (!$saved)
            throw new Exception('Failed to save record');

        return $saved;
    }
}
