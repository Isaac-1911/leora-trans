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

                        <button class="btn-outline" data-id="{{ $car->id }}">
                            EDIT
                        </button>

                        <form action="{{ route('admin.cars.delete', $car) }}" method="POST" style="flex:1">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-outline" style="width:100%">
                                DELETE
                            </button>

                        </form>

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

                    <label for="thumbnail" class="upload-box">

                        <div class="upload-content">

                            <p class="upload-title">
                                Click to upload or drag and drop
                            </p>

                            <p class="upload-subtitle">
                                PNG, JPG up to 10MB
                            </p>

                        </div>

                    </label>
                    <p id="fileName" class="selected-file">
                        No file selected
                    </p>

                    <input type="file" id="thumbnail" name="thumbnail" hidden>

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

        thumbnail.addEventListener('change', function() {

            if (this.files.length) {

                fileName.textContent =
                    this.files[0].name;
            }

        });
    </script>
@endpush
