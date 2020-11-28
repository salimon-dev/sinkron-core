<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;


class RedirectUrl extends Model
{
    use HasFactory;
    protected $table = 'redirect_urls';

    //================================================ relationships =========================================================

    /**
     * Get the client that owns the redirect url.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'oauth_clients_id', 'id');
    }


    //================================================ mutators =========================================================

    //================================================ scopes =========================================================
}
