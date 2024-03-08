@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('buttom')
    @if (auth()->user()->type == 'admin')
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    @endif
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (auth()->user()->type == 'admin')
                <a href="{{ route('bill.create') }}" class="btn btn-success btn-sm btn-icon-split">
                    <span class="text">Nuevo gasto</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->date }}</td>
                                <td>{{ $bill->amount }}</td>
                                <td>
                                    <a href="{{ route('bill.show', $bill) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('bill.edit', $bill) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('bill.destroy', $bill) }}" method="post"
                                        style="display: inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (session('fail'))
        <script>
            Swal.fire({
                title: 'Error',
                text: '{{ session('fail') }}',
                icon: 'error',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @elseif (session('success'))
        <script>
            Swal.fire({
                title: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @endif
@endsection
