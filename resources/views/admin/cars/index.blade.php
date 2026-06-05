@extends('layouts.admin')

@section('title', 'Cars Management')

@section('content')

    <!-- Header -->
    <div class="cars-header">

        <div class="cars-title-wrapper">

            <div class="m-stripe-vertical">
                <span class="blue-light"></span>
                <span class="blue-dark"></span>
                <span class="red"></span>
            </div>

            <div>
                <h1 class="cars-title">
                    CARS MANAGEMENT
                </h1>

                <p class="cars-subtitle">
                    Manage your vehicle fleet
                </p>
            </div>

        </div>

        <button class="add-car-btn" id="openAddCarModal">
            + ADD VEHICLE
        </button>

    </div>

    <!-- Action Bar -->
    <div class="action-bar">

        <input type="text" placeholder="Search vehicles..." class="search-input">

        <select class="filter-select">
            <option>All Brands</option>
        </select>

        <select class="filter-select">
            <option>All Status</option>
        </select>

    </div>

    <!-- Cars Grid -->
    <div class="cars-grid">

        @foreach ($cars as $car)
            <div class="car-card">

                <div class="car-image-wrapper">

                    <img src="{{ asset('storage/' . $car->thumbnail) }}" class="car-image" alt="{{ $car->name }}">

                    <span class="status-badge {{ strtolower($car->status) }}">
                        {{ strtoupper($car->status) }}
                    </span>

                </div>

                <div class="car-body">

                    <p class="car-brand">
                        {{ strtoupper($car->brand) }}
                    </p>

                    <h3 class="car-name">
                        {{ $car->name }}
                    </h3>

                    <p class="car-plate">
                        {{ $car->plate_number }}
                    </p>

                    <div class="divider"></div>

                    <div class="car-meta">

                        <div>
                            <span>YEAR</span>
                            <strong>{{ $car->year }}</strong>
                        </div>

                        <div>
                            <span>DAILY RATE</span>
                            <strong>
                                Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                            </strong>
                        </div>

                    </div>

                    <div class="divider"></div>

                    <div class="card-actions">
                        <button type="button" class="btn-outline btn-edit" data-id="{{ $car->id }}"
                            data-name="{{ $car->name }}" data-brand="{{ $car->brand }}"
                            data-year="{{ $car->year }}" data-plate="{{ $car->plate_number }}"
                            data-price="{{ $car->price_per_day }}" data-status="{{ $car->status }}"
                            data-description="{{ $car->description }}"
                            data-thumbnail="{{ asset('storage/' . $car->thumbnail) }}">

                            EDIT

                        </button>

                        <button type="button" class="btn-outline btn-delete" data-id="{{ $car->id }}"
                            data-name="{{ $car->name }}">
                            DELETE
                        </button>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

    <div id="addCarModal" class="modal-overlay">

        <div class="modal-container">

            <div class="modal-header">
                <button id="closeAddCarModal">
                    ×
                </button>

                <h2>ADD NEW VEHICLE</h2>


            </div>

            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>VEHICLE NAME</label>
                        <input type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label>BRAND</label>
                        <input type="text" name="brand">
                    </div>

                    <div class="form-group">
                        <label>YEAR</label>
                        <input type="number" name="year">
                    </div>

                    <div class="form-group">
                        <label>PLATE NUMBER</label>
                        <input type="text" name="plate_number">
                    </div>

                </div>

                <div class="form-group">
                    <label>DAILY PRICE (RP)</label>
                    <input type="number" name="price_per_day">
                </div>

                <div class="form-group">
                    <label>STATUS</label>

                    <select name="status">

                        <option value="available">
                            Available
                        </option>

                        <option value="rented">
                            Rented
                        </option>

                        <option value="maintenance">
                            Maintenance
                        </option>

                    </select>

                </div>

                <div class="form-group">
                    <label>DESCRIPTION</label>

                    <textarea rows="5" name="description"></textarea>

                </div>

                <div class="form-group full-width">

                    <label>
                        THUMBNAIL IMAGE
                    </label>

                    <label for="thumbnail" id="uploadBox" class="upload-box">

                        <div id="uploadPlaceholder">

                            <p class="upload-title">
                                Click to upload or drag and drop
                            </p>

                            <p class="upload-subtitle">
                                PNG, JPG up to 10MB
                            </p>

                        </div>

                        <img id="imagePreview" class="image-preview" alt="Preview">

                    </label>

                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" hidden>

                </div>

                <div class="modal-divider"></div>
                <div class="modal-footer">

                    <button type="submit" class="btn-save">

                        ADD VEHICLE

                    </button>

                    <button type="button" id="closeAddCarModal2" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div id="deleteModal" class="modal-overlay">

        <div class="delete-modal">

            <h2>
                DELETE VEHICLE
            </h2>

            <p>
                Are you sure you want to delete:
            </p>

            <h3 id="deleteVehicleName">
                BMW M4 Competition
            </h3>

            <p class="delete-warning">
                This action cannot be undone.
            </p>

            <form id="deleteForm" method="POST">

                @csrf
                @method('DELETE')

                <div class="delete-actions">

                    <button type="submit" class="btn-danger">

                        DELETE

                    </button>

                    <button type="button" id="closeDeleteModal" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div id="editCarModal" class="modal-overlay">

        <div class="modal-container">

            <div class="modal-header">

                <button id="closeEditModal">
                    ×
                </button>

                <h2>EDIT VEHICLE</h2>

            </div>

            <form id="editCarForm" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    <div class="form-group">

                        <label>VEHICLE NAME</label>

                        <input type="text" name="name" id="editName">

                    </div>

                    <div class="form-group">

                        <label>BRAND</label>

                        <input type="text" name="brand" id="editBrand">

                    </div>

                    <div class="form-group">

                        <label>YEAR</label>

                        <input type="number" name="year" id="editYear">

                    </div>

                    <div class="form-group">

                        <label>PLATE NUMBER</label>

                        <input type="text" name="plate_number" id="editPlate">

                    </div>

                </div>

                <div class="form-group full-width">

                    <label>DAILY PRICE</label>

                    <input type="number" name="price_per_day" id="editPrice">

                </div>

                <div class="form-group full-width">

                    <label>STATUS</label>

                    <select name="status" id="editStatus">

                        <option value="available">Available</option>
                        <option value="rented">Rented</option>
                        <option value="reserved">Reserved</option>
                        <option value="maintenance">Maintenance</option>

                    </select>

                </div>

                <div class="form-group full-width">

                    <label>DESCRIPTION</label>

                    <textarea name="description" id="editDescription"></textarea>

                </div>

                <div class="form-group full-width">

                    <label>THUMBNAIL IMAGE</label>

                    <label for="editThumbnail" id="editUploadBox" class="upload-box">

                        <img id="editImagePreview" class="image-preview">

                    </label>

                    <input type="file" name="thumbnail" id="editThumbnail" hidden>

                </div>

                <div class="modal-divider"></div>

                <div class="modal-footer">

                    <button type="submit" class="btn-save">

                        UPDATE VEHICLE

                    </button>

                    <button type="button" id="closeEditModal2" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const modal =
            document.getElementById('addCarModal');

        document
            .getElementById('openAddCarModal')
            .addEventListener('click', () => {

                modal.classList.add('show');

            });

        document
            .getElementById('closeAddCarModal')
            .addEventListener('click', () => {

                modal.classList.remove('show');

            });

        document
            .getElementById('closeAddCarModal2')
            .addEventListener('click', () => {

                modal.classList.remove('show');

            });
        const thumbnail =
            document.getElementById('thumbnail');

        const fileName =
            document.getElementById('fileName');

        if (thumbnail && fileName) {

            thumbnail.addEventListener('change', function() {

                if (this.files.length) {

                    fileName.textContent =
                        this.files[0].name;
                }

            });

        }


        const thumbnailInput =
            document.getElementById('thumbnail');

        const imagePreview =
            document.getElementById('imagePreview');

        const uploadBox =
            document.getElementById('uploadBox');

        thumbnailInput.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(e) {

                imagePreview.src = e.target.result;

                imagePreview.style.display = 'block';

                uploadBox.classList.add('has-image');
            };

            reader.readAsDataURL(file);

        });

        const deleteModal =
            document.getElementById('deleteModal');

        const deleteName =
            document.getElementById('deleteVehicleName');

        const deleteForm =
            document.getElementById('deleteForm');

        console.log(document.querySelectorAll('.btn-delete'));

        document
            .querySelectorAll('.btn-delete')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const id =
                        button.dataset.id;

                    const name =
                        button.dataset.name;

                    deleteName.textContent =
                        name;

                    deleteForm.action =
                        `/admin/cars/${id}`;

                    deleteModal.classList.add('show');

                });
                button.addEventListener('click', () => {

                    console.log('DELETE CLICKED');

                    const id = button.dataset.id;
                    const name = button.dataset.name;

                    console.log(id);
                    console.log(name);

                    deleteName.textContent = name;

                    deleteForm.action = `/admin/cars/${id}`;

                    deleteModal.classList.add('show');

                });

            });

        document
            .getElementById('closeDeleteModal')
            .addEventListener('click', () => {

                deleteModal.classList.remove('show');

            });

        const editModal =
            document.getElementById('editCarModal');

        const editForm =
            document.getElementById('editCarForm');

        document
            .querySelectorAll('.btn-edit')
            .forEach(button => {

                button.addEventListener('click', () => {

                    document.getElementById('editName').value =
                        button.dataset.name;

                    document.getElementById('editBrand').value =
                        button.dataset.brand;

                    document.getElementById('editYear').value =
                        button.dataset.year;

                    document.getElementById('editPlate').value =
                        button.dataset.plate;

                    document.getElementById('editPrice').value =
                        button.dataset.price;

                    document.getElementById('editStatus').value =
                        button.dataset.status;

                    document.getElementById('editDescription').value =
                        button.dataset.description;

                    const preview =
                        document.getElementById('editImagePreview');

                    preview.src =
                        button.dataset.thumbnail;

                    preview.style.display =
                        'block';

                    editForm.action =
                        `/admin/cars/${button.dataset.id}`;

                    editModal.classList.add('show');

                });

            });

        document
            .getElementById('closeEditModal')
            .addEventListener('click', () => {

                editModal.classList.remove('show');

            });

        document
            .getElementById('closeEditModal2')
            .addEventListener('click', () => {

                editModal.classList.remove('show');

            });
    </script>
@endpush
