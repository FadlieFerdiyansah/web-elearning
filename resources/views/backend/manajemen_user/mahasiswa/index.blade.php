<x-app-layouts title="Users: Mahasiswa">
    @push('styles')
    {{-- dataTables --}}
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <style>
        div.dt-buttons {
            position: relative;
            /* float: left; */
            /* float: right; */
        }

        button#btn_delete {
            /* width: 120px; */
            /* position: relative; */
            height: 34px;
            float: left;
            box-shadow: none;
        }
        .dt-buttons{
            /* float: inline-end; */
            float: left;
            /* background: skyblue; */
            
        }
        .dataTables_length{
            /* background: saddlebrown; */
            margin-top: 50px;
            margin-left: -430px;
            float: left;
            /* display: none; */
        }

        @media (max-width: 1400px) {
            button#btn_delete {
                margin-bottom: 5px;
                float: left;
            }
            
            .dataTables_length{
                margin-top: 10px;
                margin-left: 0;
                float: left;
            }
        }
    </style>
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Tabel Mahasiswa</h4>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Mahasiswa</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <button type="button" name="btn_delete" id="btn_delete" class="btn btn-sm btn-danger">
                            <span>Delete Selected</span>
                        </button>
                        <table class="table table-hover" id="table-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Fakultas</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Action</th>
                                    <th><input type="checkbox" class="check_all"></th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('lastScript')

    <!-- Datatables -->
    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>

    <script>
        $(function() {
                $('#table-1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('mahasiswa.table') !!}',
                    lengthMenu: [[5,10,25,50,100,-1],[5,10,25,50,100,'All']],
                    columnDefs: [
                                {
                                    "targets": [0],
                                    "visible": true,
                                    "searchable": false
                                }
                            ],
                    stateSave: true,
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            exportOptions:{
                                columns: [0,2,3,4,5,6]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions:{
                                columns: [0,2,3,4,5,6]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions:{
                                columns: [0,2,3,4,5,6]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions:{
                                columns: [0,2,3,4,5,6]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions:{
                                columns: [0,2,3,4,5,6]
                            }
                        },
                    ],
                    select: true,
                    // order: [
                    //             {
                    //                 "targets": [1],
                    //                 "visible": false,
                    //                 "searchable": false
                    //             },
                    //             {
                    //                 "targets": [7],
                    //                 "visible": true,
                    //                 "searchable": false
                    //             }

                    // ],
                    columns: [
                        // { data: 'id', name: 'id' },
                        { data: 'id',sortable: false, 
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }  
                            },
                        { data: 'foto',
                            "render": function (data, type, full, meta) {
                                if(data == 'default.png'){
                                    return "<img src=\"/assets/images/"+ data + "\" height=\"50\"/>";
                                }else{
                                    return "<img src=\"/storage/"+ data + "\" height=\"50\"/>";
                                }
                            }
                        },
                        { data: 'nim'},
                        { data: 'nama'},
                        { data: 'fakultas.nama' },
                        { data: 'kelas.kd_kelas' },
                        { data: 'created_at', searchable:true },
                        { data: 'action', orderable: false, searchable: false},
                        // { data: 'checkbox', orderable: false, searchable: false}
                        {data:'nim', orderable: false, searchable: false,
                            "render": function(data,type,row) {
                                // console.log(row.id);
                                var html = "<input type='checkbox' name='nim[]' class='chk_boxes1' value="+ data +">"
                                return html
                            } 
                        },
                    ]
                });
            });
    </script>

    <script>
        $(document).ready(function(){
            $('.chk_boxes1').click(function(){
                if($(this).is(':checked')){
                    $(this).closest('tr').addClass('removeRow');
                } else {
                    $(this).closest('tr').removeClass('removeRow');
                }
            });
        
            $('#btn_delete').click(function(){
                if(confirm("Apakah Anda yakin ingin menghapus data ini?")){
                    let nim = [];
            
                    $(':checkbox:checked').each(function(i){
                    nim[i] = $(this).val();
                });
        
                // Jika data ada yang di checked
                if(nim.length === 0){
                    alert("Pilih minimal satu data");
                }else{
                    $.ajax({ url:'{!! route('mahasiswa.table') !!}', type:'delete', data:{ "_token": "{{ csrf_token() }}", nim:nim } });
                    window.location.href=window.location.href;
                }
                }
            });
        
            $('.check_all').click(function() {
                $('.chk_boxes1').prop('checked', this.checked);
                if($(this).is(':checked')){
                    $('.check').addClass('removeRow');
                } else {
                    $('.check').removeClass('removeRow');
                }
            });
        });
    </script>
    @endpush
</x-app-layouts>