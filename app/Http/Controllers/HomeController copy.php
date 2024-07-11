<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\ProvinceExel;
use App\Models\Region_excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function home()
    {
        $province_excel = ProvinceExel::all();
        if ($province_excel->count() > 0) {
            $province = DB::select(DB::raw("SELECT DISTINCT(province_exels.annee), 
        (SELECT fianar.valeur FROM province_exels AS fianar WHERE fianar.province_id = 1 AND fianar.annee = province_exels.annee ) as fianarantsoa, 
        (SELECT tana.valeur FROM province_exels AS tana WHERE tana.province_id = 2 AND tana.annee = province_exels.annee ) as tananarivo,
        (SELECT toa.valeur FROM province_exels AS toa WHERE toa.province_id = 3 AND toa.annee = province_exels.annee ) as toamasina,
        (SELECT janga.valeur FROM province_exels AS janga WHERE janga.province_id = 4 AND janga.annee = province_exels.annee ) as mahajanga,
        (SELECT tol.valeur FROM province_exels AS tol WHERE tol.province_id = 5 AND tol.annee = province_exels.annee ) as toliary,
        (SELECT ants.valeur FROM province_exels AS ants WHERE ants.province_id = 6 AND ants.annee = province_exels.annee ) as antsiranana
        FROM province_exels 
        GROUP BY province_exels.annee, province_exels.id"));

            $juridique = DB::select(DB::raw("SELECT DISTINCT(juridique_excels.annee), 
        (SELECT ei.valeur FROM juridique_excels AS ei WHERE ei.fjuridique_id = 2 AND ei.annee = juridique_excels.annee ) as ei, 
        (SELECT eurl.valeur FROM juridique_excels AS eurl WHERE eurl.fjuridique_id = 3 AND eurl.annee = juridique_excels.annee ) as eurl,
        (SELECT sa.valeur FROM juridique_excels AS sa WHERE sa.fjuridique_id = 4 AND sa.annee = juridique_excels.annee ) as sa,
        (SELECT sarl.valeur FROM juridique_excels AS sarl WHERE sarl.fjuridique_id = 5 AND sarl.annee = juridique_excels.annee ) as sarl,
        (SELECT autre.valeur FROM juridique_excels AS autre WHERE autre.fjuridique_id = 1 AND autre.annee = juridique_excels.annee ) as autres
        FROM juridique_excels 
        GROUP BY juridique_excels.annee, juridique_excels.id"));

            $secteur = DB::select(DB::raw("SELECT DISTINCT(secteur_excels.annee), 
        (SELECT prim.valeur FROM secteur_excels AS prim WHERE prim.secteur_id = 1 AND prim.annee = secteur_excels.annee ) as primaire, 
        (SELECT sec.valeur FROM secteur_excels AS sec WHERE sec.secteur_id = 2 AND sec.annee = secteur_excels.annee ) as secondaire,
        (SELECT ter.valeur FROM secteur_excels AS ter WHERE ter.secteur_id = 3 AND ter.annee = secteur_excels.annee ) as tertiaire
        FROM secteur_excels 
        GROUP BY secteur_excels.annee, secteur_excels.id"));

            $nation = DB::select(DB::raw("SELECT DISTINCT(nation_excels.annee), 
        (SELECT etranger.valeur FROM nation_excels AS etranger WHERE etranger.nation_id = 1 AND etranger.annee = nation_excels.annee ) as etranger, 
        (SELECT malagasy.valeur FROM nation_excels AS malagasy WHERE malagasy.nation_id = 2 AND malagasy.annee = nation_excels.annee ) as malagasy
        FROM nation_excels 
        GROUP BY nation_excels.annee, nation_excels.id"));

            $salarie = DB::select(DB::raw("SELECT DISTINCT(salarie_excels.annee), 
        (SELECT a.valeur FROM salarie_excels AS a WHERE a.salarie_id = 1 AND a.annee = salarie_excels.annee ) as zero_salarie, 
        (SELECT b.valeur FROM salarie_excels AS b WHERE b.salarie_id = 2 AND b.annee = salarie_excels.annee ) as un_a5,
        (SELECT c.valeur FROM salarie_excels AS c WHERE c.salarie_id = 3 AND c.annee = salarie_excels.annee ) as deux_a10,
        (SELECT d.valeur FROM salarie_excels AS d WHERE d.salarie_id = 4 AND d.annee = salarie_excels.annee ) as dix_a15,
        (SELECT e.valeur FROM salarie_excels AS e WHERE e.salarie_id = 5 AND e.annee = salarie_excels.annee ) as quinze_a20,
        (SELECT f.valeur FROM salarie_excels AS f WHERE f.salarie_id = 6 AND f.annee = salarie_excels.annee ) as vingt_a50,
        (SELECT g.valeur FROM salarie_excels AS g WHERE g.salarie_id = 5 AND g.annee = salarie_excels.annee ) as cinquante_a100,
        (SELECT h.valeur FROM salarie_excels AS h WHERE h.salarie_id = 6 AND h.annee = salarie_excels.annee ) as cent_a200,
        (SELECT i.valeur FROM salarie_excels AS i WHERE i.salarie_id = 5 AND i.annee = salarie_excels.annee ) as plus_200
        FROM salarie_excels 
        GROUP BY salarie_excels.annee, salarie_excels.id"));

            $type_mis_a_jour = DB::select(DB::raw("SELECT DISTINCT(type_excels.annee), 
        (SELECT a.valeur FROM type_excels AS a WHERE a.type_id = 1 AND a.annee = type_excels.annee ) as annulation,
        (SELECT b.valeur FROM type_excels AS b WHERE b.type_id = 2 AND b.annee = type_excels.annee ) as creation,
        (SELECT c.valeur FROM type_excels AS c WHERE c.type_id = 3 AND c.annee = type_excels.annee ) as modification,
        (SELECT d.valeur FROM type_excels AS d WHERE d.type_id = 4 AND d.annee = type_excels.annee ) as mutation,
        (SELECT e.valeur FROM type_excels AS e WHERE e.type_id = 6 AND e.annee = type_excels.annee ) as reprise
        FROM type_excels 
        GROUP BY type_excels.annee, type_excels.id"));

            $data_province = "";
            $data_juridique = "";
            $data_secteur = "";
            $data_nation = "";
            $data_salarie = "";
            $data_type_mis_a_jour = "";

            foreach ($province as $val) {
                $data_province .= "['" . $val->annee . "', " . $val->fianarantsoa . ", " . $val->tananarivo . ", " . $val->toamasina . ", " . $val->mahajanga . ", " . $val->toliary . ", " . $val->antsiranana . "],";
            }

            foreach ($juridique as $val) {
                $data_juridique .= "['" . $val->annee . "', " . $val->ei . ", " . $val->eurl . ", " . $val->sa . ", " . $val->sarl . ", " . $val->autres . "],";
            }

            foreach ($secteur as $val) {
                $data_secteur .= "['" . $val->annee . "', " . $val->primaire . ", " . $val->secondaire . ", " . $val->tertiaire . "],";
            }

            foreach ($nation as $val) {
                $data_nation .= "['" . $val->annee . "', " . $val->etranger . ", " . $val->malagasy . "],";
            }

            foreach ($salarie as $val) {
                $data_salarie .= "['" . $val->annee . "', " . $val->zero_salarie . ", " . $val->un_a5 . ", " . $val->deux_a10 . ", " . $val->dix_a15 . ", " . $val->quinze_a20 . ", " . $val->vingt_a50 . ", " . $val->cinquante_a100 . ", " . $val->cent_a200 . ", " . $val->plus_200 . "],";
            }

            foreach ($type_mis_a_jour as $val) {
                $data_type_mis_a_jour .= "['" . $val->annee . "', " . $val->annulation . ", " . $val->creation . ", " . $val->modification . ", " . $val->mutation . ", " . $val->reprise . "],";
            }

            return view('home', compact('data_province', 'data_juridique', 'data_secteur', 'data_nation', 'data_salarie', 'data_type_mis_a_jour'));
        } else {
            return view('home_sans_data')->with('status', 'Aucun données à afficher !');
        }
    }
}
