<x-layout.admin>

    <!-- Administrator Profile Section -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('assets/dashboard/img/team-1.jpg') }}"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-gray-200" role="tablist">
                            <li class="nav-item">
                                <a class="btn bg-gradient-warning mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('operator.teachers.index') }}">
                                    <i class="ni ni-bold-left"></i>
                                    <span class="ms-2">Kembali</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Administrator Profile Section -->

    <!-- Teacher Data Addition Form -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Formulir Input Data Guru</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('operator.teachers.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- NIP -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip" class="form-control-label">NIP (Nomor Induk
                                            Pegawai)</label>
                                        <input class="form-control" type="text" id="nip" name="nip"
                                            value="{{ old('nip') }}" placeholder="Masukkan NIP">
                                        @error('nip')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Alamat Email <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="Masukkan alamat email" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Depan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="form-control-label">Nama Depan <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name') }}" placeholder="Masukkan nama depan" required>
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Belakang -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-control-label">Nama Belakang <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="last_name" name="last_name"
                                            value="{{ old('last_name') }}" placeholder="Masukkan nama belakang"
                                            required>
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pangkat Jabatan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rank" class="form-control-label">Pangkat Jabatan <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="rank" name="rank"
                                            value="{{ old('rank') }}" placeholder="Masukkan pangkat jabatan"
                                            required>
                                        @error('rank')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Informasi Kontak</p>
                            <div class="row">
                                <!-- Alamat -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">Alamat</label>
                                        <input class="form-control" type="text" id="address" name="address"
                                            value="{{ old('address') }}" placeholder="Masukkan alamat lengkap">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kota -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">Kota</label>
                                        <input class="form-control" type="text" id="city" name="city"
                                            value="{{ old('city') }}" placeholder="Masukkan nama kota">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="province" class="form-control-label">Provinsi</label>
                                        <input class="form-control" type="text" id="province" name="province"
                                            value="{{ old('province') }}" placeholder="Masukkan nama provinsi">
                                        @error('province')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kode Pos -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-control-label">Kode Pos</label>
                                        <input class="form-control" type="text" id="postal_code"
                                            name="postal_code" value="{{ old('postal_code') }}"
                                            placeholder="Masukkan kode pos">
                                        @error('postal_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Negara -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="form-control-label">Negara</label>
                                        <input class="form-control" type="text" id="country" name="country"
                                            value="{{ old('country') }}" placeholder="Masukkan nama negara">
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Nomor Telepon</label>
                                        <input class="form-control" type="text" id="phone_number"
                                            name="phone_number" value="{{ old('phone_number') }}"
                                            placeholder="Masukkan nomor telepon">
                                        @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Tentang Saya</p>
                            <div class="row">
                                <!-- Tentang Saya -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about" class="form-control-label">Tentang Saya</label>
                                        <textarea class="form-control" id="about" name="about" rows="3"
                                            placeholder="Tuliskan tentang diri Anda">{{ old('about') }}</textarea>
                                        @error('about')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Tempat Lahir -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place_of_birth" class="form-control-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" id="place_of_birth"
                                            name="place_of_birth" value="{{ old('place_of_birth') }}"
                                            placeholder="Masukkan tempat lahir">
                                        @error('place_of_birth')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control" type="date" id="date_of_birth"
                                            name="date_of_birth" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Jenis Kelamin -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-control-label">Jenis Kelamin</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Agama -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="form-control-label">Agama</label>
                                        <select class="form-control" id="religion" name="religion">
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik"
                                                {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Budha" {{ old('religion') == 'Budha' ? 'selected' : '' }}>
                                                Budha</option>
                                            <option value="Konghucu"
                                                {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('religion')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4 mt-lg-3 mb-4 text-center">
                                    <a href="javascript:;" class="d-block">
                                        <img src="{{ asset('../assets/dashboard/img/team-2.jpg') }}"
                                            class="rounded-circle img-fluid border border-2 border-white mb-3"
                                            alt="Profile Picture" style="width: 150px; height: 150px;"
                                            id="profilePicturePreview">
                                    </a>
                                    <div class="form-group">
                                        <label for="photo" class="form-control-label">Foto Profil</label>
                                        <input class="form-control" type="file" id="photo"
                                            name="profile_picture" accept="image/*"
                                            onchange="previewImage(event, 'profilePicturePreview', '{{ asset('../assets/dashboard/img/team-2.jpg') }}')">
                                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                            foto.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="card card-profile">
                    <img src="{{ asset('../assets/dashboard/img/bg-profile.jpg') }}" alt="Image placeholder"
                        class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="mt-n4 mt-lg-n6 mb-4">
                                <a href="javascript:;">
                                    <img src="{{ asset('../assets/dashboard/img/team-2.jpg') }}"
                                        class="rounded-circle img-fluid border border-2 border-white mb-3"
                                        alt="Profile Picture" style="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="text-center h6 mt-2">
                            <div>
                                Luqman Fattah Nadin
                            </div>
                            <div class="text-sm">
                                <span class="font-weight-light">
                                    ( 24 Tahun )</span>
                            </div>
                            <div class="text-sm mt-3">
                                <i class="bi bi-geo-alt-fill"></i> Randusari Rt 005 Rw 006, Tegal, Jawa Tengah,
                                Indonesia (52462)
                            </div>
                            <div class="mt-2 text-sm font-weight-light">
                                <i class="bi bi-file-earmark-person-fill"></i> Saya Adalah seorang Web Developer
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mx-4 mb-3">
                        <a href="mailto:l.f.nadhien@gmail.com" class="btn btn-info mb-2 w-100">
                            <i class="bi bi-envelope-at-fill"></i> Email
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=087777553390" class="btn btn-success w-100">
                            <i class="bi bi-whatsapp"></i> Whatsapp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Teacher Data Addition Form -->

</x-layout.admin>
