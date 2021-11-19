<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan SPB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                    
                    <div class="mt-4 mb-4">
                        <a class="bg-transparent px-3 py-1 rounded text-center text-green-600 hover:text-white font-semibold hover:bg-green-400 border border-green-400" href="{{ route('form.spb') }}">Tambah Surat Pemesanan Barang</a>
                    </div>
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No</th>
                                <th class="border border-gray-800 px-2">No SPB</th>
                                <th class="border border-gray-800 px-2">Tanggal Aju</th>
                                <th class="border border-gray-800 px-2">Pengaju</th>
                                <th class="border border-gray-800 px-2">Disetujui</th>
                                <th class="border border-gray-800 px-2">Pengadaan</th>
                                <th class="border border-gray-800 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                             @if(is_null($daftaraju))
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="8">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($daftaraju as $aju)
                                <tr>
                                    <td class="border border-gray-800 px-2 py-1"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $aju->nomor_spb }}</td>
                                    <td class="border border-gray-800 px-2">{{ date('d F Y', $aju->epoch_spb) }}</td>
                                     <td class="border border-gray-800 px-2 py-1">{{ $pemesan->poksi }}</td>
                                    <td class="border border-gray-800 px-2">
                                        <?= ( !$aju->isApproved ? '<div class="text-white bg-gray-900 rounded p-1 text-xs text-center font-semibold uppercase">Belum</div>' :  '<div class="text-white bg-green-500 rounded p-1 text-xs text-center font-semibold uppercase">Sudah</div>' ) ?>
                                    </td>
                                    <td class="border border-gray-800 px-2">
                                        @if($aju->isRealisasi)
                                        <div class="text-white bg-green-500 rounded p-1 text-xs text-center font-semibold uppercase">Sudah</div>
                                        @else
                                        <div class="text-white bg-gray-900 rounded p-1 text-xs text-center font-semibold uppercase">Belum</div>
                                        @endif
                                    </td>
                                    <td class="border border-gray-800 px-2">
                                        <a href="{{ route('daftar.ajus.spb', $aju->nomor_spb) }}" class="hover:text-blue-800 hover:underline rounded px-1 bg-gray-200 text-blue-400">detail</a> 

                                        @can('superadmin')
                                            @if(!$aju->isRealisasi && $aju->isApproved)
                                                | <a href="{{ route('daftar.ajus.realisasi', $aju->nomor_spb) }}" class="hover:text-blue-800 hover:underline rounded px-1 bg-gray-200 text-blue-400">realisasi</a>
                                            @elseif($aju->isRealisasi && $aju->isApproved)
                                                @if(!$aju->isSbbk)
                                                 | <a href="{{ route('daftar.ajus.sbbk.view', $aju->nomor_spb) }}" class="hover:text-blue-800 hover:underline rounded px-1 bg-gray-200 text-blue-400">buat SBBK</a>
                                                @endif
                                            @endif
                                        @endcan

                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(null !== $daftaraju)
                    <p class="mt-4 text-center">
                        {{ $daftaraju->onEachSide(5)->links() }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>