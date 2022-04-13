@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <h2>Listes des parrains</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Taille</th>
                        <th>NCE</th>
                        <th>NIN</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parrains as $parrain)
                    <tr>
                        <td>{{ $parrain->id }}</td>
                        <td>{{ $parrain->last_name }}</td>
                        <td>{{ $parrain->first_name }}</td>
                        <td>{{ $parrain->taille }}</td>
                        <td>{{ $parrain->nce }}</td>
                        <td>{{ $parrain->nin }}</td>
                        <td>{{ $parrain->phone }}</td>
                        <td>
                            <a href="{{ route('admin.parrains.edit', $parrain->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" 
                            class="btn btn-sm btn-danger delete-parrain-btn"
                            data-id="{{$parrain->id}}" 
                            {{-- onclick="if(alert('123')){document.('delete-parrain-{{$parrain->id}}').submit();}" --}}
                            >
                                <i class="fa fa-trash"></i>
                                <form action="{{ route('admin.parrains.destroy', $parrain->id) }}" method="POST" class="d-none" id="delete-parrain-{{$parrain->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
