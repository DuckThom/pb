<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class App\Paste
 * @package App
 */
class Paste extends Model
{

    /**
     * Get creator value or default to 'anonymous'
     *
     * @param  null|string  $value
     * @return string
     */
    public function getCreatorAttribute($value)
    {
        return ($value ?? 'anonymous');
    }

}
