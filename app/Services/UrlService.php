<?php

namespace App\Services;

use App\Models\UrlMapping;

class UrlService
{
    const KEY_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generateKey($length = 6)
    {
        $lengthOfChars = strlen(static::KEY_CHARS);
        $key = '';
        $sumOfChars = 0;
        for ($i = 0; $i < $length - 1; $i++) {
            $n = mt_rand(0, $lengthOfChars - 1);
            $key .= static::KEY_CHARS[$n];
            $sumOfChars += ord(static::KEY_CHARS[$n]);
        }
        $checkChar = static::KEY_CHARS[$sumOfChars % $lengthOfChars];
        $key .= $checkChar;
        return $key;
    }

    public function isValidatedKey($key)
    {
        $lengthOfChars = strlen(static::KEY_CHARS);
        $length = strlen($key);
        list($splitKey, $lastChar) = str_split($key,  $length - 1);
        $sumOfChars = 0;

        for ($i = 0; $i < $length - 1; $i++) {
            $sumOfChars += ord($splitKey[$i]);
        }
        $checkChar = static::KEY_CHARS[$sumOfChars % $lengthOfChars];

        return ($lastChar == $checkChar);
    }

    public function createUrlMapping($key)
    {
        UrlMapping::create(['key' => $key, 'url' => '']);
    }

    public function updateUrlMapping($key, $url)
    {
        UrlMapping::where(['key' => $key, 'is_used' => false])
            ->update(['url' => $url, 'is_used' => true]);
    }

    public function getUrlByKey($key)
    {
        return UrlMapping::where('key', '=', $key)->first();
    }

    public function getUnusedKey()
    {
        $mapping = UrlMapping::where('is_used', '=', false)
            ->orderBy('id')
            ->first();
        return $mapping->key;
    }

    public function saveUrl($url)
    {
        $mappingKey = $this->getUnusedKey();
        $this->updateUrlMapping($mappingKey, $url);
        return $mappingKey;
    }
}
