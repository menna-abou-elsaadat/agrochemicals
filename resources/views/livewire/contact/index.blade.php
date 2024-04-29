<div>
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
                                               <x-table :columns="$columns" :page="$page" :perPage="$perPage" :items="$contacts" :sortColumn="$sortColumn" :sortDirection="$sortDirection" isModalEdit="true">
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
@livewire('Contact.Edit')
</div>
