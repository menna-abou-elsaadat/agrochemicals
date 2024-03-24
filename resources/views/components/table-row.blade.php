@props(['item', 'key', 'page', 'perPage', 'columns', 'isModalEdit' => false, 'isModalDelete' => false,'isModalView' => false,  'routeEdit'=> null, 'routeView'=> null])

<tr wire:key="{{ $item->id . $page }}">
    <td class="">{{ ++$key + $perPage * ($page - 1) }}.</td>
    @foreach ($columns as $column)
    <td style="width: 159px;">
      
        @if ($column['isData'])
        {!! $this->customFormat($column['column'], $column['hasRelation'] ? $item->{$column['column']}->{$column['columnRelation']} : $item->{$column['column']}) !!}
        @elseif ($column['column'] === 'action')
        <div class="flex gap-1 items-center justify-center">
           @if($isModalView)
            <!-- <button data-bs-toggle="modal" data-bs-target="#view_user" type="button" class="btn btn-link btn-sm color-400" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="عرض">عرض</button> -->
            <button wire:loading.attr="disabled" wire:click="view({{ $item->id }})" class="btn btn-link btn-sm color-400">
                عرض
            </button>
            @endif
            @if($isModalEdit)
            <button wire:loading.attr="disabled" wire:click="edit({{ $item->id }})" class="btn btn-link btn-sm color-400">
                تعديل
            </button>
            <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#edit_user_{{$item->id}}" class="btn btn-link btn-sm color-400" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="تعديل">تعديل</button> -->
            @endif
            @if($isModalDelete)
            <button type="button" class="btn btn-link btn-sm color-400 delete_object" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="حذف" data-object-id = "{{$item->id}}" data-message="سوف يتم حذف كل شىء متعلق بهذا هل تريد الاستمرار؟" data-function="remove">حذف</button>
            @endif
        </div>
        @endif
    </td>
    @endforeach
</tr>