<thead>
    <tr>
        <th class="w-1">No.
        </th>
        @foreach($columns as $key => $value)
        @if($value['isData'])
        <th tabindex="0"rowspan="1" colspan="1" style="width: 159px;"  wire:click="doSort('{{ $value['column'] }}')">
            <x-datatable-column  :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="{{ $value['label'] }}" />
        </th>
        @else
        <th>{{ $value['label'] }}</th>
        @endif
        @endforeach
    </tr>
</thead>