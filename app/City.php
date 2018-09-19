<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class City
 * @package App
 * @property string $name
 * @property int $code
 */
class City extends Model
{
    protected $table = 'cities';
}
