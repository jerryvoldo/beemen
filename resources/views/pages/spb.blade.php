<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Surat Permintaan Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('form.storesbb') }}">
                        @csrf
                        <div>
                            <x-label for="nama_barang" :value="__('Nama Barang')" />

                            <select name="nama_barang" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected>--Pilih Barang--</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang['id'] }}">{{ $barang['nama_barang'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="jumlah_barang" :value="__('Jumlah Barang')" />

                            <x-input id="jumlah_barang" class="block mt-1 w-full" type="number" name="jumlah_barang" :value="old('jumlah_barang')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="peruntukan" :value="__('Peruntukan')" />

                            <textarea id="peruntukan" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="peruntukan" required autofocus> </textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
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