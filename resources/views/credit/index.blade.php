@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('buttom')
    @if (auth()->user()->type == 'admin')
        <a href="{{ route('credit.pdfreportcredit') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            target="_blank">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    @endif
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('credit.create') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Nuevo</span>
            </a>
            <a href="{{ route('credit.report') }}" class="btn btn-danger btn-sm btn-icon-split">
                <span class="text">Vencidos</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Saldo</th>
                            <th>Cuotas pendiente</th>
                            <th>Estado</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($fail)
                            <tr>
                                <div class="card mb-4 py-3 border-bottom-danger">
                                    <div class="card-body">
                                        {{ $fail }}
                                    </div>
                                </div>

                            </tr>
                        @endisset
                        @foreach ($credits as $credit)
                            @if ($credit->balance > 0 && strtotime(date('Y-m-d', time())) > strtotime($credit->customer->credit[0]->expiration_date))
                            @endif
                            <tr>

                                <td>{{ $credit->id }}</td>
                                <td>{{ $credit->customer->credit[0]->date }}</td>
                                <td>{{ $credit->customer->fullname }}</td>
                                <td>{{ number_format($credit->amount, 0, '', '.') }}</td>
                                <td>{{ number_format($credit->balance, 0, '', '.') }}</td>
                                <td>{{ $credit->quota_number_pendieng }}</td>
                                <td>
                                    @if ($credit->balance > 0 && strtotime(date('Y-m-d', time())) > strtotime($credit->customer->credit[0]->expiration_date))
                                        <button class="btn btn-sm btn-danger shadow-sm">vencido</button>
                                </td>
                            @elseif ($credit->balance == 0)
                                <button class="btn btn-sm btn-info shadow-sm">Cancelado</button></td>
                            @else
                                <button class="btn btn-sm btn-success shadow-sm">Al dia</button></td>
                        @endif
                        <td>
                            <a href="{{ route('cliente.show', $credit->customer->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if (auth()->user()->type == 'admin')
                                <a href="{{ route('credit.edit', $credit) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('credit.delete', $credit) }}" method="post"
                                    style="display: inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            @endif

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
                title: 'Informacion guardada',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @elseif (session('info'))
        <script>
            Swal.fire({
                title: 'Prestano no generado',
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @endif
@endsection
