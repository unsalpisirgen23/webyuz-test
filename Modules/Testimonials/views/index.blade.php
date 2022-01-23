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
            {!! import("admin.components.breadcrumb",['content'=>'Müşteri Yorumları']) !!}
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
                        @foreach($testimonials  as $testimonial)
                            <tr>

                                <td>
                                    {{$testimonial->name}}
                                </td>


                                <td>
                                    {!! $testimonial->status == 1 ? '<div class="btn bg-success color="" >Onaylı</div>' : '<div class="btn bg-warning" style="color:#eee">Onaysız</div>'  !!}
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-action mr-1"  href="{{route('modules.testimonials.edit',$testimonial->id)}}" onclick="confirm('Bu düzenlemek istediğinize eminmisiniz?') ? null :event.preventDefault() " title="Düzenle"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-info btn-action mr-1" type="button" data-toggle="modal" data-target="#exampleModal-{{$testimonial->id}}" title="Görünütle"><i class="fas fa-eye"></i></a>
                                    <!-- Bu alan ajax yapılacak -->
                                    <a class="btn btn-danger btn-action" href="" onclick="event.preventDefault();  confirm('Bu silmek istediğinize eminmisiniz?') ? document.getElementById('page-form-{{$testimonial->id}}').submit() : null " title="Sil"><i class="fas fa-trash"></i></a>
                                    <form id="page-form-{{$testimonial->id}}" action="{{ route('modules.testimonials.destroy',$testimonial->id) }}" method="POST" style="display: none;">
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

@foreach($testimonials  as $testimonial)
    <!-- Modal -->
    <div class="modal fade " id="exampleModal-{{$testimonial->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Slider Detay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <p><strong>Müşteri Adı : </strong>{{$testimonial->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Müşteri Resim : </strong><img src="{{$testimonial->img_url}}" width="50px" height="50px"></p>
                        </div>



                    </div>
                    <div class="row">



                        <div class="col-md-6">
                            <p><strong>Müşteri Yorum : </strong>{!!$testimonial->description!!}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Müşteri Durum : </strong>{{$testimonial->status == 1 ? "Aktif" : "Pasif"}}</p>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary btn-action w-100"  href="{{route('modules.testimonials.edit',$testimonial->id)}}" title="Düzenle"><i class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
@endforeach
