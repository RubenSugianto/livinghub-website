@extends('master')

@section('title', 'Home')

@section('styles')
<style>
    .carousel-item img {
        max-height: 400px; 
        width: 100%;
        margin: auto; 
        object-fit: contain;  
        
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%; 
        top: 50%; 
        transform: translateY(-50%);
        opacity: 0.8; 
        z-index: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); 
        border-radius: 50%; =
        padding: 12px; 
    }

    .carousel-control-prev-icon {
        margin-right: 5px; 
    }

    .carousel-control-next-icon {
        margin-left: 5px; 
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1; 
    }

    
    .search-bar {
        margin-top: 20px;
        text-align: center;
    }

    .search-bar img {
        display: block;
        margin: 0 auto 10px auto; 
    }

    .search-bar .input-group {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30%; 
        margin: 0 auto; 
        border: 2px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
    }

    .search-bar input[type="text"] {
        flex: 1;
        padding: 10px;
        border: none;
        outline: none;
    }

    .search-bar button {
        padding: 10px 20px;
        background: none; 
        color: black; 
        border: none;
        cursor: pointer;
    }

    .search-bar button:hover {
        color: #4A4AC4;  
    }

    .search-bar button.filter-button:hover {
        color: #4A4AC4; 
    }

    .btn-group-toggle .btn {
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    color: black; 
    background-color: white; 
    }

    .btn-group-toggle .btn.active {
    background-color: #4A4AC4;
    color: white;
    }

    .btn-group-toggle .btn:hover {
    background-color: #4A4AC4;
    color: white;
    }

    .modal-body {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
    }

    .modal-body .form-group {
        flex: 1 1 30%;
    }

    .modal-body .form-group-full {
        flex: 1 1 100%;
    }

    .input-range {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-group-toggle .btn input[type="radio"] {
        display: none;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body .btn-group-toggle .btn {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        color: black; 
        background-color: white; 
    }

    .modal-body .btn-group-toggle .btn.active {
        background-color: #5E5DF0;
        color: white;
    }

    .modal-body .btn-group-toggle .btn:hover {
        background-color: #4A4AC4;
        color: white;
    }


    .modal-dialog.modal-lg {
        max-width: 40%; 
    }

    

</style>
@endsection

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="C3.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C3.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Search and filter buttons -->
<div class="search-bar">
    <img src="LogooB.png" alt="Living HUB Logo" width="400"> 
    <div class="input-group">
        <input type="text" placeholder="Cari properti disini..">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <button type="button" class="filter-button" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter" aria-hidden="true"></i></button>
    </div>
</div>

<!-- Filter Modal Dialog Box-->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="filterForm">
          <div class="form-group">
            <label for="status">Status</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="status" id="status1" autocomplete="off" value="Dijual"> Dijual
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="status" id="status2" autocomplete="off" value="Disewa"> Disewa
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="bedrooms">Kamar Tidur</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="bedrooms" id="bedroom1" autocomplete="off" value="1 Kamar"> 1 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bedrooms" id="bedroom2" autocomplete="off" value="2 Kamar"> 2 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bedrooms" id="bedroom3" autocomplete="off" value="3 Kamar"> 3 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bedrooms" id="bedroom4" autocomplete="off" value="3+ Kamar"> 3+ Kamar
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="bathrooms">Kamar Mandi</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="bathrooms" id="bathroom1" autocomplete="off" value="1 Kamar"> 1 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bathrooms" id="bathroom2" autocomplete="off" value="2 Kamar"> 2 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bathrooms" id="bathroom3" autocomplete="off" value="3 Kamar"> 3 Kamar
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="bathrooms" id="bathroom4" autocomplete="off" value="3+ Kamar"> 3+ Kamar
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="land_size">Luas Tanah</label>
            <div class="input-range">
              <input type="number" id="land_size_min" name="land_size_min" placeholder="0" class="form-control">
              <span>m² -</span>
              <input type="number" id="land_size_max" name="land_size_max" placeholder="0" class="form-control">
              <span>m²</span>
            </div>
          </div>
          <div class="form-group">
            <label for="building_size">Luas Bangunan</label>
            <div class="input-range">
              <input type="number" id="building_size_min" name="building_size_min" placeholder="0" class="form-control">
              <span>m² -</span>
              <input type="number" id="building_size_max" name="building_size_max" placeholder="0" class="form-control">
              <span>m²</span>
            </div>
          </div>
          <div class="form-group">
            <label for="certificate">Sertifikat</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="certificate" id="certificate1" autocomplete="off" value="SHM"> SHM
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="certificate" id="certificate2" autocomplete="off" value="SHGB"> SHGB
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="certificate" id="certificate2" autocomplete="off" value="SHGU"> SHGU
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="certificate" id="certificate2" autocomplete="off" value="Hak Pakai"> Hak Pakai
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="certificate" id="certificate3" autocomplete="off" value="Lainnya"> Lainnya
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="property_type">Tipe Properti</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="property_type" id="property_type1" autocomplete="off" value="Rumah"> Rumah
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="property_type" id="property_type2" autocomplete="off" value="Apartemen"> Apartemen
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="property_type" id="property_type3" autocomplete="off" value="Ruko"> Ruko
              </label>
              <label class="btn btn-outline-primary">
                <input type="radio" name="property_type" id="property_type4" autocomplete="off" value="Tanah"> Tanah
              </label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="resetFilters()">Reset</button>
        <button type="button" class="btn btn-primary" style="background-color: #5E5DF0; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#4A4AC4';" onmouseout="this.style.backgroundColor='#5E5DF0';">Search</button>


      </div>
    </div>
  </div>
</div>

<script>
  function resetFilters() {
    document.getElementById('filterForm').reset();
    document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
  }
</script>
@endsection
