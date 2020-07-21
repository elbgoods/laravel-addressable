<?php

namespace Elbgoods\LaravelAddressable\Contracts;

interface AddressFormat
{
    public function fields(?string $prefix = null): array;

    public function rules(?string $prefix = null): array;
}
