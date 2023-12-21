<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Client;
use App\Models\Order;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $query = Order::with(['client'])->whereHas('client', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->select(sprintf('%s.*', (new Order)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $view      = true;
                $print     = true;
                $crudRoutePart = 'orders';
                return view('partials.ActionsFront', compact(
                    'view',
                    'print',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_company_name', function ($row) {
                return $row->client ? $row->client->company_name : '';
            });

            $table->editColumn('shipment_company', function ($row) {
                return $row->shipment_company ? Order::SHIPMENT_COMPANY_SELECT[$row->shipment_company] : '';
            });
            $table->editColumn('order_code', function ($row) {
                return $row->order_code ? $row->order_code : '';
            });
            $table->editColumn('pieces', function ($row) {
                return $row->pieces ? $row->pieces : '';
            });
            $table->editColumn('destination', function ($row) {
                return $row->destination ? $row->destination : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('custom_value', function ($row) {
                return $row->custom_value ? $row->custom_value : '';
            });
            $table->editColumn('delivery_status', function ($row) {
                return $row->delivery_status ? Order::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client']);

            return $table->make(true);
        }

        return view('frontend.orders.index');
    }

    public function create()
    {
        return view('frontend.orders.create');
    }

    public function store(Request $request)
    {
        // client 
        $client = Client::findOrFail(auth()->user()->id);
        // validate 
        $validatedData = $request->validate([
            'shipment_company' => 'required',
            'order_code' => 'required',
            'from' => 'required',
            'to' => 'required',
            'weight' => 'string|nullable',
            'chargeable' => 'string|nullable',
            'pieces' => 'required|integer',
            'pickup_date' => 'required|date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            'destination' => 'required|string',
        ]);

        $order = Order::create([
            'client_id' => $client->id,
            'shipment_company' => $validatedData['shipment_company'],
            'order_code' => $validatedData['order_code'],
            'from' => $validatedData['from'],
            'to' => $validatedData['to'],
            'weight' => $validatedData['weight'],
            'chargeable' => $validatedData['chargeable'],
            'pieces' => $validatedData['pieces'],
            'pickup_date' => $validatedData['pickup_date'],
            'destination' => $validatedData['destination'],
            'cash_on_delivery' => $request->cash_on_delivery,
            'description' => $request->description,
            'custom_value' => $request->custom_value,
            'delivery_status' => 'pending'
        ]);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $order->id]);
        }

        return redirect()->route('client.orders.index');
    }

    public function show(Order $order)
    {
        $order->load('client');

        return view('frontend.orders.show', compact('order'));
    }

    /*
    ** To print order in the view 
    */
    public function print(Order $order)
    {

        if ($order->shipment_company == 'aramex') {
            $order->load('client');
            return view('frontend.prints.aramex', compact('order'));
        }
        if ($order->shipment_company == 'smsa') {
            $order->load('client');
            return view('frontend.prints.smsa', compact('order'));
        }
    }
}
