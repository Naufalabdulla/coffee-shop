<x-layout>
    <div class="pos-container">
        <div class="menu-section">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="product-card p-4">
                        <h5 class="fw-bold mb-3" style="align-items: left;">Add User</h5>
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3 d-flex gap-3">

                                <div class="form-check ms-auto">
                                    <input class="form-check-input" type="radio" name="role" id="role_admin"
                                        value="admin" required>
                                    <label class="form-check-label" for="role_admin">
                                        Admin
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_staff"
                                        value="staff">
                                    <label class="form-check-label" for="role_staff">
                                        Staff
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-brown w-100">Save</button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>