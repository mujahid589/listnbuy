@extends('layouts.backend.admin')
@section('title') {{ __('testimonial_list') }} @endsection
@section('content')
    <div class="container-fluid">
        @if (userCan('testimonial.create'))
        <div class="text-right mb-3">
            <a href="{{ route('module.ourteam.create') }}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Add our Teams</a>
        </div>
        @endif
        <div class="row">
            @forelse ($ourteams as $ourteam)
            <div class="col-md-3">
                <div class="card text-center">
                    @if ($ourteam->image)
                    <img src="{{ asset($ourteam->image) }}" class="card-img-top" alt="user image">
                    @else
                    <img src="{{ asset('backend/image/default.png') }}" class="card-img-top" alt="user image">
                    @endif
                    <div class="card-body">
                      <h4>{{ $ourteam->name }}</h4>
                      <h6 class="badge badge-primary">{{ $ourteam->position }}</h6>

                      <p class="card-text">{!! $ourteam->description !!}</p>
                      <div class="mx-auto justify-content-center align-items-center">
                            @if (userCan('testimonial.update'))
                            <a title="{{ __('edit_testimonial') }}" href="{{ route('module.ourteam.edit', $ourteam->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                          @endif
                          @if (userCan('testimonial.delete'))
                            <form
                            action="{{ route('module.ourteam.destroy', $ourteam->id) }}"
                            method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button title="{{ __('delete_testimonial') }}" onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                          @endif
                      </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-body">
                        <x-not-found word="ourteam" route="module.ourteam.create" />
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .card{
            border-radius: 10px;
        }
        .card img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 20px auto 0;

        }

        .btn-success{
            margin-top: 0;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
