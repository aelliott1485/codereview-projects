<table width="100%" class="merger">
    @foreach ($MainOrganisations as $Main)
        <thead>
        <th>{{ $Main->address }}  </th>
        <th>
            @foreach($Main->Companies as $Companies)
                {{$Companies->name}} (Code: {{ $Companies->code }}) <br />
            @endforeach
        </th>

        </thead>
        <tbody>
        @foreach($Main->SubOrganisations as $Sub)
            <tr>
                <td>{{ $Sub->name }}</td>
                <td>{{ $Sub->code }}</td>
            </tr>

        @endforeach
        </tbody>

    @endforeach
</table>
