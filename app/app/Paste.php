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
     * Find a paste by its slug
     *
     * @param  string  $slug
     * @return static|null
     */
    public static function findBySlug($slug)
    {
        return static::whereSlug($slug)->first();
    }

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

    /**
     * Return an array with lines of the paste
     *
     * @return array
     */
    public function getLines()
    {
        return explode("\n", $this->content);
    }

}
