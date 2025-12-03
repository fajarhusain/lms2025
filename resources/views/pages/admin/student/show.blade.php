{{-- Start Page: Admin Show Student --}}
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

    <!-- Student Data Addition Form -->
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
                                        $dateOfBirth = $student->date_of_birth
                                            ? \Carbon\Carbon::parse($student->date_of_birth)
                                            : null;
                                        $age = $dateOfBirth ? $dateOfBirth->age : 'N/A';
                                    @endphp
                                    ({{ $age }} Tahun)
                                </span>
                            </div>

                            <div class="text-sm mt-3">
                                <i class="bi bi-geo-alt-fill"></i> {{ $student->address }}, {{ $student->city }},
                                {{ $student->province }}, {{ $student->country }} ({{ $student->postal_code }})
                            </div>
                            <div class="mt-2 text-sm font-weight-light">
                                <i class="bi bi-file-earmark-person-fill"></i> {{ $student->about }}
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

            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Detail Data Siswa</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>NIS</td>
                                    <td>: {{ $student->nis }}</td>
                                </tr>
                                <tr>
                                    <td>NISN</td>
                                    <td>: {{ $student->nisn }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: {{ $student->full_name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>: {{ $student->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>: {{ $student->city }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>: {{ $student->province }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>: {{ $student->postal_code }}</td>
                                </tr>
                                <tr>
                                    <td>Negara</td>
                                    <td>: {{ $student->country }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>: {{ $student->place_of_birth }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:
                                        {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d, F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:
                                        {{ isset($student->gender) ? ($student->gender == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Agama</td>
                                    <td>: {{ $student->religion }}</td>
                                </tr>
                                <tr>
                                    <td>Tentang Saya</td>
                                    <td>: {{ $student->about }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a class="btn btn-round bg-gradient-warning mb-0 px-4 py-2 d-flex align-items-center justify-content-center"
                                href="{{ route('operator.students.index') }}">
                                <i class="ni ni-bold-left"></i>
                                <span class="ms-2">Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Data Addition Form -->



</x-layout.admin>
{{-- End Page: Admin Show Student --}}
