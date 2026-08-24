<?php

namespace App\Models;

use Lampminds\Customization\Models\BaseModel;

class Menu extends BaseModel
{
    protected $fillable = [
        'title',
        'link',
        'active',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope for active menus
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope for ordered menus
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Check if the link is external
     */
    public function isExternal(): bool
    {
        return str_starts_with($this->link, 'http');
    }

    /**
     * Get the link with proper attributes for external links
     */
    public function getLinkAttributes(): array
    {
        if ($this->isExternal()) {
            return [
                'target' => '_blank',
                'rel' => 'noopener noreferrer'
            ];
        }

        return [];
    }
}
