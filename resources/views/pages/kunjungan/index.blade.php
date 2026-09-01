@extends('layouts.app')

@section('title', 'Data Kunjungan Hari Ini')

@section('content')

<div class="container-fluid">

    {{-- Judul Halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            Data Kunjungan Hari Ini
            <small class="text-muted" style="font-size: 14px;">
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </small>
        </h1>
    </div>

    {{-- Card Data Kunjungan --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover datatable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP/NISN</th>
                            <th>Nama</th>
                            <th>Kelas/Jabatan</th>
                            <th>Tanggal</th>
                            <th>Keperluan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                       @forelse ($kunjungan as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pengunjung->nisn_nip ?? '-' }}</td>
                            <td>{{ $item->pengunjung->nama ?? '-' }}</td>
                            <td>{{ $item->pengunjung->kelas_jabatan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('M d, Y') }}</td>
                            <td>{{ $item->keperluan ?? '-' }}</td>

                            <td>
                                <div class="d-flex justify-content-center align-items-center">

                                    {{-- Detail --}}
                                    <a href="{{ route('admin.kunjungan.show', encrypt($item->id_kunjungan)) }}"
                                    class="btn btn-link text-secondary p-0 mx-2"
                                    title="Detail">
                                        <i class="fas fa-search"></i>
                                    </a>

                                    {{-- Hapus --}}
                                    <a href="javascript:void(0)"
                                    onclick="handleDestroy('{{ route('admin.kunjungan.destroy', $item->id_kunjungan) }}')"
                                    class="btn btn-link text-dark p-0 mx-2"
                                    title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-info-circle text-muted mb-2 d-block" style="font-size: 24px;"></i>
                                <span class="text-muted">Belum ada data kunjungan hari ini</span>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>


{{-- Form Hapus --}}
<form id="form-destroy" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection


@push('styles')

<link rel="stylesheet"
      href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">

<style>

    /* Judul */
    h1 {
        font-size: 24px;
    }
    
    h1 small {
        font-weight: 400;
    }

    /* Header tabel */
    .datatable thead th {
        background-color: #e1b9ca;
        color: #000000;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
    }

    /* Isi tabel - data jadi hitam */
    .datatable tbody td {
        vertical-align: middle;
        font-size: 13px;
        color: #000000 !important;
    }

    /* Kolom nomor dan aksi */
    .datatable th:first-child,
    .datatable td:first-child {
        text-align: center;
    }

    .datatable th:last-child,
    .datatable td:last-child {
        text-align: center;
    }

    /* Card */
    .card {
        border-radius: 8px;
    }

    /* Search DataTables */
    .dataTables_filter {
        position: relative;
    }

    .dataTables_filter label {
        position: relative;
    }

    .dataTables_filter input {
        border: 2px solid #777;
        border-radius: 20px;
        padding: 7px 40px 7px 15px;
        margin-left: 0;
        width: 200px;
        height: 36px;
        font-size: 12px;
        outline: none;
    }

    .dataTables_filter input::placeholder {
        color: #cfd4df;
        font-weight: 600;
    }

    .dataTables_filter label::after {
        content: "\f002";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 15px;
        pointer-events: none;
    }

    /* Pagination */
    .page-item.active .page-link {
        background-color: #e479a5;
        border-color: #e479a5;
        color: #000;
    }

    .page-link {
        color: #000;
    }

    /* Icon di dalam tabel */
    .datatable tbody td .fas {
        color: #000000 !important;
    }

    /* Link di dalam tabel */
    .datatable tbody td .btn-link {
        color: #000000 !important;
    }

    .datatable tbody td .btn-link:hover {
        color: #555555 !important;
    }

</style>

@endpush


@push('scripts')

<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>

    $('.datatable').DataTable({
        "language": {
            "search": "",
            "searchPlaceholder": "Cari NIP/NISN, Nama...",
            "lengthMenu": "Tampilkan _MENU_ data",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Tidak ada data",
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        }
    });


    function handleDestroy(url) {

        Swal.fire({
            title: "Apakah kamu yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            confirmButtonColor: "#d33"
        }).then((result) => {

            if (result.isConfirmed) {

                $('#form-destroy').attr('action', url);
                $('#form-destroy').submit();

            }

        });

    }

</script>


@if(Session::has('success'))

<script>

    Swal.fire({
        title: "Berhasil!",
        text: "{{ Session::get('success') }}",
        icon: "success",
        timer: 2000,
        showConfirmButton: false
    });

</script>

@endif

@endpush