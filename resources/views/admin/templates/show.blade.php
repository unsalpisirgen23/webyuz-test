@extends("admin.layouts.app")
@section("style")

@endsection
@section("content")
    <div id="app">
        <section class="section">
            {!! import("admin.components.breadcrumb",['content'=>'Sayfa']) !!}
            <div class="section-body">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Son Eklenen Sayfa</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>Sayfa Adı</th>
                                        <th style="width: 125px;">Durum</th>
                                        <th style="width:140px;" >İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{ $page->title }}
                                        </td>

                                        <td>
                                            {!! $page->status == 1 ? '<div class="btn bg-success color="" >Onaylı</div>' : '<div class="btn bg-warning" style="color:#eee">Onaysız</div>'  !!}
                                        </td>


                                        <td>
                                            <a class="btn btn-primary btn-action mr-1"  href="{{route('admin.pages.edit',$page->id)}}" onclick="confirm('Bu düzenlemek istediğinize eminmisiniz?') ? null :event.preventDefault() " title="Düzenle"><i class="fas fa-pencil-alt"></i></a>
                                            <!-- Bu alan ajax yapılacak -->
                                            <a class="btn btn-danger btn-action" href="" onclick="event.preventDefault();  confirm('Bu silmek istediğinize eminmisiniz?') ? document.getElementById('page-form-{{$page->id}}').submit() : null " title="Sil"><i class="fas fa-trash"></i></a>
                                            <form id="page-form-{{$page->id}}" action="{{ route('admin.pages.destroy',$page->id) }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section("script")
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
