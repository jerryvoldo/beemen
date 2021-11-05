<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Item Kartu Stok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 md:flex md:flex-row gap-4 ">
            <div class="bg-white max-w-2xl overflow-hidden shadow-sm sm:rounded-lg flex-auto">
                <div class="p-6 bg-white">
                    <form method="POST" action="{{ route('form.stok.item.simpan') }}">
                        @csrf
                        <div>
                            <x-label for="nomor_kartu" :value="__('Nomor Kartu')" />
                            <x-input id="nomor_kartu" class="block mt-1 w-full" type="number" name="nomor_kartu" :value="old('nomor_kartu')" value="{{ $max_id }}" required autofocus readonly />
                        </div>

                        <div class="mt-4">
                            <x-label for="nama_barang" :value="__('Nama Barang')" />

                            <x-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="satuan" :value="__('Satuan Barang')" />

                            <x-input id="satuan_barang" class="block mt-1 w-full" type="text" name="satuan_barang" :value="old('satuan_barang')" required autofocus />
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
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No Urut Kartu</th>
                                <th class="border border-gray-800 px-2">Nama Barang</th>
                                <th class="border border-gray-800 px-2">Satuan</th>
                                <th class="border border-gray-800 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($barangs->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="4">Belum ada data</td>
                            </tr>
                            @else
                                @foreach($barangs as $item)
                                <tr>
                                    <td class="border border-gray-800 px-2">{{ $item->nomor_kartu }}</td>
                                    <td class="border border-gray-800 px-2">{{ $item->nama_barang }}</td>
                                    <td class="border border-gray-800 px-2">{{ $item->satuan }}</td>
                                    <td class="border border-gray-800 px-2">
                                        <form method="POST" action="{{ route('form.stok.item.hapus') }}">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <button class="rounded bg-red-800 text-white px-1">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p class="mt-4">
                        {{ $barangs->onEachSide(5)->links() }}
                    </p>
                 </div>
             </div>
        </div>
    </div>
</x-app-layout>