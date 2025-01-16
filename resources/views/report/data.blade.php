@extends('layouts.app')
@push('css')
    {{--  --}}
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Data Report') }}</div>
                    <div class="card-body">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('hse_report.index') }}"
                                        class="p-3 rounded shadow-sm border bg-light">
                                        <h5 class="text-primary mb-3">Filter Reports</h5>

                                        <!-- Filter Tanggal -->
                                        <div class="form-group mb-3">
                                            <label for="date-range" class="form-label">Date Range</label>
                                            <div class="input-group">
                                                <input type="date" name="start_date" class="form-control" id="start_date"
                                                    value="{{ request('start_date') }}">
                                                <span class="input-group-text">to</span>
                                                <input type="date" name="end_date" class="form-control" id="end_date"
                                                    value="{{ request('end_date') }}">
                                            </div>
                                        </div>

                                        <!-- Filter Pelapor -->
                                        <div class="form-group mb-3">
                                            <label for="reported_by" class="form-label">Reported By</label>
                                            <div class="input-group">
                                                <select name="reported_by" class="form-control" id="reported_by">
                                                    <option value="">All Reporters</option>
                                                    @foreach ($reporters as $reporter)
                                                        <option value="{{ $reporter }}"
                                                            {{ request('reported_by') == $reporter ? 'selected' : '' }}>
                                                            {{ $reporter }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Filter Status -->
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <div class="input-group">
                                                <select name="status" class="form-control" id="status">
                                                    <option value="">All Status</option>
                                                    <option value="approve"
                                                        {{ request('status') == 'approve' ? 'selected' : '' }}>Approve
                                                    </option>
                                                    <option value="reject"
                                                        {{ request('status') == 'reject' ? 'selected' : '' }}>Reject
                                                    </option>
                                                    <option value="not_accept"
                                                        {{ request('status') == 'not_accept' ? 'selected' : '' }}>Not Accept
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Tombol Filter -->
                                        <button class="btn btn-primary mt-2" type="submit">
                                            <i class="fa fa-filter"></i> Apply Filters
                                        </button>
                                    </form>
                                </div>


                            </div>
                        </div>
                        <span>Jumlah Laporan:
                            {{ $reports->isNotEmpty() ? $reports->count() : 'Tidak tersedia' }} data</span>
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
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d-M-Y') }}</td>
                                        <td>{{ $item->inst_dept }}</td>
                                        <td>
                                            @php
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
