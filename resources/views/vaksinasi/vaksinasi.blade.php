@extends('layouts.app')

@section('title', "Vaksinasi | Puskesmas X Koto II")

@section('bread_crumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-syringe mr-2"></i>Vaksinasi</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('vaksinasi.tambah') }}" class="btn btn-success px-3">Tambah</a>
            <a href="#" class="btn btn-warning px-3">Print</a>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nik</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1.</td>
                    <td>12345667891234567</td>
                    <td>Immalatunil Khaira A.</td>
                    <td>Perempuan</td>
                    <td>imma@gmail.com</td>
                    <td class="text-center">
                        <a href="{{ route('vaksinasi.detail') }}" class="btn btn-primary">Detail</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2.</td>
                    <td>12345667891234567</td>
                    <td>Untung Jamari</td>
                    <td>Laki-laki</td>
                    <td>ari@gmail.com</td>
                    <td class="text-center">
                        <a href="{{ route('vaksinasi.detail') }}" class="btn btn-primary">Detail</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection