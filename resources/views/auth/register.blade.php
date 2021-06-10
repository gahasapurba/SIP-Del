@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

@php
    use RealRashid\SweetAlert\Facades\Alert;
    if($errors->any())
    {
        alert()->error('Kesalahan Pengisian Data','Silahkan Ulangi Mengisi Data');
    }
@endphp

<div
    class="row align-items-center justify-content-center row-login"
>
    <div class="col-lg-6 text-center">
        <img
            src="/images/logo2.png"
            alt="Login Placeholder"
            class="mb-4 mb-lg-none w-75"
        />
    </div>
    <div class="col-lg-5 mt-5">
        <h2>
            Mengelola pembelian, <br />
            dengan cara efektif
        </h2>
        <form method="POST" action="{{ route('register') }}" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input
                    id="name"
                    name="name"
                    v-model="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama anda"
                    autofocus
                />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    v-model="email"
                    @change="checkForEmailAvailability()"
                    type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    :class="{ 'is-invalid' : this.email_unavailable }"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email anda"
                />
                <small>Kami akan mengirimkan link verifikasi, melalui email yang anda masukkan</small>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password anda"
                    data-toggle="password"
                />
                @error('password')
                    <small class="text-danger"><b>{{ $message }}</b></small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    id="password-confirm"
                    name="password_confirmation"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Ulangi password"
                    data-toggle="password"
                >
            </div>
            <div class="form-group">
                <p class="text-muted">
                    Apakah anda ingin mendaftar sebagai
                    staff?
                </p>
                <div
                    class="custom-control custom-radio custom-control-inline"
                >
                    <input
                        type="radio"
                        class="custom-control-input @error('is_staff_yes') is-invalid @enderror"
                        name="is_staff_yes"
                        id="openStaffTrue"
                        v-model="is_staff_yes"
                        value="{{ old('is_staff_yes') }}"
                        :value="true"
                    />
                    <label
                        for="openStaffTrue"
                        class="custom-control-label"
                    >
                        Iya
                    </label>
                </div>
                <div
                    class="custom-control custom-radio custom-control-inline"
                >
                    <input
                        type="radio"
                        class="custom-control-input @error('is_staff_yes') is-invalid @enderror"
                        name="is_staff_yes"
                        id="openStaffFalse"
                        v-model="is_staff_yes"
                        value="{{ old('is_staff_yes') }}"
                        :value="false"
                    />
                    <label
                        for="openStaffFalse"
                        class="custom-control-label"
                    >
                        Tidak
                    </label>
                </div>
            </div>
            @error('is_staff_yes')
                <small class="text-danger"><b>{{ $message }}</b></small>
            @enderror
            <div class="form-group" v-if="is_staff_yes">
                <label for="nip">Nomor Induk Pegawai (NIP)</label>
                <input
                    id="nip"
                    name="nip"
                    v-model="nip"
                    type="text"
                    class="form-control @error('nip') is-invalid @enderror"
                    value="{{ old('nip') }}"
                    placeholder="Masukkan NIP anda"
                    required
                />
                @error('nip')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button
                type="submit"
                class="btn btn-primary btn-block mt-4"
                :disabled="this.email_unavailable"
            >
                Daftar akun
            </button>
            <a
                href="{{ route('login') }}"
                class="btn btn-signup btn-block mt-2"
            >
                Sudah punya akun? Silahkan masuk
            </a>
        </form>
    </div>
</div>

@endsection

@push('addon-script')

<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    Vue.use(Toasted);

    var register = new Vue({
        el: "#register",
        mounted() {
            AOS.init();
        },
        methods: {
            checkForEmailAvailability: function() {
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                    params: {
                        email: this.email
                    }
                })
                    .then(function (response) {
                        
                        if(response.data == 'Available') {
                            self.$toasted.show(
                                "Email tersedia, silahkan isi kolom selanjutnya.",
                                {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = false;

                        } else {
                            self.$toasted.error(
                                "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                                {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = true;

                        }

                        console.log(response);
                    });
            }
        },
        data() {
            return {
                name: "{{ old('name') }}",
                email: "{{ old('email') }}",
                is_staff_yes: "{{ old('is_staff_yes') }}",
                nip: "{{ old('nip') }}",
                email_unavailable: false
            }
        },
    });
</script>

@endpush