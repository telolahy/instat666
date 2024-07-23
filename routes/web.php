<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\LchefController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\MutantController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\QuitanceController;
use App\Http\Controllers\SaisieurController;
use App\Http\Controllers\FokontanyController;
use App\Http\Controllers\JuridiqueController;
use App\Http\Controllers\casacade_0Controller;
use App\Http\Controllers\casacade_1Controller;
use App\Http\Controllers\casacade_2Controller;
use App\Http\Controllers\MutantExistController;
use App\Http\Controllers\NationaliteController;
use App\Http\Controllers\DropdownEtabController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\Quitance_regController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\Admin_reg_AjoutController;
use App\Http\Controllers\AjoutSaisisseurController;
use App\Http\Controllers\Admin_reg_MutationController;
use App\Http\Controllers\ReenregistrementRegController;
use App\Http\Controllers\AjoutAdminRegExistantController;
use App\Http\Controllers\Admin_reg_modificationController;
use App\Http\Controllers\ReenregistrementSaisieController;
use App\Http\Controllers\Admin_reg_EtablissementController;
use App\Http\Controllers\AjoutSaisisseurExistantController;
use App\Http\Controllers\AdminRegMutationExistantController;
use App\Http\Controllers\saisie_EtablissementController;


Route::get('/', function () {
    if(Auth::check())
    {
        return redirect()->route('home');
    }
    else
    {
        return view('home/home');
    }
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
   Route::get('/delete', [DeleteController::class, 'delete']);
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/form_activite', [ActiviteController::class, 'affiche_form_activite']);
    Route::post('/ajout_activite', [ActiviteController::class, 'ajout_activite']);
    Route::get('/list_activite', [ActiviteController::class, 'list_activite']);
    Route::delete('/supprimer_activite/{id}', [ActiviteController::class, 'supprimer_activite']);
    Route::get('/form_edit_activite/{id}', [ActiviteController::class, 'affiche_form_edit_activite']);
    Route::post('/modifier_activite', [ActiviteController::class, 'modifier_activite']);

    Route::get('/form_juridique', [JuridiqueController::class, 'affiche_form_juridique']);
    Route::post('/ajout_juridique', [JuridiqueController::class, 'ajout_juridique']);
    Route::get('/list_juridique', [JuridiqueController::class, 'list_juridique']);
    Route::delete('/supprimer_juridique/{id}', [JuridiqueController::class, 'supprimer_juridique']);
    Route::get('/form_edit_juridique/{id}', [JuridiqueController::class, 'affiche_form_edit_juridique']);
    Route::post('/modifier_juridique', [JuridiqueController::class, 'modifier_juridique']);

    Route::get('/form_lchef', [LchefController::class, 'affiche_form_lchef']);
    Route::post('/ajout_lchef', [LchefController::class, 'ajout_lchef']);
    Route::get('/list_lchef', [LchefController::class, 'list_lchef']);
    Route::delete('/supprimer_lchef/{id}', [LchefController::class, 'supprimer_lchef']);
    Route::get('/form_edit_lchef/{id}', [LchefController::class, 'affiche_form_edit_lchef']);
    Route::post('/modifier_lchef', [LchefController::class, 'modifier_lchef']);

    Route::get('/form_nationalite', [NationaliteController::class, 'affiche_form_nationalite']);
    Route::post('/ajout_nationalite', [NationaliteController::class, 'ajout_nationalite']);
    Route::get('/list_nationalite', [NationaliteController::class, 'list_nationalite']);
    Route::delete('/supprimer_nationalite/{id}', [NationaliteController::class, 'supprimer_nationalite']);
    Route::get('/form_edit_nationalite/{id}', [NationaliteController::class, 'affiche_form_edit_nationalite']);
    Route::post('/modifier_nationalite', [NationaliteController::class, 'modifier_nationalite']);

    Route::get('/form_commune', [CommuneController::class, 'affiche_form_commune']);
    Route::post('/ajout_commune', [CommuneController::class, 'ajout_commune']);
    Route::get('/list_commune', [CommuneController::class, 'list_commune']);
    Route::delete('/supprimer_commune/{id}', [CommuneController::class, 'supprimer_commune']);
    Route::get('/form_edit_commune/{id}', [CommuneController::class, 'affiche_form_edit_commune']);
    Route::post('/modifier_commune', [CommuneController::class, 'modifier_commune']);

    Route::get('/form_fokontany', [FokontanyController::class, 'affiche_form_fokontany']);
    Route::post('/ajout_fokontany', [FokontanyController::class, 'ajout_fokontany']);
    Route::get('/list_fokontany', [FokontanyController::class, 'list_fokontany']);
    Route::delete('/supprimer_fokontany/{id}', [FokontanyController::class, 'supprimer_fokontany']);
    Route::get('/form_edit_fokontany/{id}', [FokontanyController::class, 'affiche_form_edit_fokontany']);
    Route::post('/modifier_fokontany', [FokontanyController::class, 'modifier_fokontany']);


    Route::post('/ajout_etablissement', [EtablissementController::class, 'ajout_etablissement']);
    Route::get('/list_etablissement', [EtablissementController::class, 'list_etablissement'])->name('list_etablissement');
    //bar recherche
    Route::get('/search', [EtablissementController::class, 'ft_search'])->name('search');

    Route::get('/etab_proprietaire/{id}', [EtablissementController::class, 'detail_etab_proprietaire']);
    Route::get('/form_edit_etablissement/{id}', [EtablissementController::class, 'affiche_form_edit_etablissement']);
    Route::post('/modifier_etablissement', [EtablissementController::class, 'modifier_etablissement']);
    Route::get('/form_etablissement', [EtablissementController::class, 'affiche_form_etablissement']);
    Route::get('/carte_statistique/{id}', [EtablissementController::class, 'carte_statistique'])->name('carte');
    Route::get('/certificat_existence/{id}', [EtablissementController::class, 'certificat_existence'])->name('certificat_existence');
    Route::get('/list_mutation_proprio_exist', [EtablissementController::class, 'list_mutation_proprio_exist']);
    Route::get('/form_mutation_etablissement_exist/{id}', [EtablissementController::class, 'form_mutation_etablissement_exist']);
    Route::get('/get_proprietaire/{cin}', [EtablissementController::class, 'get_proprietaire']);
    Route::get('/list_etab_certificat', [EtablissementController::class, 'list_etab_certificat']);
    Route::get('/form_quittance_certificat_existence/{id}', [EtablissementController::class, 'form_quittance_certificat_existence']);
    Route::post('/ajout_quittance_certificat_existence', [EtablissementController::class, 'ajout_quittance_certificat_existence']);
    Route::get('/list_annulation_etablissement', [EtablissementController::class, 'list_annulation_etablissement']);
    Route::get('/annulation_etablissement/{id}', [EtablissementController::class, 'annulation_etablissement']);
    Route::get('/certificat_annulation_etablissement/{id}', [EtablissementController::class, 'certificat_annulation']);
    Route::get('/list_reprise_etablissement', [EtablissementController::class, 'list_reprise_etablissement']);
    Route::get('/form_reprise_etablissement/{id}', [EtablissementController::class, 'form_reprise_etablissement']);
    Route::post('/ajout_quittance_reprise_etablissement', [EtablissementController::class, 'ajout_quittance_reprise_etablissement']);

    Route::get('/form_quitance/{id}', [QuitanceController::class, 'affiche_form_quitance']);
    Route::post('/ajout_quitance', [QuitanceController::class, 'ajout_quitance']);

    Route::get('/form_export_data', [ExcelController::class, 'form_export']);
    Route::get('/export_data/{donnee}', [ExcelController::class, 'export']);
    Route::get('/statistique', [ExcelController::class, 'statistique']);
    Route::get('/statistique_quittance', [ExcelController::class, 'statistique_quittance']);
    Route::get('/form_import_data', [ExcelController::class, 'form_import_data']);
    Route::post('/import_excel', [ExcelController::class, 'import_excel']);



    Route::get('/list_com_prop', [ProprietaireController::class, 'affiche_list_comm_proprietaire'])->name('list_com_prop');
    Route::get('/form_proprietaire/{id}', [ProprietaireController::class, 'affiche_form_proprietaire']);
    Route::get('/form_edit/{id}', [ProprietaireController::class, 'affiche_form_edit']);
    Route::post('/rectifier_etab', [ProprietaireController::class, 'rectifier_etab']);
    Route::post('/ajout_proprietaire', [ProprietaireController::class, 'ajout_proprietaire']);
    Route::get('/list_proprietaire', [ProprietaireController::class, 'list_proprietaire']);
    Route::get('/etab_proprietaire_exist/{id}', [ProprietaireController::class, 'form_etab_proprietaire_exist']);
    Route::post('/ajout_etab_proprietaire_exist', [ProprietaireController::class, 'ajout_etab_proprietaire_exist']);
    Route::get('/form_edit_etablissement/{id}', [ProprietaireController::class, 'affiche_form_edit_proprietaire']);
    Route::get('/list_modif_proprio_etablissement', [ProprietaireController::class, 'list_modif_proprio_etablissement']);
    Route::get('/form_modif_proprio_etablissement/{id}', [ProprietaireController::class, 'form_modif_proprio_etablissement']);
    Route::post('/modifier_proprio_etablissement', [ProprietaireController::class, 'modifier_proprio_etablissement']);
    Route::get('/get_region/{commune}', [ProprietaireController::class, 'get_region']);
    Route::get('/list_mutation', [ProprietaireController::class, 'list_mutation']);
    Route::get('/form_mutation_etablissement/{id}', [ProprietaireController::class, 'form_mutation_etablissement']);


    Route::post('/ajout_mutation', [MutationController::class, 'ajout_mutation']);
    Route::post('/ajout_mutation_proprio_existant', [MutationController::class, 'ajout_mutation_proprio_existant']);


    Route::get('/form_user', [UserController::class, 'affiche_form_user']);
    Route::post('/ajout_user', [UserController::class, 'ajout_user'])->name('ajout_user');
    Route::get('/list_user', [UserController::class, 'list_user'])->name('list_user');
    Route::delete('/supprimer_user/{id}', [UserController::class, 'supprimer_user']);
    Route::get('/form_edit_user/{id}', [UserController::class, 'affiche_form_edit_user']);
    Route::post('/modifier_user', [UserController::class, 'modifier_user']);
    Route::get('/form_user', [UserController::class, 'affiche_form_user']);

    Route::post('/import_excel', [ExcelController::class, 'import_excel']);
    Route::get('/import_excel', [ExcelController::class, 'import_excel']);

    //SAISISSEUR  

    //ajout
    Route::resource('ajout_saisisseur', AjoutSaisisseurController::class);
    Route::get('/search_commune', [AjoutSaisisseurController::class, 'ft_search'])->name('search_commune');
    Route::get('/ajout_saisisseur_ft', [AjoutSaisisseurController::class, 'ajout'])->name('ajout_saisisseur_ft');
    Route::resource('ajout_saisisseur_Existant', AjoutSaisisseurExistantController::class);

    //modification
    Route::resource('saisie', SaisieurController::class);

    //Mutation
    Route::resource('mutation', MutantController::class);
    Route::post('mutation_ft/{etab_id}/{prop_id}',[MutantController::class, 'mutation_ft'])->name('mutation_ft');


    Route::resource('mutation_existant', MutantExistController::class);
    Route::get('/mutation_prop_existant/{etab_id}/{new_prop_id}', [MutantExistController::class, 'mutation_existant'])->name('mutation_prop_existant');
    Route::get('/search_existant/{id}', [MutantExistController::class, 'ft_search'])->name('search_existant');

     //Reenregistrement
     Route::resource('saisie_enregistrement', ReenregistrementSaisieController::class);
    //  etablissement
     Route::resource('saisie_etab', saisie_EtablissementController::class);
     Route::get('/search_list_saisie', [saisie_EtablissementController::class, 'ft_search'])->name('search_list_saisie');
    
    
    
    
    //ADMIN PAR REGION
    //ajout
    Route::resource('reg_ajout', Admin_reg_AjoutController::class);
    Route::get('/search_commune_reg', [Admin_reg_AjoutController::class, 'ft_search'])->name('search_commune_reg');
    Route::get('/ajout_admin_reg_ft/', [Admin_reg_AjoutController::class, 'ajout'])->name('ajout_admin_reg_ft');
    Route::resource('add_reg_existant',AjoutAdminRegExistantController::class); 
    //liste en cascade
    //province region
    Route::get('/regions/{province_id}', [DropdownController::class, 'getRegions']);
    Route::get('/districts/{region_id}', [DropdownController::class, 'getDistricts']);
    Route::get('/communes/{district_id}', [DropdownController::class, 'getCommunes']);
    Route::get('/fokontanis/{commune_id}', [DropdownController::class, 'getfokontany']);
    //region distric communes province 
    Route::get('/communes_etab/{district_id}', [DropdownEtabController::class, 'getCommunes']);
    Route::get('/fokontanis_etab/{commune_id}', [DropdownEtabController::class, 'getfokontany']);

    //cascade activites
    Route::get('/division_0/{section_id}', [casacade_0Controller::class, 'getDivisions']);
    Route::get('/groupe_0/{division_id}', [casacade_0Controller::class, 'getGroupes']);
    Route::get('/classe_0/{groupe_id}', [casacade_0Controller::class, 'getClasses']);
    Route::get('/categorie_0/{classe_id}', [casacade_0Controller::class, 'getCategories']);

    Route::get('/division_1/{section_id}', [casacade_1Controller::class, 'getDivisions']);
    Route::get('/groupe_1/{division_id}', [casacade_1Controller::class, 'getGroupes']);
    Route::get('/classe_1/{groupe_id}', [casacade_1Controller::class, 'getClasses']);
    Route::get('/categorie_1/{classe_id}', [casacade_1Controller::class, 'getCategories']);

    Route::get('/division_2/{section_id}', [casacade_2Controller::class, 'getDivisions']);
    Route::get('/groupe_2/{division_id}', [casacade_2Controller::class, 'getGroupes']);
    Route::get('/classe_2/{groupe_id}', [casacade_2Controller::class, 'getClasses']);
    Route::get('/categorie_2/{classe_id}', [casacade_2Controller::class, 'getCategories']);

    
    


    //etablissement
    Route::resource('reg_etab', Admin_reg_EtablissementController::class);
    Route::get('/search_list', [Admin_reg_EtablissementController::class, 'ft_search'])->name('search_list');
    Route::resource('quitance_reg',Quitance_regController::class);
    Route::get('quitance_reg_form',[Quitance_regController::class, 'affiche_form_quitance'])->name('quitance_reg_form');
    Route::post('quitance_reg_form_ft',[Quitance_regController::class, 'ajout_quitance'])->name('quitance_reg_form_ft');
    Route::get('carte_state/{id}',[Quitance_regController::class, 'carte_statistique'])->name('carte_state');

    //modification
    Route::resource('reg_modification', Admin_reg_modificationController::class);

    //Reenregistrement ReenregistrementReg_1Controller
    Route::resource('reg_enregistrement', ReenregistrementRegController::class);
    
    //mutation
    Route::resource('reg_mutation', Admin_reg_MutationController::class);
    Route::post('mutation_ft_admin_reg/{etab_id}/{prop_id}',[Admin_reg_MutationController::class, 'mutation_ft'])->name('mutation_ft_admin_reg');

    //mutation existant
    Route::resource('admin_reg_mutation_existant', AdminRegMutationExistantController::class);
    Route::get('/search_existant_admin/{id}', [AdminRegMutationExistantController::class, 'ft_search'])->name('search_existant_admin');
    Route::get('/mutation_prop_existant_admin/{etab_id}/{new_prop_id}', [AdminRegMutationExistantController::class, 'mutation_existant'])->name('mutation_prop_existant_admin');



  
    
});

