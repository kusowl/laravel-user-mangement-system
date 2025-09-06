<x-layout>
    <div class="container mx-auto p-6 max-w-7xl">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="hero bg-gradient-to-r from-info to-success rounded-2xl text-primary-content">
                <div class="hero-content text-center py-12">
                    <div class="max-w-lg">
                        <h1 class="mb-5 text-4xl font-bold">Welcome back, {{$user->name}} !</h1>
                        <p class="mb-5">Manage your account and preferences from your personalized dashboard.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat bg-base-200 rounded-2xl ">
                <div class="stat-title">Last Login</div>
                <div class="stat-value text-primary text-lg">2 hours ago</div>
                <div class="stat-desc">Today at 2:30 PM</div>
            </div>


            <div class="stat bg-base-200 rounded-2xl ">
                <div class="stat-title">Sessions</div>
                <div class="stat-value text-accent text-lg">23</div>
                <div class="stat-desc">This month</div>
            </div>

            <div class="stat bg-base-200 rounded-2xl ">
                <div class="stat-title">Member Since</div>
                <div class="stat-value text-info text-lg">2 years</div>
                <div class="stat-desc">January 2023</div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 grid-row-1 gap-6">
            <!-- Profile Section -->
            <div class="lg:col-span-2">
                <div class="card bg-base-200 border-base-300 h-full">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6">
                            <i class="fas fa-user text-primary"></i>
                            Profile Information
                        </h2>

                        <div class="flex flex-col md:flex-row gap-10 items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar">
                                    <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img
                                            src="{{asset('storage/'.$user->profile_photo)}}"
                                            alt="Profile"/>
                                    </div>
                                </div>

                            </div>

                            <div class="flex-grow">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Full Name</span>
                                        </label>
                                        <input type="text" value="{{$user->name}}" class="input input-bordered"
                                               readonly/>
                                    </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Email</span>
                                        </label>
                                        <input type="email" value="{{$user->email}}" class="input input-bordered"
                                               readonly/>
                                    </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Phone</span>
                                        </label>
                                        <input type="text" value="{{$user->phone_no}}" class="input input-bordered"
                                               readonly/>
                                    </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Location</span>
                                        </label>
                                        <input type="text" value="{{$user->location}}" class="input input-bordered"
                                               readonly/>
                                    </div>

                                    <div class="form-control md:col-span-2">
                                        <label class="label block">
                                            <span class="label-text font-semibold">Bio</span>
                                        </label>
                                        <textarea class="input input-bordered w-full" readonly>{{$user->bio}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Settings -->
            <div>
                <!-- Quick Actions Card -->
                <div class="card bg-base-200 h-full">
                    <div class="card-body">
                        <h2 class="card-title text-xl mb-4">
                            <i class="fas fa-bolt text-warning"></i>
                            Quick Actions
                        </h2>

                        <div class="space-y-5">

                            <button class="btn btn-soft btn-block btn-primary justify-start" onclick="changePhoto()">
                                <i class="fas fa-image"></i>
                                Update Profile Photo
                            </button>

                            <button class="btn btn-soft btn-block btn-accent justify-start" onclick="editProfile()">
                                <i class="fas fa-user-edit"></i>
                                Edit Profile Details
                            </button>

                            <button class="btn btn-soft btn-block btn-warning justify-start" onclick="changePassword()">
                                <i class="fas fa-key"></i>
                                Change Password
                            </button>

                            <button class="btn btn-soft btn-block btn-error justify-start" onclick="changePhoto()">
                                <i class="fas fa-image"></i>
                                Delete Account
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <dialog id="logout_modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-error">
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
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-user-edit text-primary"></i>
                Edit Profile
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="profile-update-details">

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" value="{{$user->name}}" class="input input-bordered"/>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{$user->email}}" class="input input-bordered"/>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Location</span>
                    </label>
                    <input type="text" name="location" value="{{$user->location ?? ''}}"
                           class="input input-bordered"/>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Phone</span>
                    </label>
                    <input type="text" name="phone_no" value="{{$user->phone_no ?? ''}}"
                           class="input input-bordered"/>
                </div>
            </div>

            <div class="form-control mt-4 md:col-span-2">
                <label class="label block">
                    <span class="label-text">Bio</span>
                </label>
                <textarea name="bio" class="textarea textarea-bordered h-24 w-full">{{$user->bio ?? ''}}</textarea>
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
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-key text-secondary"></i>
                Change Password
            </h3>

            <div class="space-y-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Current Password</span>
                    </label>
                    <input type="password" class="input input-bordered"/>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">New Password</span>
                    </label>
                    <input type="password" class="input input-bordered"/>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm New Password</span>
                    </label>
                    <input type="password" class="input input-bordered"/>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn mr-2">Cancel</button>
                    <button class="btn btn-secondary">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        // JavaScript functions for interactivity
        function logout() {
            document.getElementById('logout_modal').showModal();
        }

        function performLogout() {
            // Here you would redirect to logout route
            {{--// window.location.href = "{{ route('logout') }}";--}}
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
                url = "{{route('user.profile')}}";
                const formData = new FormData();
                formData.append('_token', '{{csrf_token()}}');
                formData.append('_method', 'PUT');
                formData.append('name', name.value);
                formData.append('email', email.value);
                formData.append('location', location.value || '');
                formData.append('bio', bio.value || '');
                formData.append('phone_no', phone_no.value || '');

                let options = {
                    method: "POST",
                    body: formData,
                };
                const response = await fetch(url, options)
                if (response.ok) {
                    window.location.reload()
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
            input.onchange = async function (e) {
                const file = e.target.files[0];
                const url = "{{ route('user.profile.photo') }}";

                if (file) {
                    const formData = new FormData();
                    formData.append('profile_photo', file)
                    formData.append('_token', '{{csrf_token()}}');
                    formData.append('_method', 'PUT');
                    try {
                        const options = {
                            method: 'POST',
                            body: formData,
                        };

                        const response = await fetch(url, options)
                        if (response.ok) {
                            window.location.reload()
                        }

                    } catch (error) {
                        console.log(error)
                    }
                }
            };
            input.click();
        }

    </script>
</x-layout>
