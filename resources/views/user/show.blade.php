<x-layout>
    <div class="container mx-auto max-w-7xl p-6">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="hero from-info to-success text-primary-content rounded-2xl bg-gradient-to-r">
                <div class="hero-content py-12 text-center">
                    <div class="max-w-lg">
                        <h1 class="mb-5 text-4xl font-bold">Welcome back, {{ $user->name }} !</h1>
                        <p class="mb-5">Manage your account and preferences from your personalized dashboard.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="card bg-base-200 col-span-3 h-full">
                <div class="card-body">
                    <h2 class="card-title mb-4 justify-center border-b border-white/20 pb-4 text-xl">
                        Profile Details
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div class="flex items-center justify-center">
                            <article>
                                <div class="avatar">
                                    <div
                                        class="ring-primary ring-offset-base-100 w-36 rounded-full ring-2 ring-offset-2">
                                        <img id="profile-photo"
                                            src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_photo) }}" />
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="flex flex-col gap-6 lg:col-span-2">
                            <div class="flex flex-col gap-6 md:flex-row">
                                <x-mini-card title="Full Name" content="{{ $user->name }}" />

                                <x-mini-card title="Email" content="{{ $user->email }}" />

                                <x-mini-card title="Mobile No" content="{{ $user->phone_no }}" />

                                <x-mini-card title="Location" content="{{ $user->location }}" />
                            </div>
                            <div class="bg-base-100 rounded-lg">
                                <x-mini-card title="Bio" content="{{ $user->bio }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-row-1 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Quick Actions Card -->
            <div class="card bg-base-200 col-span-3 h-full">
                <div class="card-body">
                    <h2 class="card-title mb-4 justify-center border-b border-white/20 pb-4 text-xl">
                        Quick Actions
                    </h2>

                    <div class="flex flex-col justify-evenly space-y-4 md:flex-row">

                        <button class="btn btn-soft btn-primary justify-start" onclick="changePhoto()">
                            <i class="fas fa-image"></i>
                            Update Profile Photo
                        </button>

                        <button class="btn btn-soft btn-accent justify-start" onclick="editProfile()">
                            <i class="fas fa-user-edit"></i>
                            Edit Profile Details
                        </button>

                        <button class="btn btn-soft btn-warning justify-start" onclick="changePassword()">
                            <i class="fas fa-key"></i>
                            Change Password
                        </button>

                        <button class="btn btn-soft btn-error justify-start" onclick="changePhoto()">
                            <i class="fas fa-image"></i>
                            Delete Account
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <dialog id="logout_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-error text-lg font-bold">
                <i class="fas fa-exclamation-triangle"></i>
                Confirm Logout
            </h3>
            <p class="py-4">Are you sure you want to logout? Any unsaved changes will be lost.</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn mr-2">Cancel</button>
                    <button class="btn btn-error" onclick="performLogout()">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Profile Edit Modal -->
    <dialog id="profile-modal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="mb-4 text-lg font-bold">
                <i class="fas fa-user-edit text-primary"></i>
                Edit Profile
            </h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2" id="profile-update-details">

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ $user->email }}" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Location</span>
                    </label>
                    <input type="text" name="location" value="{{ $user->location ?? '' }}"
                        class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Phone</span>
                    </label>
                    <input type="text" name="phone_no" value="{{ $user->phone_no ?? '' }}"
                        class="input input-bordered" />
                </div>
            </div>

            <div class="form-control mt-4 md:col-span-2">
                <label class="label block">
                    <span class="label-text">Bio</span>
                </label>
                <textarea name="bio" class="textarea textarea-bordered h-24 w-full">{{ $user->bio ?? '' }}</textarea>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn mr-2">Cancel</button>
                </form>
                <button id="profile-update-btn" class="btn btn-primary" onclick="updateProfile()">
                    Save Changes
                </button>
            </div>
        </div>
    </dialog>

    <!-- Change Password Modal -->
    <dialog id="password_modal" class="modal">
        <div class="modal-box">
            <h3 class="mb-4 text-lg font-bold">
                <i class="fas fa-key text-secondary"></i>
                Change Password
            </h3>

            <div class="space-y-4">
                <div class="form-control">
                    <label class="label block">
                        <span class="label-text">Current Password</span>
                    </label>
                    <input type="password" name="current_password" class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label block">
                        <span class="label-text">New Password</span>
                    </label>
                    <input type="password" name="new_password" class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm New Password</span>
                    </label>
                    <input type="password" name="password_confirmation"class="input input-bordered" />
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn mr-2">Cancel</button>
                </form>

                <button onclick="updatePassword()" class="btn btn-secondary">
                    Update Password
                </button>
            </div>
        </div>
    </dialog>
    @include('components.toastify')
    <script>
        // JavaScript functions for interactivity
        function logout() {
            document.getElementById('logout_modal').showModal();
        }

        function performLogout() {
            // Here you would redirect to logout route
            {{-- // window.location.href = "{{ route('logout') }}"; --}}
            alert('Redirecting to logout...');
        }

        function editProfile() {
            document.getElementById('profile-modal').showModal();
        }

        async function updateProfile() {
            const name = document.querySelector("#profile-modal input[name='name']");
            const email = document.querySelector("#profile-modal input[name='email']");
            const location = document.querySelector("#profile-modal input[name='location']");
            const bio = document.querySelector("#profile-modal textarea[name='bio']");
            const phone_no = document.querySelector("#profile-modal input[name='phone_no']");
            let flag = true;
            if (name.value === '') {
                name.style.borderColor = 'red'
                flag = true
            }

            if (email.value === '') {
                email.style.borderColor = 'red'
                flag = true
            }

            if (flag) {
                url = "{{ route('user.profile') }}";
                try {
                    const response = await axios.put(url, {
                        name: name.value,
                        email: email.value,
                        location: location.value || '',
                        bio: bio.value || '',
                        phone_no: phone_no || ''
                    });

                    const data = response.data;
                    if (data.success) {
                        showSuccessToast(data.message);
                    } else {
                        showErrorToast(data.message)
                    }
                } catch (error) {
                    console.error(error);
                    showErrorToast('Unknow error ocuured');
                }

            }
        }

        function changePassword() {
            document.getElementById('password_modal').showModal();
        }

        function changePhoto() {
            // Create file input for photo upload
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = async function(e) {
                const file = e.target.files[0];
                const url = "{{ route('user.profile.photo') }}";
                const formData = new FormData();
                formData.append('profile_photo', file);
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('_method', 'PUT');
                if (file) {
                    try {

                        const response = await axios.post(url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            }
                        });
                        const data = response.data;
                        if (data.success) {
                            const profileImage = document.getElementById('profile-photo');
                            profileImage.src = data.photo_url + '?t=' + new Date()
                                .getTime(); // Add timestamp to prevent caching
                            showSuccessToast(data.message || 'Photo updated successfully!');
                        } else {
                            showErrorToast(data.message)
                        }

                    } catch (error) {
                        console.log(error);
                        showErrorToast('Unknow error ocuured');
                    }
                }
            };
            input.click();
        }

        async function updatePassword() {
            const current_password = document.querySelector("#password_modal input[name='current_password']");
            const new_password = document.querySelector("#password_modal input[name='new_password']");
            const confirm_password = document.querySelector("#password_modal input[name='password_confirmation']");
            let flag = false;
            // validations
            if (current_password.value === '') {
                showErrorToast('Current password is required');
                flag = true;
            }
            if (new_password.value === '') {
                showErrorToast('New password is required');
                flag = true;
            }
            if (confirm_password.value === '') {
                showErrorToast('Confirm password is required');
                flag = true;
            }
            if (new_password.value !== confirm_password.value) {
                showErrorToast('Passwords do not match');
                flag = true;
            }

            if (!flag) {
                const url = "{{ route('user.profile.password') }}";
                try {
                    const response = await axios.put(url, {
                        new_password: new_password.value,
                        current_password: current_password.value
                    });
                    const data = response.data;
                    if (data.success) {
                        showSuccessToast(data.message);
                    } else {
                        showErrorToast(data.message);
                    }
                } catch (error) {
                    console.error(error);
                    showErrorToast('Unknow error ocuured');
                }
            }
        }
    </script>
</x-layout>
