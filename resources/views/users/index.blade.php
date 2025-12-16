@extends('layouts.dashboard')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar User</h2>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-4 font-medium text-gray-600">No</th>
                    <th class="p-4 font-medium text-gray-600">Nama</th>
                    <th class="p-4 font-medium text-gray-600">Email</th>
                    <th class="p-4 font-medium text-gray-600">Role</th>
                    <th class="p-4 font-medium text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4 text-gray-800 font-medium">{{ $item->name }}</td>
                    <td class="p-4 text-gray-600">{{ $item->email }}</td>
                    <td class="p-4 text-gray-600">
                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $item->role === 'superadmin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($item->role) }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <a href="{{ route('users.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        @if(auth()->user()->id !== $item->id)
                            <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
