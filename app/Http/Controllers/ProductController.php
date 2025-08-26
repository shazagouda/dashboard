<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
  public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
{
    $clients = Client::all(); // جيب كل الكلاينت
    return view('products.create', compact('clients'));
}

public function import()
{
    return view('products.import');
}

public function store(Request $request)
{

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'default_quantity' => $request->default_quantity ?? 1,
        'max_quantity' => $request->max_quantity,
        'tax_category' => $request->tax_category ?? 'Physical Goods',
        'image_url' => $request->image_url,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully!');
}

public function destroy($id)
{
    $product = Product::findOrFail($id); // لو مش لاقي يرمي 404
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}


public function edit($id)
{
    $product = Product::findOrFail($id);
    $clients = Client::all();

    return view('products.edit', compact('product', 'clients'));
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');

}

public function import_csv(Request $request)
{
    try {
        // Validate the uploaded file
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csvFile');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Invalid file upload.');
        }

        $path = $file->getRealPath();
        $importedCount = 0;
        $skippedCount = 0;

        if (($handle = fopen($path, 'r')) !== false) {
            // Skip the header row
            $header = fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }

                try {
                    // Map CSV columns to database fields with default values
                    $productData = [
                        'name' => isset($row[0]) && !empty(trim($row[0])) ? trim($row[0]) : 'Unknown Product',
                        'description' => isset($row[1]) && !empty(trim($row[1])) ? trim($row[1]) : null,
                        'price' => isset($row[2]) && !empty(trim($row[2])) ? (float)trim($row[2]) : 0.00,
                        'quantity' => isset($row[3]) && !empty(trim($row[3])) ? (int)trim($row[3]) : 1,
                        'sku' => isset($row[4]) && !empty(trim($row[4])) ? trim($row[4]) : 'AUTO-' . time() . '-' . $importedCount,
                        'category' => isset($row[5]) && !empty(trim($row[5])) ? trim($row[5]) : 'General',

                        // Set default values for other required fields
                        'type' => 'product', // or 'service' based on your needs
                        'tax_rate' => 0.00,
                        'unit' => 'piece',
                        'status' => 'active',
                        'track_inventory' => false,
                        'allow_out_of_stock' => true,
                    ];

                    // Validate price is numeric
                    if (!is_numeric($productData['price']) || $productData['price'] < 0) {
                        $productData['price'] = 0.00;
                    }

                    // Validate quantity is numeric
                    if (!is_numeric($productData['quantity']) || $productData['quantity'] < 0) {
                        $productData['quantity'] = 1;
                    }

                    // Create the product
                    Product::create($productData);
                    $importedCount++;

                } catch (\Exception $e) {
                    Log::error('Error importing product row: ' . json_encode($row) . ' - ' . $e->getMessage());
                    $skippedCount++;
                    continue;
                }
            }

            fclose($handle);
        } else {
            return redirect()->back()->with('error', 'Could not open the file.');
        }

        $message = "Import completed! Imported: {$importedCount} products";
        if ($skippedCount > 0) {
            $message .= ", Skipped: {$skippedCount} rows due to errors";
        }

        return redirect()->route('products.index')->with('success', $message);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()->with('error', 'File validation failed: ' . implode(', ', $e->validator->errors()->all()));
    } catch (\Exception $e) {
        Log::error('Product CSV Import Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error during import: ' . $e->getMessage());
    }
}

}
