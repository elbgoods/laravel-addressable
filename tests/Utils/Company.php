<?php

namespace Elbgoods\LaravelAddressable\Tests\Utils;

use Elbgoods\LaravelAddressable\Concerns\Addressable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Addressable;

    protected $table = 'companies';
    protected $guarded = [];
}
