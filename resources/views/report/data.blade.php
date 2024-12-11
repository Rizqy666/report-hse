@extends('layouts.app')
@push('css')
    {{--  --}}
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('FORMULIR PEDULI HSE') }}</div>
                    <div class="card-body">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('hse_report.index') }}">
                                        <div class="input-group">
                                            <input type="date" name="start_date" class="form-control" required>
                                            <span class="input-group-text">to</span>
                                            <input type="date" name="end_date" class="form-control" required>
                                            <button class="btn btn-sm btn-primary" type="submit">Filtering</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <table id="example" class="table table-striped border-black" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Reporty By</th>
                                    <th>Tanggal</th>
                                    <th>Inst</th>
                                    <th>Status Kodindisi</th>
                                    <th>Status Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $item)
                                    <tr>
                                        <td>{{ $item->reported_by }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->inst_dept }}</td>
                                        <td>
                                            @php
                                                // Mengubah string kembali menjadi array
                                                $condition_status = explode(', ', $item->condition_status);
                                            @endphp

                                            @if (in_array('Unsafe Condition', $condition_status))
                                                <span class="badge bg-danger">Unsafe Condition</span>
                                            @endif
                                            @if (in_array('Unsafe Act', $condition_status))
                                                <span class="badge bg-warning">Unsafe Act</span>
                                            @endif
                                            @if (in_array('Safe Condition', $condition_status))
                                                <span class="badge bg-success">Safe Condition</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->feedback === 'reject')
                                                <span class="badge bg-danger">Reject</span>
                                            @elseif ($item->feedback === 'approve')
                                                <span class="badge bg-success">Approve</span>
                                            @else
                                                <span class="badge bg-secondary">Not Accept</span>
                                            @endif
                                        </td>


                                        <td>
                                            <div>
                                                <a href="{{ route('hse_report.show', $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa-solid fa-eye"></i> Show
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Reporty By</th>
                                    <th>Tanggal</th>
                                    <th>Inst</th>
                                    <th>Status Kodindisi</th>
                                    <th>Status Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{--  --}}
@endpush
