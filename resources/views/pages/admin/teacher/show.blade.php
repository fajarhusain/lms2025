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
                                {{ $teacher->first_name }} {{ $teacher->last_name }}, {{ $teacher->rank }}
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
                            <div class="mt-2 text-sm font-weight-light">
                                <i class="bi bi-file-earmark-person-fill"></i> {{ $teacher->about }}
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

            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Detail Data Guru</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>NIP</td>
                                    <td>: {{ $teacher->nip }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: {{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{ $teacher->email }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>: {{ $teacher->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $teacher->address }}</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>: {{ $teacher->city }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>: {{ $teacher->province }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>: {{ $teacher->postal_code }}</td>
                                </tr>
                                <tr>
                                    <td>Negara</td>
                                    <td>: {{ $teacher->country }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>: {{ $teacher->place_of_birth }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>: {{ \Carbon\Carbon::parse($teacher->date_of_birth)->format('d, F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: {{ $teacher->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>: {{ $teacher->religion }}</td>
                                </tr>
                                <tr>
                                    <td>Tentang Saya</td>
                                    <td>: {{ $teacher->about }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a class="btn btn-round bg-gradient-warning mb-0 px-4 py-2 d-flex align-items-center justify-content-center"
                                href="{{ route('operator.teachers.index') }}">
                                <i class="ni ni-bold-left"></i>
                                <span class="ms-2">Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Teacher Data Addition Form -->


</x-layout.admin>
