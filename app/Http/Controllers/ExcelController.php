<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\LchefsExport;
use App\Models\Etablissement;
use App\Exports\CommunesExport;
use App\Exports\ActivitesExport;
use App\Exports\QuitancesExport;
use App\Exports\JuridiquesExport;
use App\Exports\FokontaniesExport;
use Illuminate\Support\Facades\DB;
use App\Exports\NationalitesExport;
use App\Exports\ProprietairesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EtablissementsExport;
use App\Imports\EtablissementImport;
use App\Models\Fjuridique;
use App\Models\Juridique_excel;
use App\Models\Nation_excel;
use App\Models\ProvinceExel;
use App\Models\Quitance;
use App\Models\Region_excel;
use App\Models\Salarie_excel;
use App\Models\Secteur_excel;
use App\Models\Type_excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{

    public function form_export()
    {
        return view('excel.form_export');
    }

    public function form_import_data()
    {
        return view('excel.form_import');
    }


    public function export($donnee)
    {
        if ($donnee == "activite") {
            return Excel::download(new ActivitesExport, 'activites.xlsx');
        } elseif ($donnee == "etablissement") {
            return Excel::download(new EtablissementsExport, 'etablissements.xlsx');
        } elseif ($donnee == "commune") {
            return Excel::download(new CommunesExport, 'communes.xlsx');
        } elseif ($donnee == "fokontany") {
            return Excel::download(new FokontaniesExport, 'fokontany.xlsx');
        } elseif ($donnee == "juridique") {
            return Excel::download(new JuridiquesExport, 'juridiques.xlsx');
        } elseif ($donnee == "lchef") {
            return Excel::download(new LchefsExport, 'lchefs.xlsx');
        } elseif ($donnee == "nationalite") {
            return Excel::download(new NationalitesExport, 'nationalites.xlsx');
        } elseif ($donnee == "proprietaire") {
            return Excel::download(new ProprietairesExport, 'proprietaire.xlsx');
        } elseif ($donnee == "quittance") {
            return Excel::download(new QuitancesExport, 'quittances.xlsx');
        } else {
            return Excel::download(new UsersExport, 'users.xlsx');
        }
    }

    //************************************** */ chart etabissement

    public function statistique()
    {
        $etablissements = Etablissement::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $etablissements->keys();
        $data = $etablissements->values();

        return view('statistique.statistique')->with('labels', $labels)->with('data', $data);
    }

    //************************************** */ chart quittance

    public function statistique_quittance()
    {
        $quittance = Quitance::select(DB::raw("COUNT(*) as count"), DB::raw("type"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("type"))
            ->pluck('count', 'type');

        $labels = $quittance->keys();
        $data = $quittance->values();


        $total = DB::table('quitances')
            ->select(DB::raw('sum(prix) as total'), DB::raw("type"), DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('type')->pluck('total', 'type',);

        $grand_total = DB::table('quitances')
            ->select(DB::raw('sum(prix) as total'))
            ->whereYear('created_at', date('Y'))
            ->pluck('total');

        $type = $total->keys();
        $value = $total->values();

        return view('statistique.statistique_quittance')
            ->with('type', $type)
            ->with('value', $value)
            ->with('data', $data)
            ->with('labels', $labels)
            ->with('grand_total', $grand_total->values());
    }

    public function import_excel(Request $request)
    {
        $excel_region = Region_excel::all();
        $excel_province = ProvinceExel::all();
        $excel_forme = Juridique_excel::all();
        $excel_secteur = Secteur_excel::all();
        $excel_nation = Nation_excel::all();
        $excel_salarie = Salarie_excel::all();
        $excel_type = Type_excel::all();

        if ($excel_province->count() > 0) {

            $excel_region->delete();
            $excel_province->delete();
            $excel_forme->delete();
            $excel_secteur->delete();
            $excel_nation->delete();
            $excel_salarie->delete();
            $excel_type->delete();
        }

        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '512M');
        $path = $request->file('excel')->getRealPath();
        $data = Excel::toCollection(new EtablissementImport, $path);

        $check = 0;
        $annee = [];
        $ligne_tab_province = 0;
        $ligne_tab_region = 0;
        $ligne_tab_juridique = 0;
        $ligne_tab_secteur = 0;
        $ligne_tab_nation = 0;
        $ligne_tab_salarie = 0;
        $ligne_tab_mis_a_jour = 0;

        for ($i = 1; $i < count($data[0][3]); $i++) {
            if ($data[0][3][$i] == 'Total') {
                $check = $i;
                break;
            }

            $annee[] = $data[0][3][$i];
        }
        $tab = null;
        for ($ligne = 4; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_province = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $province = DB::select('select id from provinces where nom_province = ? ', [$data[0][$ligne][0]]);
                $province = DB::select('insert into province_exels values(null, ?, ?,?,now(),now())', [$province[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_region = $ligne_tab_province + 6;

        for ($ligne = $tab_region; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_region = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $region = DB::select('select id from regions where nom_region = ? ', [$data[0][$ligne][0]]);
                $region = DB::select('insert into region_excels values(null, ?, ?,?,now(),now())', [$region[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_juridique = $ligne_tab_region + 6;

        for ($ligne = $tab_juridique; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_juridique = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $juridique = DB::select('select id from fjuridiques where nom_forme = ? ', [$data[0][$ligne][0]]);
                $juridique = DB::select('insert into juridique_excels values(null, ?, ?,?,now(),now())', [$juridique[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_secteur = $ligne_tab_juridique + 6;

        for ($ligne = $tab_secteur; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_secteur = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $secteur = DB::select('select id from secteurs where type_secteur = ? ', [$data[0][$ligne][0]]);
                $secteur = DB::select('insert into secteur_excels values(null, ?, ?,?,now(),now())', [$secteur[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_nation = $ligne_tab_secteur + 6;

        for ($ligne = $tab_nation; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_nation = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $nation = DB::select('select id from nations where type_nation = ? ', [$data[0][$ligne][0]]);
                $nation = DB::select('insert into nation_excels values(null, ?, ?,?,now(),now())', [$nation[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_salarie = $ligne_tab_nation + 6;

        for ($ligne = $tab_salarie; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_salarie = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $salarie = DB::select('select id from salaries where intervalle_salarie = ? ', [$data[0][$ligne][0]]);
                $salarie = DB::select('insert into salarie_excels values(null, ?, ?,?,now(),now())', [$salarie[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        $tab_mis_a_jour = $ligne_tab_salarie + 6;

        for ($ligne = $tab_mis_a_jour; $ligne < count($data[0]); $ligne++) {
            if ($data[0][$ligne][0] == 'Total') {
                $ligne_tab_mis_a_jour = $ligne;
                break;
            }
            for ($col = 1; $col < count($data[0][$ligne]); $col++) {
                if ($col == $check) {
                    $tab = 'fin';
                    break;
                };
                $salarie = DB::select('select id from types where nom_type = ? ', [$data[0][$ligne][0]]);
                $salarie = DB::select('insert into type_excels values(null, ?, ?,?,now(),now())', [$salarie[0]->id, $annee[$col - 1], $data[0][$ligne][$col]]);
            }
        }

        return redirect('/form_import_data')->with('status', 'Données importés avec success !');
    }
}
