<div class="list-group list-group-flush">
    <a
        href="{{ route('home') }}"
        class="list-group-item list-group-item-action {{ (request()->is('/')) ? 'active' : '' }}"
        >Dashboard</a
    >
    <a
        href="{{ route('pengumuman.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('pengumuman*')) || (request()->is('search/pengumuman*')) ? 'active' : '' }}"
        >Pengumuman</a
    >
    @if(Auth::user()->roles == 'Staff')
        <a
            href="{{ route('category.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('category*')) ? 'active' : '' }}"
            >Manajemen Kategori</a
        >
    @endif
    @if((Auth::user()->roles == 'Staff' || Auth::user()->roles == 'User'))
        <a
            href="{{ route('manajemenpembayaran.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('manajemenpembayaran*')) ? 'active' : '' }}"
            >Manajemen Pembelian</a
        >
    @endif
    <a
        href="{{ route('pembayaran.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('pembayaran*')) || (request()->is('search/pembayaran*')) ? 'active' : '' }}"
        >Pembelian</a
    >
    <a
        href="{{ route('pesan.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('pesan*')) || (request()->is('search/pesan*')) ? 'active' : '' }}"
        >Pesan</a
    >
    <a
        href="{{ route('account.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('account*')) ? 'active' : '' }}"
        >Akun Saya</a
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
