@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Edit Properti</h1>
            <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Property Images -->
                <div class="form-group">
                    <label for="images">Foto Properti</label>
                    <div class="image-upload">
                        @php
                            $maxImages = 10; // Maximum number of image slots
                            $existingImagesCount = count($propertyImages); // Number of existing images
                        @endphp

                        @for ($i = 0; $i < $maxImages; $i++)
                            @if ($i < $existingImagesCount)
                                <!-- Display existing images -->
                                <div class="image-slot">
                                    @php
                                        $imagePath = 'uploads/properties/' . $propertyImages[$i]->images;
                                    @endphp
                                    <img src="{{ asset($imagePath) }}" alt="Property Image" style="width: 100%; height: auto;">
                                </div>
                            @else
                                <!-- Provide slots for new image uploads -->
                                <div class="image-slot">
                                    <input type="file" id="image{{ $i }}" name="images[]" class="image-input">
                                    <label for="image{{ $i }}" class="image-label">+</label>
                                </div>
                            @endif
                        @endfor
                    </div>
                    <p class="helper-text">Format foto harus .jpg, .jpeg, .png dan ukuran minimal 300 x 300 px. Maksimal 10 foto yang berbeda satu sama lain untuk menarik perhatian calon pembeli.</p>
                </div>


                <!-- Property Details -->
                <div class="form-group-row">
                    <label for="name">Nama Properti</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $property->name) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="description">Deskripsi Properti</label>
                    <div class="input-container">
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $property->description) }}</textarea>
                        <p class="helper-text">Penjelasan detail terkait properti agar calon pembeli mengetahui spesifikasi dan detail mengenai properti yang akan dibeli.</p>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="price">Harga Properti</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $property->price) }}" required>
                        <p class="helper-text">Contoh: Rp500.000.000</p>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="location">Lokasi Properti</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $property->location) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="bathroom">Jumlah Kamar Mandi</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="bathroom" name="bathroom" value="{{ old('bathroom', $property->bathroom) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="bedroom">Jumlah Kamar Tidur</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="bedroom" name="bedroom" value="{{ old('bedroom', $property->bedroom) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="electricity">Listrik Properti</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="electricity" name="electricity" value="{{ old('electricity', $property->electricity) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="surfaceArea">Luas Permukaan</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="surfaceArea" name="surfaceArea" value="{{ old('surfaceArea', $property->surfaceArea) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="buildingArea">Luas Bangunan</label>
                    <div class="input-container">
                        <input type="number" class="form-control" id="buildingArea" name="buildingArea" value="{{ old('buildingArea', $property->buildingArea) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="status">Status Properti</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $property->status) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="type">Jenis Properti</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $property->type) }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group-row {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .form-group-row label {
        width: 20%;
        margin-right: 1rem;
        align-self: flex-start;
    }

    .input-container {
        width: 80%;
    }

    .form-control {
        width: 100%;
    }

    .helper-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }

    .image-upload {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Adjust the gap between images as needed */
    }           

    .image-slot {
        width: calc(20% - 10px); /* 20% width minus half the gap on each side */
        height: 150px;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }


    .image-input {
        display: none;
    }

    .image-label {
        font-size: 2rem;
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        margin-left: auto;
        display: block;
    }
</style>
@endsection
