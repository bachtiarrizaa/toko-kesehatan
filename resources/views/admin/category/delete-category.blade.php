@extends('layouts.admin')
@section('container')
<form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
    @csrf
    @method('DELETE')
    <div class="item text-danger delete">
        <i class="icon-trash-2"></i>
    </div>
</form>

@endsection