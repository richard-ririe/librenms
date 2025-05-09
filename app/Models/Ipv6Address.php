<?php

/**
 * Ipv6Address.php
 *
 * -Description-
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @link       https://www.librenms.org
 *
 * @copyright  2018 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 * @author     Peca Nesovanovic <peca.nesovanovic@sattrakt.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LibreNMS\Interfaces\Models\Keyable;

class Ipv6Address extends PortRelatedModel implements Keyable
{
    public $timestamps = false;
    protected $primaryKey = 'ipv6_address_id';
    protected $fillable = [
        'ipv6_address',
        'ipv6_compressed',
        'ipv6_prefixlen',
        'ipv6_origin',
        'ipv6_network_id',
        'port_id',
        'context_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Ipv6Network, $this>
     */
    public function network(): BelongsTo
    {
        return $this->belongsTo(Ipv6Network::class, 'ipv6_network_id', 'ipv6_network_id');
    }

    public function getCompositeKey(): string
    {
        return "$this->ipv6_address-$this->ipv6_prefixlen-$this->port_id-$this->context_name";
    }
}
