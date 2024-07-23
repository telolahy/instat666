@extends('layout.layout')

@section('title')
    Ajouter Fokontany
@endsection

@section('contenu')
    <div class="col-sm-12">
        <div class="card tabs-card">
            <div class="card-block p-0">
                <div class="tab-content card-block">
                    <div class="header" style="padding-bottom: 3%">
                        <h4 class="title" style="text-align: center">Ajout d'un Utilisateur</h4>
                    </div>

                    @if(session('message'))
                      <div class="alert alert-success">
                          {{ session('message') }}
                      </div>
                    @endif

                    @if(session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif

                    {{-- {!! Form::open([
                        'action' => 'App\Http\Controllers\UserController@ajout_user',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                        'id' => 'userForm',
                    ]) !!} --}}
                    <form action="{{ route('ajout_user') }}" method="POST" enctype = 'multipart/form-data'>
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Photo :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control form-control-bold form-control-center"
                                    name="image" id="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nom : <span style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-bold form-control-center"
                                    placeholder="Nom" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email : <span style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-bold form-control-center"
                                    placeholder="Email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Region : <span style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="region_id" id="region_user">
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">
                                            {{ $region->region }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rôle : <span style="color: red">*</span></label>
                            <div class="col-sm-10">
                                @if (auth()->user()->role == 'admin_par_region')
                                    <select class="form-control" required name="role" id="role">
                                        <option value="admin_par_region">admin_par_region</option>
                                        <option value="saisisseur">saisisseur</option>
                                    </select>
                                @else
                                    <select class="form-control" required name="role" id="role">
                                        <option value="super_admin">super_admin</option>
                                        <option value="admin_par_region">admin_par_region</option>
                                        <option value="saisisseur">saisisseur</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mot de passe : <span style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control form-control-bold form-control-center"
                                    placeholder="Mot de passe" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Confirmation du Mot de passe : <span
                                    style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control form-control-bold form-control-center"
                                    placeholder="Confirmer le mot de passe" name="password2" id="password2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                {{-- {{ Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_user']) }} --}}
                                <input type="submit" value="ajouter" class="btn btn-outline-primary">
                            </div>
                        </div>
                        {{-- {!! Form::close() !!} --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- tabs card end -->
@endsection

@section('script')
@endsection
