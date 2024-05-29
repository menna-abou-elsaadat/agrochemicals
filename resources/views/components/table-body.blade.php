@props(['items', 'columns', 'page', 'perPage', 'isModalEdit' => false, 'isModalDelete' => false,
'isModalView' => false, 'routeEdit'=> null, 'routeView' => null,'redirectToPage' => false, 'redirectToPageRoute' => null])

<tbody>
    @if ($items->isEmpty())
        <tr class="text-center">
            <td class="p-5 border text-sm" :colspan="{{ count($columns) + 1 }}">No Data Displayed.</td>
        </tr>
    @endif
    
    @foreach($items as $key => $item)
    <x-table-row :routeView="$routeView" :routeEdit="$routeEdit" :isModalEdit="$isModalEdit" :isModalDelete="$isModalDelete"  :isModalView="$isModalView"  :item="$item" :columns="$columns" :key="$key" :page="$page" :perPage="$perPage" :redirectToPage="$redirectToPage" :redirectToPageRoute="$redirectToPageRoute" />
    @endforeach

</tbody>