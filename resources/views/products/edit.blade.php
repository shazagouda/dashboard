<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Product - Bee Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    .main-content {
      margin-left: 280px;
      margin-top: 70px;
      padding: 20px 30px;
      min-height: calc(100vh - 70px);
      background-color: #f8fafc;
    }

    @media (max-width: 992px) {
      .main-content {
        margin-left: 0;
        padding: 15px 15px;
      }
    }

    /* Breadcrumb */
    .breadcrumb-container {
      margin-bottom: 25px;
      background-color: #f8fafc;
    }

    .breadcrumb {
      background: none;
      padding: 0;
      margin: 0;
      font-size: 14px;
    }

    .breadcrumb-item {
      display: flex;
      align-items: center;
    }

    .breadcrumb-item + .breadcrumb-item::before {
      content: ">";
      color: #6b7280;
      margin: 0 8px;
    }

    .breadcrumb-item a {
      color: #6b7280;
      text-decoration: none;
    }

    .breadcrumb-item.active {
      color: #1f2937;
      font-weight: 500;
    }

    .breadcrumb i {
      font-size: 16px;
    }

    /* Form */
    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      max-width: 600px;
      width: 100%;
      margin: 20px auto;
    }

    .form-container h4 {
      font-size: 24px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 30px;
    }

    .form-label {
      font-weight: 500;
      color: #374151;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-control, .form-select {
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 12px 16px;
      font-size: 14px;
      transition: all 0.2s ease;
      background-color: #fff;
    }

    .form-control:focus, .form-select:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
      outline: none;
    }

    .form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }

    .mb-3 {
      margin-bottom: 20px !important;
    }

    .text-danger {
      color: #dc2626 !important;
    }

    .btn-primary {
      background-color: #3b82f6;
      border-color: #3b82f6;
      padding: 12px 24px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #2563eb;
      border-color: #2563eb;
    }
  </style>
</head>
<body>
  @include('layouts.navbar')
  @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('products.index') }}">Products</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
        </ol>
      </nav>
    </div>

    <!-- Form Container -->
    <div class="form-container">
      <h4>Edit Product</h4>
      <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Item <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Price</label>
          <input type="number" class="form-control" name="price" value="{{ $product->price }}" step="0.01">
        </div>

        <div class="mb-3">
          <label class="form-label">Default Quantity</label>
          <input type="number" class="form-control" name="default_quantity" value="{{ $product->default_quantity ?? 1 }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Max Quantity</label>
          <input type="number" class="form-control" name="max_quantity" value="{{ $product->max_quantity }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Tax Category</label>
          <select class="form-select" name="tax_category">
            <option value="Physical Goods" {{ $product->tax_category == 'Physical Goods' ? 'selected' : '' }}>Physical Goods</option>
            <option value="Digital Services" {{ $product->tax_category == 'Digital Services' ? 'selected' : '' }}>Digital Services</option>
            <option value="Consulting" {{ $product->tax_category == 'Consulting' ? 'selected' : '' }}>Consulting</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Image URL</label>
          <input type="url" class="form-control" name="image_url" value="{{ $product->image_url }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
