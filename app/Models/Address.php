<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;
    protected $table = 'orgs_main';
    public $timestamps = false;

    public function subOrgs()
    {
        return $this->hasMany(SubOrg::class, 'address', 'address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Org::class, 'address', 'address')
            ->where('code', 'like', '64%')
            ->select('name', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subOrganisations(): HasMany
    {
        return $this->hasMany(SubOrg::class, 'address', 'address')
            ->select('name', 'code', 'id');
    }
}
