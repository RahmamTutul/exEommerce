<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/update-section-status',
        '/admin/update-category-status',
        '/admin/append-category-level',
        '/product/update-product-status',
        '/product/update-attribute-status',
        '/product/update-image-status',
        '/admin/update-brands-status',
        '/admin/update-banner-status',
        '/get-product-price',
        '/admin/update-coupon-status',
        'admin/update-shipping-status',
        '/admin/update-cms-status',
        '/admin/update-admin-status',
    ];
}
