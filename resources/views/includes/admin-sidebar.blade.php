<div class="list-group list-group-flush">
    <a
        href="{{ route('admin-dashboard') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}"
        >Dashboard</a
    >
    <a
        href="{{ route('category.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : '' }}"
        >Manajemen Kategori</a
    >
    <a
        href="{{ route('announcement.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin/announcement*')) ? 'active' : '' }}"
        >Manajemen Pengumuman</a
    >
    <a
        href="{{ route('user.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : '' }}"
        >Manajemen Role Pengguna</a
    >
    <a
        href="{{ route('admin-trash') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin/trash*')) ? 'active' : '' }}"
        >Arsip</a
    >
    <a
        href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="list-group-item list-group-item-action text-danger"
        >Keluar</a
    >
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>