<div class="table-responsive">
    <table class="table" id="mascotas-table">
        <thead>
            <tr>
                <th>Nom</th>
        <th>Tipus</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mascotas as $mascota)
            <tr>
                <td>{{ $mascota->nom }}</td>
            <td>{{ $mascota->tipus }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['mascotas.destroy', $mascota->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('mascotas.show', [$mascota->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('mascotas.edit', [$mascota->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
