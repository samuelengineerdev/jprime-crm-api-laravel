<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\ClientEmployeeAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Sale;
use App\Models\Status;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\SaleProduct;
use App\Models\User;
use Illuminate\Support\Arr;

class SaleController extends Controller
{
    public function getClientUserId($userCode)
    {
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        // Verificar si se encontró un usuario válido
        if (!$clientUserId) {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        return $clientUserId;
    }

    public function index($userCode)
    {
        // Buscar en el modelo correspondiente según el prefijo del código
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Failed geting sales']);
        }

        $sales = Sale::with(['customer', 'paymentMethod', 'paymentType', 'status'])->where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();

        return response()->json(['status' => 1, 'sales' => $sales]);
    }

    public function store(Request $request, $userCode)
    {
        // return response()->json(['status' => 0, 'message' => $userCode]);

        // Verificar si el código de usuario está presente en los datos recibidos
        if (!isset($userCode)) {
            return response()->json(['status' => 0, 'message' => 'Error: missing user code']);
        }

        // Obtener todos los datos del request
        $data = $request->all();

        // Verificar que tenga un customer seleccionado
        if (!isset($data['customer_id'])) {
            return response()->json(['status' => 0, 'message' => 'Customer is required']);
        }

        // Buscar en el modelo correspondiente según el prefijo del código
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Failed to register sale']);
        }

        // Verificar si se encontró un usuario válido
        if (!$clientUserId) {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        // Crear el código de venta único
        $lastCode = Sale::where('client_user_id', $clientUserId)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'SL' . str_pad($number, 3, '0', STR_PAD_LEFT);
        $data['client_user_id'] = $clientUserId;

        // Crear la venta
        $sale = Sale::create($data);

        // Verificar si se creó la venta correctamente
        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Error: failed to register sale']);
        }

        if (isset($data['selected_products'])) {
            foreach ($data['selected_products'] as $productData) {
                if (isset($productData['deleted']) && $productData['deleted']) {
                    // No crear el producto si está marcado como eliminado
                    continue;
                }
                $productData['sale_id'] = $sale->id;
                $lastCode = SaleProduct::orderBy('id', 'desc')->pluck('code')->first();
                $lastNumber = intval(substr($lastCode, 2));
                $newNumber = $lastNumber + 1;
                $productData['code'] = 'SP' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
                $productSaved = SaleProduct::create($productData);

                if (!$productSaved) {
                    return response()->json(['status' => 0, 'message' => 'Error: failed to register sale products']);
                }
            }
        }
        return response()->json(['status' => 1, 'sale' => $sale], 201);
    }

    public function show($id)
    {
        $sale = Sale::with(['customer', 'paymentMethod', 'paymentType', 'status'])->find($id);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Sale not found']);
        }

        $sale['selected_products'] = SaleProduct::with(['mainProduct'])->where('sale_id', $sale->id)->where('deleted', 0)->get();

        return response()->json(['status' => 1, 'sale' => $sale]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if (!isset($data['id'])) {
            return response()->json(['status' => 0, 'message' => 'Error missing value requerid']);
        }

        $sale = Sale::find($data['id']);

        $sale->update($data);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Error trying update sale']);
        }

        if (isset($data['selected_products'])) {
            $productsWithCode = [];
            $productsWithoutCode = [];

            foreach ($data['selected_products'] as $productData) {
                if (isset($productData['code'])) {
                    $productsWithCode[] = $productData;
                } else {
                    $productsWithoutCode[] = $productData;
                }
            }

            // Asociar los productos con código a la venta y actualizarlos
            foreach ($productsWithCode as $productData) {
                $product = SaleProduct::where('code', $productData['code'])->first();
                if ($product) {
                    // Actualizar el producto existente
                    $product->update($productData);
                } else {
                    // Manejar caso de código no encontrado
                    return response()->json(['status' => 0, 'message' => 'Error: product with code not found']);
                }
            }

            // Generar códigos y asociar productos sin código a la venta
            foreach ($productsWithoutCode as $productData) {
                $productData['sale_id'] = $sale->id;
                // Generar código nuevo para el producto
                $lastCode = SaleProduct::orderBy('id', 'desc')->pluck('code')->first();
                $number = intval(substr($lastCode, 3)) + 1;
                $productData['code'] = 'SP' . str_pad($number, 3, '0', STR_PAD_LEFT);

                // Insertar el producto en la base de datos
                $newProduct = SaleProduct::create($productData);
                if (!$newProduct) {
                    return response()->json(['status' => 0, 'message' => 'Error: failed to create sale product']);
                }
            }
        }

        return response()->json(['status' => 1, 'sale' => $sale, 'message' => 'Sale updated successfully']);
    }

    public function delete($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Sale not found'], 404);
        }

        $sale->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Sale deleted successfully']);
    }

    public function statuses()
    {
        $statuses = Status::where('type', 'SALE')->get();
        return response()->json(['status' => 1, 'statuses' => $statuses]);
    }

    public function getSaleCreationData($userCode)
    {
        $clientUserId = $this->getClientUserId($userCode);
        $statuses = Status::where('type', 'SALE')->get();
        $paymentMethods = PaymentMethod::where('type', 'SALE')->get();
        $paymentTypes = PaymentType::where('type', 'SALE')->get();
        $customers = Customer::with('status')->where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();
        $products = Product::with(['category', 'status'])->where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();

        return response()->json(['status' => 1, 'statuses' => $statuses, 'paymentMethods' => $paymentMethods, 'paymentTypes' => $paymentTypes, 'customers' => $customers, 'products' => $products]);
    }
}
