{{-- Start Page: Admin Edit Student --}}

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
                                    href="{{ route('operator.students.index') }}">
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

    <!-- Student Data Update Form -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card card-profile">
                    <img src="{{ asset('../assets/dashboard/img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="mt-n4 mt-lg-n6 mb-4">
                                <a href="javascript:;">
                                    <img src="{{ $student->profile_picture ? asset('storage/' . $student->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}"
                                        class="rounded-circle img-fluid border border-2 border-white mb-3"
                                        alt="Profile Picture" style="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="text-center h6 mt-2">
                            <div>
                                {{ $student->full_name }}
                            </div>
                            <div class="text-sm">
                                <span class="font-weight-light">
                                    @php
                                        $dateOfBirth = \Carbon\Carbon::parse($student->date_of_birth);
                                        $age = $dateOfBirth->age;
                                    @endphp
                                    ( {{ $age }} Tahun )</span>
                            </div>
                            <div class="text-sm mt-3">
                                <i class="bi bi-geo-alt-fill"></i>
                                @if ($student->address || $student->city || $student->province || $student->country || $student->postal_code)
                                    {{ trim(implode(', ', array_filter([$student->address, $student->city, $student->province, $student->country, $student->postal_code]))) }}
                                @else
                                    -
                                @endif
                            </div>

                            <div class="mt-2">
                                <i class="bi bi-file-earmark-person-fill"></i> KELAS
                                {{ optional($student->classroom)->grade_level ?? '-' }} -
                                {{ optional($student->classroom)->class_name ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mx-4 mb-3">
                        <a href="mailto:{{ $student->email }}" class="btn btn-info mb-2 w-100">
                            <i class="bi bi-envelope-at-fill"></i> Email
                        </a>
                        <a href="https://api.whatsapp.com/send?phone={{ $student->phone_number }}"
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
                            <p class="mb-0">Formulir Perbarui Data Siswa</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('operator.students.update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nis" class="form-control-label">NIS (Nomor Induk
                                            Siswa)</label>
                                        <input class="form-control" type="text" id="nis" name="nis"
                                            value="{{ old('nis', $student->nis) }}" placeholder="Masukkan NIS">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nisn" class="form-control-label">NISN (Nomor Induk
                                            Siswa Nasional)</label>
                                        <input class="form-control" type="text" id="nisn" name="nisn"
                                            value="{{ old('nisn', $student->nisn) }}" placeholder="Masukkan NISN">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name" class="form-control-label">Nama Lengkap <span
                                                style="color: red;">*</span></label>
                                        <input class="form-control" type="text" id="full_name" name="full_name"
                                            value="{{ old('full_name', $student->full_name) }}"
                                            placeholder="Masukkan nama depan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="classroom_id" class="form-control-label">Kelas <span
                                                style="color: red;">*</span></label>
                                        <select class="form-control" id="classroom_id" name="classroom_id" required>
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ old('classroom_id', $student->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                                    {{ $classroom->class_name }} ({{ $classroom->class_code }})
                                                </option>
                                            @endforeach
                                        </select>
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
                                            value="{{ old('address', $student->address) }}"
                                            placeholder="Masukkan alamat lengkap">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">Kota</label>
                                        <input class="form-control" type="text" id="city" name="city"
                                            value="{{ old('city', $student->city) }}"
                                            placeholder="Masukkan nama kota">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="province" class="form-control-label">Provinsi</label>
                                        <input class="form-control" type="text" id="province" name="province"
                                            value="{{ old('province', $student->province) }}"
                                            placeholder="Masukkan nama provinsi">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-control-label">Kode Pos</label>
                                        <input class="form-control" type="text" id="postal_code"
                                            name="postal_code"
                                            value="{{ old('postal_code', $student->postal_code) }}"
                                            placeholder="Masukkan kode pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="form-control-label">Negara</label>
                                        <input class="form-control" type="text" id="country" name="country"
                                            value="{{ old('country', $student->country) }}"
                                            placeholder="Masukkan nama negara">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Nomor Telepon</label>
                                        <input class="form-control" type="text" id="phone_number"
                                            name="phone_number"
                                            value="{{ old('phone_number', $student->phone_number) }}"
                                            placeholder="Masukkan nomor telepon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_contact" class="form-control-label">Kontak
                                            Darurat</label>
                                        <input class="form-control" type="text" id="emergency_contact"
                                            name="emergency_contact"
                                            value="{{ old('emergency_contact', $student->emergency_contact) }}"
                                            placeholder="Masukkan nomor telepon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Alamat Email</label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            value="{{ old('email', $student->email) }}"
                                            placeholder="Masukkan alamat email">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Tentang Saya</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place_of_birth" class="form-control-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" id="place_of_birth"
                                            name="place_of_birth"
                                            value="{{ old('place_of_birth', $student->place_of_birth) }}"
                                            placeholder="Masukkan tempat lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control" type="date" id="date_of_birth"
                                            name="date_of_birth"
                                            value="{{ old('date_of_birth', $student->date_of_birth) }}">
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
                                                {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>
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
                                                {{ old('religion', $student->religion) == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('religion', $student->religion) == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik"
                                                {{ old('religion', $student->religion) == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu"
                                                {{ old('religion', $student->religion) == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Buddha"
                                                {{ old('religion', $student->religion) == 'Buddha' ? 'selected' : '' }}>
                                                Buddha</option>
                                            <option value="Konghucu"
                                                {{ old('religion', $student->religion) == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                            <option value="Lainnya"
                                                {{ old('religion', $student->religion) == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-lg-3 mb-4 text-center">
                                <a href="javascript:;" class="d-block">
                                    <img src="{{ $student->profile_picture ? asset('storage/' . $student->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}"
                                        class="rounded-circle img-fluid border border-2 border-white mb-3"
                                        alt="Profile Picture" style="width: 150px; height: 150px;"
                                        id="profilePicturePreview">
                                </a>

                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Foto Profil</label>
                                    <input class="form-control" type="file" id="photo" name="profile_picture"
                                        accept="image/*"
                                        onchange="previewImage(event, 'profilePicturePreview', '{{ $student->profile_picture ? asset('storage/' . $student->profile_picture) : asset('../assets/dashboard/img/team-2.jpg') }}')">
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                        foto.</small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password </label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        placeholder="Masukkan password baru">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-control-label">Konfirmasi
                                        Password </label>
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" placeholder="Konfirmasi password baru">
                                </div>
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-round bg-gradient-info ">Perbarui Data</button>
                                <a href="{{ route('operator.students.index') }}"
                                    class="btn btn-round bg-gradient-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Data Update Form -->
</x-layout.admin>
{{-- End Page: Admin Edit Student --}}
