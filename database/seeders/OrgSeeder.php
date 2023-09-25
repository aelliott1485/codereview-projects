<?php

namespace Database\Seeders;

use App\Models\Org;
use App\Models\SubOrg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Org::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'ASPIRE MOBILITY',
            'code' => '6444843302',
        ]);
        Org::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'MOEBELTRANSPORT DANMARK A/S',
            'code' => '6444843300',
        ]);
        Org::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'Aspire Mobility Group A/S',
            'code' => '6403533640',
        ]);
        SubOrg::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'Aspire Mobility',
            'code' => '65084834',
        ]);

        SubOrg::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'JEREMY PHILIP TAYLOR C/O MOBEL TRANSP.DK',
            'code' => '00043674',
        ]);

        SubOrg::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'KURT LYKSTOFT C/O MOBELTRANSPORT DANMARK',
            'code' => '10009002',
        ]);

        SubOrg::factory()->createQuietly([
            'address' => 'ISLEVDALVEJ 110',
            'name' => 'LENE BJERREGAARD C/O MOBEL TRANSPORT DENMARK',
            'code' => '00086990',
        ]);
    }
}
