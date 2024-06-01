<div>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">طلبات الشراء</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body page-layout-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="tab-content mt-4 mb-4">
                    <!-- Tab: My Contacts -->
                    <div class="tab-pane fade active show" id="contact_all" role="tabpanel">
                        <div class="card overflow-hidden">
                            <div id="contact_list_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row dt-row">
                                    <div class="col-sm-12">
                                        <div class="row row-cards">
                                            <div class="col-12">
                                               <x-table :columns="$columns" :page="$page" :perPage="$perPage" :items="$orders" :sortColumn="$sortColumn" :sortDirection="$sortDirection" isModalDelete="true" isModalEdit="true" isModalView="true" >
                                               </x-table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@livewire('Order.Edit')
@livewire('Order.View')
</div>
