<?php 
namespace SoluHelpers\Traits;
use Illuminate\Support\Facades\Crypt;

trait Encrypt {
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ($value!=='' && in_array($key, $this->encryptable)) {
            $value = decrypt($value);
         return $value;
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if ($value!=='' && in_array($key, $this->encryptable)) {
            $value = encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }
}

?>
