<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function delete()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('proprietaires')->truncate();
        DB::table('etablissements')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return ("delete");
    }
}
