<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clinics')->insert(
            [
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"No-drop Clinic","name_sin"=>"කැඩුම්-බිදුම්","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Thorns-Diagnosis Clinic","name_sin"=>"කටු-චිකිත්සා","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Vātavyadī Clinic","name_sin"=>"වාතව්‍යදී ","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Acid Bile and Catarrh Clinic","name_sin"=>"අම්ල පිත්ත හා පීනස්","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Non-Communicable Diseases Clinic","name_sin"=>"බෝනොවන රෝග","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Skin Diseases Clinic","name_sin"=>"චර්ම රෝග","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Surgery Clinic","name_sin"=>"ශල්‍ය ","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Yoga Clinic","name_sin"=>"යෝග ","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"Beauty Clinic","name_sin"=>"රුපලාවන්‍ය ","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"doctor_id"=>1,"name_eng"=>"External Clinic","name_sin"=>"බාහිර සායන","recuring"=>"monthly","start-date"=>Carbon::now()->toDateString()],
            ]);
    }
}
