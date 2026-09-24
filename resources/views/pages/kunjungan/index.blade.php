@extends('layouts.app')

@section('title', 'Data Kunjungan Hari Ini')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            Data Kunjungan Hari Ini

            <small class="text-muted" style="font-size: 14px;">
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </small>
        </h1>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-bordered table-hover datatable"
                    width="100%"
                    cellspacing="0"
                >

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

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->pengunjung->nisn_nip ?? '-' }}
                            </td>

                            <td>
                                {{ $item->pengunjung->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->pengunjung->kelas_jabatan ?? '-' }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('M d, Y') }}
                            </td>

                            <td>
                                {{ $item->keperluan ?? '-' }}
                            </td>

                            <td>

                                <div class="d-flex justify-content-center align-items-center">

                                    {{-- Detail --}}
                                    <a
                                        href="{{ route('admin.kunjungan.show', encrypt($item->id_kunjungan)) }}"
                                        class="btn btn-link text-secondary p-0 mx-2"
                                        title="Detail"
                                    >
                                        <i class="fas fa-search"></i>
                                    </a>


                                    {{-- Hapus --}}
                                    <a
                                        href="javascript:void(0)"
                                        onclick="handleDestroy('{{ route('admin.kunjungan.destroy', $item->id_kunjungan) }}')"
                                        class="btn btn-link text-dark p-0 mx-2"
                                        title="Hapus"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-4">

                                <i
                                    class="fas fa-info-circle text-muted mb-2 d-block"
                                    style="font-size: 24px;"
                                ></i>

                                <span class="text-muted">
                                    Belum ada data kunjungan hari ini
                                </span>

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
<form
    id="form-destroy"
    method="POST"
    style="display: none;"
>

    @csrf

    @method('DELETE')

</form>

@endsection


@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}"
>


<style>

/* Judul */

h1 {
    font-size: 24px;
}

h1 small {
    font-weight: 400;
}


/* Card */

.card {
    border-radius: 18px !important;
    border: none !important;
}


/* Tabel */

.datatable {
    width: 100% !important;

    border-collapse: separate !important;
    border-spacing: 0 !important;

    border-radius: 18px !important;

    overflow: hidden !important;

    border: 1px solid #e2c3d1 !important;
}


/* Header tabel */

.datatable thead th {

    background-color: #efd2df !important;

    color: #222222 !important;

    font-weight: 600 !important;

    font-size: 15px !important;

    text-align: center !important;

    vertical-align: middle !important;

    padding: 15px 14px !important;

    border-top: none !important;

    border-bottom: 1px solid #d9b8c7 !important;

    border-right: 1px solid #d9b8c7 !important;

    white-space: nowrap;
}


/* Hilangkan tanda naik turun sorting */

.datatable thead th.sorting::before,
.datatable thead th.sorting::after,
.datatable thead th.sorting_asc::before,
.datatable thead th.sorting_asc::after,
.datatable thead th.sorting_desc::before,
.datatable thead th.sorting_desc::after {

    display: none !important;

}


/* Isi tabel */

.datatable tbody td {

    background-color: #ffffff !important;

    color: #334155 !important;

    font-size: 15px !important;

    padding: 16px 14px !important;

    vertical-align: middle !important;

    border-top: 1px solid #e4d6dc !important;

    border-right: 1px solid #e4d6dc !important;

    border-bottom: 1px solid #e4d6dc !important;

}


/* Baris terakhir */

.datatable tbody tr:last-child td {

    border-bottom: none !important;

}


/* Kolom terakhir */

.datatable tbody td:last-child {

    border-right: none !important;

}


/* Hover */

.datatable tbody tr:hover td {

    background-color: #fff8fb !important;

}


/* Kolom No */

.datatable th:first-child,
.datatable td:first-child {

    text-align: center !important;

}


/* Kolom Aksi */

.datatable th:last-child,
.datatable td:last-child {

    text-align: center !important;

    white-space: nowrap;

}


/* Icon aksi */

.datatable tbody td .fas {

    color: #000000 !important;

}


/* Tombol aksi */

.datatable tbody td .btn-link {

    color: #000000 !important;

    text-decoration: none !important;

    background: transparent !important;

    border: none !important;

    box-shadow: none !important;

}


.datatable tbody td .btn-link:hover {

    color: #555555 !important;

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