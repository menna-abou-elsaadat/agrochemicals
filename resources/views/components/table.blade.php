@props([
'sortColumn',
'items',
'columns',
'page',
'perPage',
'sortDirection',
'isModalEdit' => false,
'isModalDelete' => false,
'isModalView' => false,
'routeEdit' => null,
'routeView' => null,
])
<div class="card">
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <!-- <div class="text-muted">
                Show
                <div class="mx-2 d-inline-flex">
                    <p class="badge badge-secondary" wire:model.live="perPage" id="perPage"> {{ $perPage }}</p>
                </div>
                entries
            </div> -->
            <!-- <div class="ms-auto text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control form-control-sm"
                    aria-label="Search invoice">
                </div>
            </div> -->
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0 card-table nowrap dataTable no-footer dtr-inline" style="width: 100%;">
            <x-table-head :columns="$columns" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
            <x-table-body :isModalEdit="$isModalEdit" :isModalView="$isModalView" :isModalDelete="$isModalDelete" :routeEdit="$routeEdit" :routeView="$routeView" :items="$items" :columns="$columns" :page="$page"
            :perPage="$perPage" />
        </table>
    </div>
    <div class="card-footer d-flex align-items-center">
        <div class="d-flex">
            <div class="d-flex gap-4 align-items-center mb-3">
                <select class="form-select" wire:model.live="perPage" id="perPage">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                <label for="perPage">بالصفحة</label>
            </div>
        </div>
        {{ $items->links() }}
        
    </div>
    
</div>