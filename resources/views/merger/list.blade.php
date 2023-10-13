<table width="100%" class="merger">
    @foreach ($MainOrganisations as $Main)
        <thead>
        <th>{{ $Main->address }}  </th>
        <th>
            @foreach($Main->companies as $company)
                {{$company->name}} (Code: {{ $company->code }}) <br />
            @endforeach
        </th>

        </thead>
        <tbody>
        @foreach($Main->subOrganisations as $sub)
            <tr>
                <td>{{ $sub->name }}</td>
                <td>{{ $sub->code }}</td>
            </tr>

        @endforeach
        </tbody>

    @endforeach
</table>
