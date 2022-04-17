@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">

            @lang('Welcome :Name', ['name' => $logged_in_user->name])
            <span data-href="{{ route('admin.exportcsv') }}" id="export" class="btn btn-success btn-sm ml-4" onclick="exportTasks(event.target);">Exporter CSV</span>
            <span data-href="{{ route('admin.exportExcel') }}" id="exportExcel" class="btn btn-success btn-sm ml-2" onclick="exportTasks(event.target);">Exporter Excel</span>
        </x-slot>

        <x-slot name="body">
            <h2>Listes des parrains</h2>
            <table class="table display nowrap table-striped table-hover" id="table_parrains">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Prénom(s) et Nom</th>
                        <th>Numéro de la carte d'électeur</th>
                        <th>Numéro d'identification national</th>
                        <th>Taille de l'électeur</th>
                        <th>Téléphone</th>
                        <th>Inscris le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parrains as $parrain)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($parrain->first_name.' '.$parrain->last_name) }}</td>
                        <td>{{ $parrain->nce }}</td>
                        <td>{{ $parrain->nin }}</td>
                        <td>{{ $parrain->taille }}</td>
                        <td>{{ $parrain->phone }}</td>
                        <td>{{ $parrain->created_at->format('d m Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.parrains.edit', $parrain->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger" data-id="{{$parrain->id}}" onclick="if(confirm('Êtes-vous sûr de Vouloir supprimer ce parrain ?')){event.preventDefault();document.getElementById('delete-parrain-{{$parrain->id}}').submit();}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form action="{{ route('admin.parrains.destroy', $parrain->id) }}" method="POST" class="d-none" id="delete-parrain-{{$parrain->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script defer>
    function exportTasks(_this) {
       let _url = $(_this).data('href');
       window.location.href = _url;
    }

    function deleteParrain(e) {
        e.preventDefault()
        let id = e.target.dataset.id
        if (confirm('Êtes-vous sûr de Vouloir supprimer ce parrain ?')) {
            let form = $('#delete-parrain-' + id)
            form.submit()
        }else{
            console.log(false)
        }
    }

    $(document).ready(() => {
        window.$('#table_parrains').DataTable({
            "order": [0, 'asc'],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: 'column',
                    target: 'tr'
                }
            }
        });
    });


 </script>
@endpush