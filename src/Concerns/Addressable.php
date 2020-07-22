<?php

namespace Elbgoods\LaravelAddressable\Concerns;

use Elbgoods\LaravelAddressable\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property-read Address $address
 *
 * @mixin Model
 */
trait Addressable
{
    protected ?Address $pendingAddress = null;

    public static function bootAddressable(): void
    {
        static::saved(function (Model $model): void {
            /** @var Model|Addressable $model */
            if($model->address !== null) {
                $model->setRelation('address', $model->address()->save($model->address));
            }

            if($model->pendingAddress instanceof Address) {
                $model->setRelation('address', $model->address()->save($model->pendingAddress));
            }
        });
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function setAddressAttribute($value): void
    {
        if (
            $this->address !== null
            && $this->address->exists
        ) {
            $address = $this->address->fill(
                $value instanceof Address
                    ? $value->toArray()
                    : $value
            );
        } else {
            $address = $value instanceof Address
                ? $value
                : $this->address()->make($value);
        }

        if ($this->exists) {
            $this->address = $address;
        } else {
            $this->pendingAddress = $address;
        }
    }
}
