<?php

namespace DLCshare\PhpEnv;

class ReadEnv
{
    public function __construct(private string $path)
    {
        $this->path = $this->set_file($path);
    }

    public function load() : bool
    {
        if (file_exists($this->path)) {
            $this->save();
            return true;
        }
        return false;
    }

    private function set_file(string $path)
    {
        return $path . DIRECTORY_SEPARATOR . ".env";
    }

    private function save()
    {
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
            }
        }
    }
}
?>