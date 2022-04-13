@extends('backend.layouts.app')

@section('title', __('Dashboard : Modification'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Modification d'un parrain
        </x-slot>

        <x-slot name="body">
            
            <div class="form">
                <form action="{{ route('admin.parrains.update', $parrain->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <fieldset class="fieldset">
                        <legend>Parrainage</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Prénom</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Ex : Mansour" value="{{ old('first_name') ?? $parrain->first_name }}">
                                    @error('first_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Nom</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Ex : Faye" value="{{ old('last_name') ?? $parrain->last_name }}">
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nce">Numéro de la carte d'electeur</label>
                                    <input type="number" name="nce" id="nce" class="form-control @error('nce') is-invalid @enderror" placeholder=" Ex: 000 000 000" value="{{ old('nce') ?? $parrain->nce }}">
                                    @error('nce')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nin">Numéro d'identification national</label>
                                    <input type="number" name="nin" id="nin" class="form-control @error('nin') is-invalid @enderror" placeholder="Ex : 0 000 0000 000000" value="{{ old('nin') ?? $parrain->nin }}">
                                    @error('nin')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="taille">Taille de l'electeur (en cm)</label>
                                    <input type="number" name="taille" id="taille" class="form-control @error('taille') is-invalid @enderror" placeholder="Ex : 123" value="{{ old('taille') ?? $parrain->taille }}">
                                    @error('taille')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="input-group">
                                    <input type="tel" class="form-control">
                                    <span class="input-group-addon">Tel</span>
                                </div> --}}
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Ex : 70 000 00 00" value="{{ old('phone') ?? $parrain->phone }}">
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-group ml-0 mr-0">
                                    <button type="submit" class="btn btn-block btn-success">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            
        </x-slot>
    </x-backend.card>
@endsection
