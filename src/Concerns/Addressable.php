<?php

namespace Elbgoods\LaravelAddressable\Concerns;

use Elbgoods\LaravelAddressable\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/** @mixin Model */
trait Addressable
{
    protected ?Address $pendingAddress = null;

    public static function bootAddressable(): void
    {
        static::created(function (Model $model): void {
            /** @var Model|Addressable $model */
            if ($model->pendingAddress === null) {
                return;
            }

            $model->address()->save($model->pendingAddress);
        });
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function setAddressAttribute($value): void
    {
        if (is_array($value)) {
            $value = Address::fromArray($value);
        }

        if ($value instanceof Address) {
            if ($this->exists) {
                $this->address()->save($value);
            } else {
                $this->pendingAddress = $value;
            }
        }
    }
}
