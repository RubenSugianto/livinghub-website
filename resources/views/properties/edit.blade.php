@extends('master')

@section('content')

<div class="container">
    <!-- Back Button placed at the top-left corner inside the container -->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-secondary back-btn" onclick="goBack()">
                <i class="fa fa-angle-left" aria-hidden="true"></i> Kembali
            </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Edit Properti</h1>
            <form id="propertyForm" action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                @method('PUT')

             <!-- Property Images -->
        <div class="form-group">
            <label for="images">Foto Properti</label>
            <div class="image-upload">
                @php
                    $maxImages = 10; 
                    $existingImagesCount = count($propertyImages); 
                @endphp

        @for ($i = 0; $i < $maxImages; $i++)
            @if ($i < $existingImagesCount)

                <!-- Display existing images -->
                <div class="image-slot" data-index="{{ $i }}">
                    @php
                        $imagePath = $propertyImages[$i]->images;
                    @endphp
                    <img src="{{ asset($imagePath) }}" alt="Property Image" class="existing-image">
                    <i class="bi bi-trash delete-icon" onclick="deleteImage({{ $i }})"></i> 
                    <input type="hidden" name="existing_images[]" value="{{ $propertyImages[$i]->id }}">
                </div>
            @else
                <!-- Provide slots for new image uploads -->
                <div class="image-slot" data-index="{{ $i }}">
                    <input type="file" id="image{{ $i }}" name="images[]" class="image-input" onchange="previewImage(event, {{ $i }})">
                    <label for="image{{ $i }}" class="image-label">+</label>
                    <img id="preview{{ $i }}" src="" alt="Image Preview" class="image-preview" style="display: none;">
                </div>
            @endif
        @endfor
    </div>

                <!-- Error message if no image is uploaded -->
                <p id="imageError" class="text-danger" style="display: none;">Anda harus mengunggah setidaknya satu foto sebelum menyimpan.</p>

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
                
                <div class="form-group-row text-right"> 
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event, index) {
        const input = event.target;
        const preview = document.getElementById(`preview${index}`);
        const label = input.nextElementSibling;
        const imageSlot = document.querySelector(`.image-slot[data-index="${index}"]`);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                label.style.display = 'none';
                
                if (!imageSlot.querySelector('.delete-icon')) {
                    const deleteIcon = document.createElement('i');
                    deleteIcon.classList.add('bi', 'bi-trash', 'delete-icon');
                    deleteIcon.setAttribute('onclick', `deleteImage(${index})`);
                    imageSlot.appendChild(deleteIcon);  
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteImage(index) {
        const imageSlot = document.querySelector(`.image-slot[data-index="${index}"]`);
        imageSlot.innerHTML = `
            <input type="file" id="image${index}" name="images[]" class="image-input" onchange="previewImage(event, ${index})">
            <label for="image${index}" class="image-label">+</label>
            <img id="preview${index}" src="" alt="Image Preview" class="image-preview" style="display: none;">
        `;
    }
    function validateForm() {
    let valid = true;
    const requiredFields = document.querySelectorAll('#propertyForm input[required], #propertyForm textarea[required]');

    requiredFields.forEach(field => {
        if (field.value.trim() === '') {
            field.classList.add('is-invalid');
            valid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    const imageSlots = document.querySelectorAll('.image-slot');
    let hasImage = false;

    imageSlots.forEach(slot => {
        const img = slot.querySelector('img');
        if (img && img.src && img.style.display !== 'none') {
            hasImage = true;
        }
    });

    const imageError = document.getElementById('imageError');
    if (!hasImage) {
        imageError.style.display = 'block'; 
        valid = false;
        alert('Gambar tidak boleh kosong! Silakan unggah minimal satu gambar.');
    } else {
        imageError.style.display = 'none'; 
    }

    return valid; 
    }

    function goBack() {
        if (confirm('Apakah Anda yakin ingin kembali tanpa menyimpan perubahan?')) {
            window.history.back(); 
        }
    }
</script>


<style>
.container {
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 30px;
    margin-bottom: 40px;
    position: relative;
}

/* Header Styling */
h1 {
    font-size: 24px;
    font-weight: bold;
    margin-top: 50px;
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}

/* Form Group and Labels */
.form-group-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
}

.form-group-row label {
    width: 100%;
    max-width: 200px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
}

/* Input Container */
.input-container {
    flex-grow: 1;
    width: calc(100% - 220px); /* Adjust based on label width */
}

/* Form Control */
.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #5E5DF0;
    box-shadow: 0 0 5px rgba(94, 93, 240, 0.25);
}

/* Helper Text */
.helper-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 5px;
}

/* Photo Label and Image Upload */
.form-group-row label[for="images"] {
    font-weight: bold; /* Make the label for Foto Properti bold */
    color: #555;
}

.image-upload {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.image-slot {
    width: 100%;
    height: 150px;
    border: 2px dashed #ccc;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease;
}

.image-slot:hover {
    border-color: #5E5DF0;
}

.image-slot img,
.image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Delete Icon */
.image-slot .delete-icon {
    position: absolute;
    top: 8px;
    right: 8px;
    font-size: 1.25rem;
    color: #ff4d4f;
    cursor: pointer;
    display: none;
}

.image-slot:hover .delete-icon {
    display: block;
}

.image-input {
    display: none;
}

.image-label {
    font-size: 2rem;
    cursor: pointer;
    color: #aaa;
    transition: color 0.3s ease;
}

.image-slot:hover .image-label {
    color: #5E5DF0;
}

/* Buttons */
.btn-primary {
    background-color: #5E5DF0;
    border-color: #5E5DF0;
    font-weight: bold;
    font-size: 16px;
    padding: 12px 30px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    float: right; /* Align button to the right */
}

.btn-primary:hover {
    background-color: #4A4AC4;
    border-color: #4A4AC4;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    transition: background-color 0.3s ease;
    position: absolute;
    top: -20px; /* Adjusts the position of the back button vertically */
    left: 0;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.back-btn i {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .form-group-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .form-group-row label,
    .input-container {
        width: 100%;
    }

    .btn-secondary {
        top: 10px;
        left: 10px;
    }
}
</style>
@endsection
