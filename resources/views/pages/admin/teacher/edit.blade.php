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

    <!-- Teacher Data Update Form -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card card-profile">
                    <img src="{{ asset('../assets/dashboard/img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="mt-n4 mt-lg-n6 mb-4">
                                <a href="javascript:;">
                                    <img src="{{ $teacher->profile_picture ? asset('storage/' . $teacher->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}"
                                        class="rounded-circle img-fluid border border-2 border-white mb-3"
                                        alt="Profile Picture" style="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="text-center h6 mt-2">
                            <div>
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </div>
                            <div class="text-sm">
                                <span class="font-weight-light">
                                    @php
                                        $dateOfBirth = \Carbon\Carbon::parse($teacher->date_of_birth);
                                        $age = $dateOfBirth->age;
                                    @endphp
                                    ( {{ $age }} Tahun )</span>
                            </div>
                            <div class="text-sm mt-3">
                                <i class="bi bi-geo-alt-fill"></i> {{ $teacher->address }}, {{ $teacher->city }},
                                {{ $teacher->province }}, {{ $teacher->country }} ({{ $teacher->postal_code }})
                            </div>
                            <div class="mt-2">
                                <i class="bi bi-file-earmark-person-fill"></i>{{ $teacher->about }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mx-4 mb-3">
                        <a href="mailto:{{ $teacher->email }}" class="btn btn-info mb-2 w-100">
                            <i class="bi bi-envelope-at-fill"></i> Email
                        </a>
                        <a href="https://api.whatsapp.com/send?phone={{ $teacher->phone_number }}"
                            class="btn btn-success w-100">
                            <i class="bi bi-whatsapp"></i> Whatsapp
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Formulir Perbarui Data Guru</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('operator.teachers.update', $teacher->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip" class="form-control-label">NIP (Nomor Induk
                                            Pegawai)</label>
                                        <input class="form-control" type="text" id="nip" name="nip"
                                            value="{{ old('nip', $teacher->nip) }}" placeholder="Masukkan NIP">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Alamat Email <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            value="{{ old('email', $teacher->email) }}"
                                            placeholder="Masukkan alamat email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="form-control-label">Nama Depan <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name', $teacher->first_name) }}"
                                            placeholder="Masukkan nama depan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-control-label">Nama Belakang <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="last_name" name="last_name"
                                            value="{{ old('last_name', $teacher->last_name) }}"
                                            placeholder="Masukkan nama belakang" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="degree" class="form-control-label">Pangkat Jabatan <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="degree" name="degree"
                                            value="{{ old('degree', $teacher->degree) }}"
                                            placeholder="Masukkan Pangkat Jabatan" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Informasi Kontak</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">Alamat</label>
                                        <input class="form-control" type="text" id="address" name="address"
                                            value="{{ old('address', $teacher->address) }}"
                                            placeholder="Masukkan alamat lengkap">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">Kota</label>
                                        <input class="form-control" type="text" id="city" name="city"
                                            value="{{ old('city', $teacher->city) }}"
                                            placeholder="Masukkan nama kota">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="province" class="form-control-label">Provinsi</label>
                                        <input class="form-control" type="text" id="province" name="province"
                                            value="{{ old('province', $teacher->province) }}"
                                            placeholder="Masukkan nama provinsi">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-control-label">Kode Pos</label>
                                        <input class="form-control" type="text" id="postal_code"
                                            name="postal_code"
                                            value="{{ old('postal_code', $teacher->postal_code) }}"
                                            placeholder="Masukkan kode pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="form-control-label">Negara</label>
                                        <input class="form-control" type="text" id="country" name="country"
                                            value="{{ old('country', $teacher->country) }}"
                                            placeholder="Masukkan nama negara">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Nomor Telepon</label>
                                        <input class="form-control" type="text" id="phone_number"
                                            name="phone_number"
                                            value="{{ old('phone_number', $teacher->phone_number) }}"
                                            placeholder="Masukkan nomor telepon">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Tentang Saya</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about" class="form-control-label">Tentang Saya</label>
                                        <textarea class="form-control" id="about" name="about" rows="3"
                                            placeholder="Tuliskan tentang diri Anda">{{ old('about', $teacher->about) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place_of_birth" class="form-control-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" id="place_of_birth"
                                            name="place_of_birth"
                                            value="{{ old('place_of_birth', $teacher->place_of_birth) }}"
                                            placeholder="Masukkan tempat lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control" type="date" id="date_of_birth"
                                            name="date_of_birth"
                                            value="{{ old('date_of_birth', $teacher->date_of_birth) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-control-label">Jenis Kelamin</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="" disabled>Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                {{ old('gender', $teacher->gender) == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ old('gender', $teacher->gender) == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="form-control-label">Agama</label>
                                        <select class="form-control" id="religion" name="religion">
                                            <option value="" disabled>Pilih Agama</option>
                                            <option value="Islam"
                                                {{ old('religion', $teacher->religion) == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('religion', $teacher->religion) == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik"
                                                {{ old('religion', $teacher->religion) == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu"
                                                {{ old('religion', $teacher->religion) == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Buddha"
                                                {{ old('religion', $teacher->religion) == 'Buddha' ? 'selected' : '' }}>
                                                Buddha</option>
                                            <option value="Konghucu"
                                                {{ old('religion', $teacher->religion) == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                            <option value="Lainnya"
                                                {{ old('religion', $teacher->religion) == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-lg-3 mb-4 text-center">
                                <a href="javascript:;" class="d-block">
                                    <img src="{{ $teacher->profile_picture ? asset('storage/' . $teacher->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}"
                                        class="rounded-circle img-fluid border border-2 border-white mb-3"
                                        alt="Profile Picture" style="width: 150px; height: 150px;"
                                        id="profilePicturePreview">
                                </a>

                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Foto Profil</label>
                                    <input class="form-control" type="file" id="photo" name="profile_picture"
                                        accept="image/*"
                                        onchange="previewImage(event, 'profilePicturePreview', '{{ $teacher->profile_picture ? asset('storage/' . $teacher->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}')">
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                        foto.</small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="form-control-label">Role / Status</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="operator"
                                            {{ old('role', $teacher->role) === 'operator' ? 'selected' : '' }}>Operator
                                        </option>
                                        <option value="teacher"
                                            {{ old('role', $teacher->role) === 'teacher' ? 'selected' : '' }}>Teacher
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password <span
                                            style="color: red;">*</span></label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        placeholder="Masukkan password baru" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-control-label">Konfirmasi
                                        Password <span style="color: red;">*</span></label>
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" placeholder="Konfirmasi password baru" required>
                                </div>
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-round bg-gradient-info">Perbarui Data</button>
                                <a href="{{ route('operator.teachers.index') }}"
                                    class="btn btn-round bg-gradient-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout.admin>
