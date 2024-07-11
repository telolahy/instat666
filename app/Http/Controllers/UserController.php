<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function affiche_form_user()
    {
        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')->select('region')
                ->where('region', '=', Auth()->user()->region_user)->distinct()->get();
        } else {
            $communes = DB::table('communes')->select('region')->distinct()->get();
        }
        return view('user.ajout_user')->with('communes', $communes);
    }

    public function ajout_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password2' => 'required',
        ]);

        $verif_email = DB::table('users')
            ->select('email')
            ->where('email', '=', $request->input('email'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_email) && $verif_email->email == $request->input('email')) {
            return response()->json([
                'status' => 400,
                'error' => " Email existe deja !!! ",
            ]);
        } else if ($request->input('password') != $request->input('password2')) {
            return response()->json([
                'status' => 400,
                'error' => " Les mots de passe que vous avez saisit sont differents !!! ",
            ]);
        } else {

            if ($request->hasFile('image')) {
                //get filename with ext
                //$fileNameWithExt = $request->file('image')->getClientOriginalName();
                //get just filename
                //$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just file extension
                //$extension = $request->file('image')->getClientOriginalExtension();
                //file name to store
                //$fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //uploader l'image
               // $path = $request->file('image')->storeAs('public/user_images', $fileNameToStore);
               $file= $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move('assets/images/auth/', $fileName);

                $filePath ='/' . $fileName;
            } else {
                $fileName = 'noimage.jpg';
            }

            $user = new User();

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->region_user = $request->input('region_user');
            $user->role = $request->input('role');
            $user->image = $filePath;
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => " Utilisateur ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_user()
    {
        if (Auth()->user()->role == "admin_par_region") {
            $users = User::where('region_user', Auth()->user()->region_user)->get();
        } else {
            $users = User::all();
        }

        return view('user.list_user')->with('users', $users);
    }

    public function supprimer_user($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => "Utilisateur supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_user($id)
    {
        $user = User::find($id);
        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')->select('region')
                ->where('region', '=', Auth()->user()->region_user)->distinct()->get();
        } else {
            $communes = DB::table('communes')->select('region')->distinct()->get();
        }
        return view('user.edit_user')->with('user', $user)->with('communes', $communes);
    }

    public function modifier_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password2' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else if ($request->input('password') != $request->input('password2')) {
            return response()->json([
                'status' => 400,
                'error' => " Les mots de passe que vous avez saisit sont differents !!! ",
            ]);
        } else {

            if ($request->hasFile('image')) {
                //get filename with ext
                // $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //get just filename
                // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just file extension
                // $extension = $request->file('image')->getClientOriginalExtension();
                //file name to store
                // $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //uploader l'image
                // $path = $request->file('image')->storeAs('public/user_images', $fileNameToStore);
                $file= $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move('assets/images/auth/', $fileName);

                $filePath ='/' . $fileName;
            } else {
                $fileName = 'noimage.jpg';
            }

            $user = User::find($request->input('id'));
            $user->name = $request->input('name');
            $user->region_user = $request->input('region_user');
            $user->role = $request->input('role');
            $user->image = $filePath;
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => " Utilisateur modifié avec succèss !!!",
            ]);
        }
    }


    public function profile()
    {
        return view('profile');
    }
}
