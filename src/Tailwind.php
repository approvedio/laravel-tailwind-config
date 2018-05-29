<?php

namespace ApprovedDigital\LaravelTailwindConfig;

use Illuminate\Support\Arr;

class Tailwind {

    protected $config;
    protected $tailwindValues;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->tailwindValues = json_decode(file_get_contents($this->config('cache_path')), true);
    }

    public function get($key = null, $default = null)
    {
        return Arr::get($key, $default);
    }

    public function config($key, $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }
}