<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Surat Permintaan Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 md:flex md:flex-row gap-4 ">

            <div class="bg-white max-w-2xl overflow-hidden shadow-sm sm:rounded-lg flex-auto">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('form.storesbb') }}">
                        @csrf
                        <div>
                            <x-label for="nama_barang" :value="__('Nama Barang')" />

                            <select name="nama_barang" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected>--Pilih Barang--</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang['id'] }}">{{ $barang['nama_barang'] }} - {{ $barang['satuan'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="jumlah_barang" :value="__('Jumlah Barang')" />

                            <x-input id="jumlah_barang" class="block mt-1 w-full" type="number" name="jumlah_barang" :value="old('jumlah_barang')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="peruntukan" :value="__('Peruntukan')" />

                            <textarea rows="4" id="peruntukan" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="peruntukan" required autofocus> </textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Tambahkan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white max-w-5xl overflow-hidden shadow-sm sm:rounded-lg flex-auto">
                <div class="p-6 bg-white">
                    <div class="my-3">
                        <div class="font-bold">
                            Nomor   : {{ $nomor_spb }}
                        </div>
                        <div class="font-bold">
                            Unit    : Direktorat Pengawasan Peredaran Pangan Olahan
                        </div>
                    </div>
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No</th>
                                <th class="border border-gray-800 px-2">No Urut Kartu</th>
                                <th class="border border-gray-800 px-2">Nama Barang</th>
                                <th class="border border-gray-800 px-2" align="right">Qty</th>
                                <th class="border border-gray-800 px-2">Satuan</th>
                                <th class="border border-gray-800 px-2">Keterangan</th>
                                <th class="border border-gray-800 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($current_spbs->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="7">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($current_spbs as $item)
                                <tr>
                                    <td class="border border-gray-800 px-2"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $item->nomor_kartu }}</td>
                                    <td class="border border-gray-800 px-2">{{ $item->nama_barang }}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{ $item->jumlah_pesanan }}</td>
                                    <td class="border border-gray-800 px-2">{{ $item->satuan }}</td>
                                    <td class="border border-gray-800 px-2">{{ $item->poksi }}</td>
                                    <td class="border border-gray-800 px-2 py-1">
                                        <form method="POST" action="{{ route('form.deleteItem') }}">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id_spbs }}">
                                            <button class="rounded bg-red-800 text-white px-1">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('form.storeallsbb') }}" class="mt-4">
                        @csrf
                        <div class="flex items-center justify-end">
                            <x-button class="ml-3">
                                {{ __('Ajukan') }}
                            </x-button>
                        </div>
                    </form>
                </div>  
            </div>
            
        </div>
    </div>
</x-app-layout>