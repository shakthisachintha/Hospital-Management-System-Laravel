<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert(
            [
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "dashamulrishtaya", 'name_sinhala' => "දශමූලාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "draksharishtaya", 'name_sinhala' => "ද්‍රාක්ෂාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "nimbarishtaya", 'name_sinhala' => "නිම්බාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "balarishtaya", 'name_sinhala' => "බලාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "musthakarishtaya", 'name_sinhala' => "මුස්තකාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "abhayarishtaya", 'name_sinhala' => "අභයාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "amurtharishtaya", 'name_sinhala' => "අමෘතාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "ashwagandharishtaya", 'name_sinhala' => "අශ්වගන්ධාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "ashokarishtaya", 'name_sinhala' => "අශෝකාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "arjunarishtaya", 'name_sinhala' => "අර්ජුනාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'arishta',"type_sinhala"=>'අරිෂ්ඨ','name_english' => "badirarishtaya", 'name_sinhala' => "බදිරාරිෂ්ටය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "aravindasawaya", 'name_sinhala' => "අරවින්දාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "chandanasawaya", 'name_sinhala' => "චන්දනාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "kanakasawaya", 'name_sinhala' => "කනකාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "lauhasawaya", 'name_sinhala' => "ලෞහාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "pippalyadyasawaya", 'name_sinhala' => "පිප්පල්‍යාද්‍යාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "punarnawasawaya", 'name_sinhala' => "පූනර්ණවාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "sharibhadsawaya", 'name_sinhala' => "ශාරිභාද්සවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "ushirasawaya", 'name_sinhala' => "උශීරාසවය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'Āsava',"type_sinhala"=>'ආසව','name_english' => "chirabilwa kwathaya", 'name_sinhala' => "චිරබිල්ව ක්වාතය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cyrup',"type_sinhala"=>'සිරප්','name_english' => "wasaka sirap", 'name_sinhala' => "වාසක සිරප්"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cyrup',"type_sinhala"=>'සිරප්','name_english' => "maduka kassa paniya", 'name_sinhala' => "මධූකා කැස්ස පැණිය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cyrup',"type_sinhala"=>'සිරප්','name_english' => "sidhdhajiwa wartha", 'name_sinhala' => "සිද්ධජීව වෘත"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "bhashkara lawana churnaya", 'name_sinhala' => "භාෂ්කර ලවණ චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "dhathri churnaya", 'name_sinhala' => "ධාත්‍රී චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "dashangalepa churnaya", 'name_sinhala' => "දශාංගලේප චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "katphaladi churnaya", 'name_sinhala' => "කට්ඵලාදී චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "hinguwashtaka churnaya", 'name_sinhala' => "හිංගුවෂ්ටක චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "manibadhra churnaya", 'name_sinhala' => "මානිභද්‍ර චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "manjanesruk (Toothpaste)", 'name_sinhala' => "මාංජනේසෘක් (දත් බෙහෙත්)"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "pushyanunga churnaya", 'name_sinhala' => "පුෂ්‍යනුග චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "sudarshana churnaya", 'name_sinhala' => "සුදර්ශණ චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "thalisadi churnaya", 'name_sinhala' => "තාලිසාදී චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "awipaththikara churnaya", 'name_sinhala' => "අවිපත්තිකර චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "sithophaladi churnaya", 'name_sinhala' => "සීතෝඵලාදී චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "wajrakshara churnaya", 'name_sinhala' => "වජ්‍රක්ෂාර චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "thriphala churnaya", 'name_sinhala' => "ත්‍රිඵලා චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "sukumara churnaya", 'name_sinhala' => "සුකුමාර චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "chirabilwa churnaya", 'name_sinhala' => "චිරබිල්ව චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'cūrṇa',"type_sinhala"=>'චූර්ණ','name_english' => "ashwagandha churnaya", 'name_sinhala' => "අශ්වගන්ධ චූර්ණය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "chandraprabha wati", 'name_sinhala' => "චන්ද්‍රප්‍රභා වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "gokshuradi guggulu", 'name_sinhala' => "ගෝක්ෂුරාදී ගුග්ගුළු"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "kaishoraka guggulu", 'name_sinhala' => "කෛශෝරක ගුග්ගුළු"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "yogaraja guggulu", 'name_sinhala' => "යෝගරාජ ගුග්ගුළු "],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "jiwananda wati", 'name_sinhala' => "ජීවානන්ද වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "sitharama wati", 'name_sinhala' => "සීතාරාම වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "suranchidura wati", 'name_sinhala' => "සුරංචිදුර වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "sarpagandha wati", 'name_sinhala' => "සර්පගන්ධ වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "krimghathani wati", 'name_sinhala' => "ක්‍රීම්ඝාතනී වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'gugguḷu',"type_sinhala"=>'වටී/ගුග්ගුළු','name_english' => "arogya wardhana wati", 'name_sinhala' => "ආරෝග්‍ය වර්ධන වටී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "mruthunjaya rasa", 'name_sinhala' => "මෘතුංජය රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "ramhana rasa", 'name_sinhala' => "රාම්හාන රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "swasa kutara rasa", 'name_sinhala' => "ස්වාස කුටාර රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "thribhuwana kirthi rasa", 'name_sinhala' => "ත්‍රිභුවන කීර්ති රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "wathagajendrasinha rasa", 'name_sinhala' => "වාතගජේන්ද්‍රසිංහ රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "somanatha rasa", 'name_sinhala' => "සෝමනාත රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "punarnawadi wanpura rasa", 'name_sinhala' => "පුණර්නවාදී වන්පුර රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'sweets',"type_sinhala"=>'රස බෙහෙත්','name_english' => "nithyananda rasa", 'name_sinhala' => "නිත්‍යානන්ද රස"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'other',"type_sinhala"=>'වෙනත්','name_english' => "medaharani kwathaya", 'name_sinhala' => "මේදහරණි ක්වාතය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'other',"type_sinhala"=>'වෙනත්','name_english' => "deniba debatu", 'name_sinhala' => "දෙනිබ දෙබටු"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'other',"type_sinhala"=>'වෙනත්','name_english' => "madhumebha harani", 'name_sinhala' => "මධුමේභ හරණි"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "budhdharaja kalkaya", 'name_sinhala' => "බුද්ධරාජ කල්කය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "desadun kalkaya", 'name_sinhala' => "දෙසදුන් කල්කය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "nawarathna kalkaya", 'name_sinhala' => "නවරත්න කල්කය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "sharkaradi kalkaya", 'name_sinhala' => "ශර්කරාදී කල්කය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "roganikash lepaya", 'name_sinhala' => "රෝගානිකාෂ් ලේපය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "lakshadi lepaya", 'name_sinhala' => "ලාක්ෂාදී ලේපය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "wachanaprasawaya lepaya", 'name_sinhala' => "වචනප්‍රාසාවය ලේපය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "chandra kalkaya", 'name_sinhala' => "චන්ද්‍ර කල්කය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "wasawa lepaya", 'name_sinhala' => "වාසාව ලේපය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "kushmanda kawa lepaya 400g", 'name_sinhala' => "කුෂ්මාණ්ඩ කාව ලේපය 400g"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'pulp',"type_sinhala"=>'කල්ක','name_english' => "welwa chengayam 400g", 'name_sinhala' => "වෙල්ව චෙන්ගායම් 400g"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "batu thailaya", 'name_sinhala' => "බටු තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "kolasheleshmadi", 'name_sinhala' => "කෝලශෙලෙෂ්මාදී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "bhrunga malaka", 'name_sinhala' => "භෘංගා මලක"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "narayana thailaya", 'name_sinhala' => "නාරායන තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "nilyadi thailaya", 'name_sinhala' => "නීල්‍යාදී තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "nirgundyadi", 'name_sinhala' => "නිර්ගුන්ද්‍යාදී"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "pata thailaya", 'name_sinhala' => "පාඨා තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "pinda thailaya", 'name_sinhala' => "පින්ඩ තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "pinas thailaya", 'name_sinhala' => "පීනස් තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "sarshapadi thailaya", 'name_sinhala' => "සර්ෂපාදී තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "watha widuranga thailaya", 'name_sinhala' => "වාත විදුරංග තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "wisharpahara thailaya", 'name_sinhala' => "විෂර්පහර තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "thriphala thailaya", 'name_sinhala' => "ත්‍රිඵලා තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "irimedadi thailaya", 'name_sinhala' => "ඉරිමේදාදී තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "bakuchi thailaya", 'name_sinhala' => "බාකුචි තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "sithodaka thailaya", 'name_sinhala' => "සිතෝදක තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "sidhdhartha thailaya", 'name_sinhala' => "සිද්ධාර්ථ තෛලය"],
                ["updated_at"=>Carbon::now()->toDateTimeString(),"created_at"=>Carbon::now()->toDateTimeString(),"type_english"=>'nostrum',"type_sinhala"=>'තෛල','name_english' => "sarwawishadi thailaya", 'name_sinhala' => "සර්වවිෂාදී තෛලය"],

            
        ]);
    }
}
