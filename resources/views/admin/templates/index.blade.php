@extends("admin.layouts.app")
@section("style")
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
        #form-all-delete{

        }
    </style>
@endsection
@section("content")
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            {!! import("admin.components.breadcrumb",['content'=>'Temalar']) !!}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="myTable">
                        <thead>
                        <tr>
                            <th>Başlık</th>
                            <th style="width: 125px;">Durum</th>
                            <th style="width:145px;">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates  as $template)
                            <tr>

                                <td>
                                    {{$template->name}}
                                </td>


                                <td>
                                    {!! $template->status == 1 ? '<div class="btn bg-success color="" >Onaylı</div>' : '<div class="btn bg-warning" style="color:#eee">Onaysız</div>'  !!}
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-action mr-1"  href="{{route('admin.templates.edit',$template->id)}}" onclick="confirm('Bu düzenlemek istediğinize eminmisiniz?') ? null :event.preventDefault() " title="Düzenle"><i class="fas fa-pencil-alt"></i></a>
                                    <!-- Bu alan ajax yapılacak -->
                                    <a class="btn btn-danger btn-action" href="" onclick="event.preventDefault();  confirm('Bu silmek istediğinize eminmisiniz?') ? document.getElementById('page-form-{{$template->id}}').submit() : null " title="Sil"><i class="fas fa-trash"></i></a>
                                    <form id="page-form-{{$template->id}}" action="{{ route('admin.templates.destroy',$template->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("script")
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
                },
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                } ]
            });
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session("error"))
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{session("error")}}',
            showConfirmButton: false,
            timer: 1500
        })
        @endif
        @if(session("success"))
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{session("success")}}',
            showConfirmButton: false,
            timer: 1500
        })
        @endif
    </script>
@endsection


