<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Criteria::create([
            'code' => 'C1',
            'name' => 'Nilai Ujian Sekolah'
        ]);
        Criteria::create([
            'code' => 'C2',
            'name' => 'Nilai Ujian Masuk'
        ]);
        Criteria::create([
            'code' => 'C3',
            'name' => 'Jarak Tempat Tinggal'
        ]);
        Criteria::create([
            'code' => 'C4',
            'name' => 'Organisasi Keaktifan'
        ]);

        // foreach ($criterias as $criteria) {
        //     $criteria = Criteria::create($criteria);
        //     $comparison = CriteriaComparison::updateOrCreate(
        //         ['first_criteria_id' => $criteria->id, 'second_criteria_id' => $criteria->id],
        //         ['value' => 1]
        //     );
        // }
    }
}
